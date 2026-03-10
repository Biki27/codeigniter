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
            // 'sejoba_state' => $apdata['state'],
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


}


?>