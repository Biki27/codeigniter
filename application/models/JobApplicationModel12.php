<?php

defined('BASEPATH') or exit('No direct script access allowed');

class jobApplicationModel extends CI_Model
{
    // Fetch a single applicant's full details by their ID
    public function get_applicant_by_id($id)
    {
        $this->db->where('sejoba_id', $id);
        $query = $this->db->get('sejobapplicant');
        return $query->row(); // Returns a single object instead of an array
    }

    public function register_applicant($apdata, $resume_path = '')
    {

        if (trim($resume_path) == '') {
            return 1;
        }

        $applicant_info = array(
            // 'sejoba_id' => $apdata['id'],
            'sejoba_name' => $apdata['fullname'],
            'sejoba_email' => $apdata['email'],
            'sejoba_phone' => $apdata['phone'],
            'sejoba_position' => $apdata['position'],
            'sejoba_resume' => $resume_path,
            'sejoba_experience' => $apdata['experience'],
            'sejoba_exp_salary' => $apdata['salary'],
            'sejoba_coverletter' => $apdata['coverletter'],
            'sejoba_state' => 'applied', // Default status set to 'applied'
            // 'sejoba_comment' => $apdata['comment'],
        );

        $this->db->trans_start();
        $this->db->insert('sejobapplicant', $applicant_info);
        $issuccess = $this->db->error();

        $this->db->trans_complete();
        return $issuccess['code'];
    }

    public function get_applicant_info($sejobaid = '')
    {
        if (trim($sejobaid) == '') {
            return [];
        } else {
            $info = $this->db->from('sejobapplicant')->where('sejoba_id', $sejobaid)->limit(1)->get()->result();
            return $info;
        }
    }

    public function get_all_applicants()
    {
        // The "AS" keyword tricks the view into thinking nothing changed!
        $this->db->select('
        sejobapplicant.*, 
        secandidates.full_name AS sejoba_name, 
        secandidates.email AS sejoba_email, 
        sejobs.sejob_jobtitle AS sejoba_position
    ');
        $this->db->from('sejobapplicant');

        // Link to Candidate table for Name and Email
        $this->db->join('secandidates', 'sejobapplicant.candidate_id = secandidates.id', 'left');

        // Link to Jobs table for the exact Job Title
        $this->db->join('sejobs', 'sejobapplicant.job_id = sejobs.sejob_id', 'left');

        $this->db->order_by('sejobapplicant.sejoba_atime', 'DESC');

        return $this->db->get()->result();
    }

    public function update_applicant_review($id, $status, $comment)
    {

        $data = array(
            'sejoba_state' => $status,
            'sejoba_comment' => $comment
        );

        $this->db->where('sejoba_id', $id);
        return $this->db->update('sejobapplicant', $data);
    }

    // Step 2: Add interview scheduling function
    public function schedule_interview($applicant_id = '', $interview_data = array())
    {
        if (empty($applicant_id) || empty($interview_data)) {
            return ['code' => 1, 'message' => 'Invalid parameters'];
        }

        $this->db->trans_start();

        // FIXED: Changed state to 'interviewing' to match the database ENUM
        $update_data = array(
            'sejoba_state' => 'interviewing',
            'sejoba_interview_date' => $interview_data['date'] ?? null,
            'sejoba_interview_time' => $interview_data['time'] ?? null,
            'sejoba_interview_location' => $interview_data['location'] ?? null,
            'sejoba_interview_scheduled_by' => $interview_data['scheduled_by'] ?? null,
            'sejoba_interview_scheduled_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('sejoba_id', $applicant_id);
        $this->db->update('sejobapplicant', $update_data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            return ['code' => 1, 'message' => 'Failed to schedule interview'];
        } else {
            return ['code' => 0, 'message' => 'Interview scheduled successfully'];
        }
    }
    // Step 3: Add function to get scheduled interviews
    public function get_interview_scheduled_applicants()
    {
        return $this->db
            ->where('sejoba_state', 'interview_scheduled')
            ->order_by('sejoba_interview_date', 'ASC')
            ->order_by('sejoba_interview_time', 'ASC')
            ->get('sejobapplicant')
            ->result();
    }
    //Hr Dashboard functions
    public function get_new_applicants_count()
    {
        return $this->db->where('sejoba_state', 'applied')->count_all_results('sejobapplicant');
    }

    public function get_recent_applicants($limit = 5)
    {
        // Use a JOIN to fetch the Candidate's Name and the Job Title
        $this->db->select('
            sejobapplicant.*, 
            secandidates.full_name AS sejoba_name, 
            sejobs.sejob_jobtitle AS sejoba_position
        ');
        $this->db->from('sejobapplicant');

        // Link to Candidate table for the Name
        $this->db->join('secandidates', 'sejobapplicant.candidate_id = secandidates.id', 'left');

        // Link to Jobs table for the exact Job Title
        $this->db->join('sejobs', 'sejobapplicant.job_id = sejobs.sejob_id', 'left');

        $this->db->order_by('sejobapplicant.sejoba_atime', 'DESC');
        $this->db->limit($limit);

        return $this->db->get()->result_array();
    }
    // Submits the finalized application into the bridging table
    public function submit_application($candidate_id, $job_id, $resume_path, $cover_letter, $phone, $experience, $expected_salary)
    {
        $data = array(
            'candidate_id'      => $candidate_id,
            'job_id'           => $job_id, // Ensure this column exists in your DB
            'sejoba_phone'      => $phone,
            'sejoba_experience' => $experience,
            'sejoba_exp_salary' => $expected_salary,
            'sejoba_resume'     => $resume_path,
            'sejoba_coverletter' => $cover_letter,
            'sejoba_state'      => 'applied',
            'sejoba_atime'      => date('Y-m-d H:i:s')
        );

        return $this->db->insert('sejobapplicant', $data);
    }
    // application/models/JobApplicationModel.php

public function is_eligible_to_apply($candidate_id)
{
    // Look for any application linked to this candidate 
    // where the state is NOT 'rejected'
    $this->db->where('candidate_id', $candidate_id);
    $this->db->where('sejoba_state !=', 'rejected');
    $query = $this->db->get('sejobapplicant');

    // If 0 rows are found, they have no active applications and can apply again.
    // If 1 or more rows are found, they are still in the process and are blocked.
    return $query->num_rows() == 0;
}
    /**
     * Fetch all applications for a specific candidate joined with job details
     * This is used to display the tracking list on the Candidate Dashboard.
     */
    public function get_applications_by_candidate($candidate_id)
    {
        $this->db->select('
        sejobapplicant.*, 
        sejobs.sejob_jobtitle, 
        sejobs.sejob_address,
        secandidates.email as candidate_email
    ');
        $this->db->from('sejobapplicant');

        // Link the application to the specific Job
        $this->db->join('sejobs', 'sejobapplicant.job_id = sejobs.sejob_id', 'left');

        // Link the application to the Candidate's main account info
        $this->db->join('secandidates', 'sejobapplicant.candidate_id = secandidates.id', 'left');

        $this->db->where('sejobapplicant.candidate_id', $candidate_id);
        $this->db->order_by('sejobapplicant.sejoba_atime', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
}
