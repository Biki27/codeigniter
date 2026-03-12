<?php
// This code is Written by :
// PAPPU BISWAS 
// Suropriyo Eterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');

class jobApplicationModel extends CI_Model
{

    function register_applicant($apdata, $resume_path = '')
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

    function get_applicant_info($sejobaid = '')
    {
        if (trim($sejobaid) == '') {
            return [];
        } else {
            $info = $this->db->from('sejobapplicant')->where('sejoba_id', $sejobaid)->limit(1)->get()->result();
            return $info;
        }
    }

    function get_all_applicants()
    {
        return $this->db
            ->order_by('sejoba_id', 'ASC')
            ->get('sejobapplicant')
            ->result();
    }

     function update_applicant_review($id,$status,$comment)
    {

        $data = array(
            'sejoba_state' => $status,
            'sejoba_comment' => $comment
        );

        $this->db->where('sejoba_id',$id);
        return $this->db->update('sejobapplicant',$data);
    }

    // Step 2: Add interview scheduling function
    function schedule_interview($applicant_id = '', $interview_data = array())
    {
        if (empty($applicant_id) || empty($interview_data)) {
            return ['code' => 1, 'message' => 'Invalid parameters'];
        }

        $this->db->trans_start();

        // Update applicant with interview details and status
        $update_data = array(
            'sejoba_state' => 'interview_scheduled',
            'sejoba_interview_date' => $interview_data['date'] ?? null,
            'sejoba_interview_time' => $interview_data['time'] ?? null,
            'sejoba_interview_location' => $interview_data['location'] ?? null,
            'sejoba_interview_scheduled_by' => $interview_data['scheduled_by'] ?? null,
            'sejoba_interview_scheduled_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('sejoba_id', $applicant_id);
        $this->db->update('sejobapplicant', $update_data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return ['code' => 1, 'message' => 'Failed to schedule interview'];
        } else {
            return ['code' => 0, 'message' => 'Interview scheduled successfully'];
        }
    }

    // Step 3: Add function to get scheduled interviews
    function get_interview_scheduled_applicants()
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
        return $this->db->order_by('sejoba_atime', 'DESC')
                        ->limit($limit)
                        ->get('sejobapplicant')
                        ->result_array();
    }

}

?>