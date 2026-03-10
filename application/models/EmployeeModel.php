<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeModel extends CI_Model
{
    /// Get user by email or employee ID for authentication 
    //ADDED on 2024-06-15 by BIKI
    
// public function get_user_by_identity($identity) {
//     $this->db->group_start();
//     $this->db->where('seemp_email', $identity);
//     $this->db->or_where('seemp_id', $identity);
//     $this->db->group_end();
//     $query = $this->db->get('seemployee');
    
//     return ($query->num_rows() == 1) ? $query->row() : false;
// }

    function getallemployee_with_joins()
    {
        $res = $this->db
            ->from('seemployee')
            ->join('seempdetails', 'seemployee.seemp_id = seempdetails.seempd_empid', 'left')
            ->join('sejobapplicant', 'seempdetails.seempd_jobaid = sejobapplicant.sejoba_id', 'left')
            ->get()
            ->result();

        return $res;
    }

    function get_employee_with_id($empid = '')
    {
        if (trim($empid) == '') {
            return ['code' => 1];
        }

        $res = $this->db
            ->from('seemployee')
            ->join('seempdetails', 'seemployee.seemp_id = seempdetails.seempd_empid', 'left')
            ->join('sejobapplicant', 'seempdetails.seempd_jobaid = sejobapplicant.sejoba_id', 'left')
            ->where('seemployee.seemp_id', $empid)
            ->limit(1)
            ->get()
            ->result();

        return $res;
    }

    function get_employee_with_search($query = '', $status = '')
    {
        if (trim($query) != '') {
            if (trim($status) != '') {
                $res = $this->db
                    ->from('seemployee')
                    ->group_start()
                    ->like('seemployee.seseq_id', $query)
                    ->or_like('seemployee.seemp_id', $query)
                    ->or_like('seemployee.seemp_email', $query)
                    ->or_like('seempdetails.seempd_name', $query)
                    ->or_like('seempdetails.seempd_phone', $query)
                    ->or_like('seempdetails.seempd_designation', $query)
                    ->group_end()
                    ->join('seempdetails', 'seemployee.seemp_id = seempdetails.seempd_empid', 'left')
                    ->join('sejobapplicant', 'seempdetails.seempd_jobaid = sejobapplicant.sejoba_id', 'left')
                    ->get()
                    ->result();

            } else {

                $res = $this->db
                    ->from('seemployee')
                    ->group_start()
                    ->like('seemployee.seseq_id', $query)
                    ->or_like('seemployee.seemp_id', $query)
                    ->or_like('seemployee.seemp_email', $query)
                    ->or_like('sejobapplicant.sejoba_name', $query)
                    ->or_like('sejobapplicant.sejoba_phone', $query)
                    ->or_like('sejobapplicant.sejoba_position', $query)
                    ->group_end()
                    ->join(
                        'seempdetails',
                        'seemployee.seemp_id = seempdetails.seempd_empid',
                        'left'
                    )
                    ->join(
                        'sejobapplicant',
                        'seempdetails.seempd_jobaid = sejobapplicant.sejoba_id',
                        'left'
                    )
                    ->get()
                    ->result();

            }

        } else {
            if (trim($status) != '') {
                $res = $this->db
                    ->from('seemployee')
                    ->where('seemp_status', $status)
                    ->join(
                        'seempdetails',
                        'seemployee.seemp_id = seempdetails.seempd_empid',
                        'left'
                    )
                    ->join(
                        'sejobapplicant',
                        'seempdetails.seempd_jobaid = sejobapplicant.sejoba_id',
                        'left'
                    )
                    ->get()
                    ->result();
            } else {
                $res = $this->getallemployee_with_joins();
            }
        }

        return $res;
    }


    function check_if_employee_exist($username = '', $pass = '')
    {
        if (trim($username) == '' || trim($pass) == '') {
            return array('code' => 1);
        }

        $query = $this->db->from('seemployee')
            ->where('seemp_email', $username)
            ->limit('1')
            ->get();

        $res = $query->result();
        if (empty($res)) {
            $res += array(
                'code' => 1
            );
            return $res;
        }

        $res += array(
            'code' => 0
        );
        return $res;
    }

    function change_employee_password($oldpass = '', $newpass = '')
    {

        $empid = $this->session->userdata('empid');
        $info = $this->db->from('seemployee')->where('seemp_id =', $empid)->limit(1)->get()->result();

        if (password_verify($oldpass, $info[0]->seemp_pass)) {
            $this->db->trans_start();
            $condition = array(
                'seemp_id' => $empid,
                'seemp_email' => $info[0]->seemp_email,
                'seemp_status' => $info[0]->seemp_status
            );
            $data = array(
                'seemp_pass' => password_hash($newpass, PASSWORD_DEFAULT)
            );
            $issuccess = $this->db->where($condition)->update('seemployee', $data);
            if ($issuccess == TRUE && $this->db->affected_rows() == 1) {
                $this->db->trans_complete();
                return ['code' => 0];
            } else {
                $this->db->trans_rollback();
                return ['code' => 1];
            }

        } else {
            return ['code' => 1];
        }

    }

    function update_employee_table_with_today($empid = '', $email = '', $seqid = '', $status = '')
    {
        if (
            empty(trim($empid)) || empty(trim($email)) || empty(trim($seqid)) ||
            empty(trim($status)) || trim($status) == 'inactive'
        ) {
            return ['code' => 1];
        } else {

            $this->db->trans_begin();

            $condition = array(
                'seemp_id =' => $empid,
                'seemp_email =' => $email,
                'seseq_id =' => $seqid,
                'seemp_status =' => 'active'
            );
            $isupdated = $this->db->where($condition)->update('seemployee', ['seemp_lastlogin' => date('Y-m-d')]);

            if ($isupdated == TRUE && $this->db->affected_rows() == 1) {
                $this->db->trans_complete();
                return ['code' => 0];
            } else {
                $this->db->trans_rollback();
                return ['code' => 1, 'message' => 'Something is wrong Check Credentials or Multiple rows getting affected.'];
            }

        }
    }


//    function update_log_current_state($empid = '', $action = 'login')
//     {
//         if (
//             empty(trim($empid)) || empty(trim($action))
//         ) {
//             return ['code' => 1];
//         } else {

//             $this->db->trans_begin();

//             $condition = array(
//                 'seemp_logempid =' => $empid,
//                 'seemp_logdate =' => date('Y-m-d'),
//             );

//             $data = array(
//                 'seemp_logempid' => $empid,
//                 'seemp_logdate' => date('Y-m-d'),
//             );

//             $isupdated = $this->db->from('seemployeeloginlog')->where($condition)->get()->result();

//             if (count($isupdated) <= 0 && $action == 'login') {

//                 $data += ['seemp_logintime' => date('Y-m-d H:i:s')];
//                 $this->db->insert('seemployeeloginlog', $data);
//                 $this->db->trans_complete();
//                 return ['code' => 0];

//             }else if (count($isupdated) == 1 && $action == 'logout') {

//                 $this->db->where([
//                     'seemp_logempid' => $empid,
//                     'seemp_logdate' => date('Y-m-d')
//                 ]);

//                 $this->db->update('seemployeeloginlog', [
//                     'seemp_logouttime' => date('Y-m-d H:i:s')
//                 ]);

//                 $this->db->trans_complete();
//                 return ['code' => 0];
//             }

//         }
//     }
function update_log_current_state($empid = '', $action = 'login')
{
    if (empty(trim($empid)) || empty(trim($action))) {
        return ['code' => 1];
    }

    $today = date('Y-m-d');
    $now = date('Y-m-d H:i:s');

    // Check if a log entry already exists for this employee today
    $this->db->where([
        'seemp_logempid' => $empid,
        'seemp_logdate'  => $today
    ]);
    $existing_log = $this->db->get('seemployeeloginlog')->row();

    if ($action == 'login') {
        // ONLY insert if no log exists for today. 
        // If it exists, we do nothing to keep the very first login time.
        if (!$existing_log) {
            $data = [
                'seemp_logempid'  => $empid,
                'seemp_logdate'   => $today,
                'seemp_logintime' => $now
            ];
            $this->db->insert('seemployeeloginlog', $data);
            return ['code' => 0, 'message' => 'Login recorded'];
        }
        return ['code' => 0, 'message' => 'Login already exists for today'];
    } 
    
    else if ($action == 'logout') {
        // Update the logout time for today's entry
        if ($existing_log) {
            $this->db->where([
                'seemp_logempid' => $empid,
                'seemp_logdate'  => $today
            ]);
            $this->db->update('seemployeeloginlog', ['seemp_logouttime' => $now]);
            return ['code' => 0, 'message' => 'Logout recorded'];
        }
        return ['code' => 1, 'message' => 'No login record found to logout'];
    }
}

    function get_all_loginlog_for_thisempid()
    {
        $empid = $this->session->userdata('empid');
        $res = $this->db->from('seemployeeloginlog')->where('seemp_logempid =', $empid)->get()->result();
        return $res;
    }

    // for add employee from admin panel
    public function register_employee($employee, $details)
    {

        $this->db->trans_start();

        // Insert into main employee table
        $this->db->insert('seemployee', $employee);

        // Insert into employee details table
        $this->db->insert('seempdetails', $details);

        // Update applicant if exists
        if (!empty($details['seempd_jobaid'])) {

            $this->db->where('sejoba_id', $details['seempd_jobaid']);

            $this->db->update(
                'sejobapplicant',
                ['sejoba_state' => 'selected']
            );

        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {

            return ['code' => 1];

        } else {

            return ['code' => 0];

        }

    }

    /**
     * Update Employee Information
     */
    public function update_employee($empid = '', $data = array())
    {
        if (empty($empid) || empty($data)) {
            return ['code' => 1, 'message' => 'Invalid parameters'];
        }

        $this->db->trans_start();

        // Update main employee table
        $employee_data = [
            'seemp_email' => $data['email'] ?? null,
            'seemp_branch' => strtoupper($data['branch'] ?? ''),
            'seemp_status' => strtolower($data['status'] ?? 'active'),
            'seemp_acesslevel' => strtoupper($data['accessLevel'] ?? 'EMPL')
        ];

        if (!empty($data['password'])) {
            $employee_data['seemp_pass'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $this->db->where('seemp_id', $empid);
        $this->db->update('seemployee', $employee_data);

        // Update employee details table
        $details_data = [
            'seempd_name' => $data['empName'] ?? null,
            'seempd_phone' => $data['phone'] ?? null,
            'seempd_designation' => $data['designation'] ?? null,
            'seempd_salary' => $data['salary'] ?? null,
            'seempd_project' => $data['project'] ?? null,
            'seempd_experience' => $data['experience'] ?? null,
            'seempd_dob' => $data['dob'] ?? null,
            'seempd_joiningdate' => $data['joiningDate'] ?? null,
            'seempd_increment' => $data['increment'] ?? null,
            'seempd_address_permanent' => $data['permAddress'] ?? null,
            'seempd_address_current' => $data['currentAddress'] ?? null,
            'seempd_aadhar' => $data['aadhar'] ?? null,
            'seempd_pan' => $data['pan'] ?? null
        ];

        $this->db->where('seempd_empid', $empid);
        $this->db->update('seempdetails', $details_data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return ['code' => 1, 'message' => 'Database transaction failed'];
        } else {
            return ['code' => 0, 'message' => 'Employee updated successfully'];
        }
    }

    /**
     * Reset Employee Password
     */
    public function reset_employee_password($empid = '', $hashed_password = '')
    {
        if (empty($empid) || empty($hashed_password)) {
            return ['code' => 1, 'message' => 'Invalid parameters'];
        }

        $this->db->trans_start();

        $this->db->where('seemp_id', $empid);
        $this->db->update('seemployee', [
            'seemp_pass' => $hashed_password
        ]);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return ['code' => 1, 'message' => 'Password reset failed'];
        } else {
            return ['code' => 0, 'message' => 'Password reset successfully'];
        }
    }

    /**
     * Get Employee by ID with Full Details
     */
    public function get_employee_full_details($empid = '')
    {
        if (empty($empid)) {
            return [];
        }

        $this->db->select('*');
        $this->db->from('seemployee');
        $this->db->join('seempdetails', 'seemployee.seemp_id = seempdetails.seempd_empid', 'left');
        $this->db->where('seemployee.seemp_id', $empid);
        $query = $this->db->get();

        return $query->result();
    }

}

?>