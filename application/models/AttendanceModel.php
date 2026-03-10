<?php
// This code is Written by :
// PAPPU BISWAS
// Suropriyo Enterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');

class AttendanceModel extends CI_Model
{
    function get_attendance_of_all_employee()
    {
        $res = $this->db->from('seemployeeloginlog')->get()->result();
        return $res;
    }

    function find_attendance_for_employee_id($empid = '')
    {
        if (trim($empid) == '') {
            return ['code' => 1];
        }
        $res = $this->db->from('seemployeeloginlog')->where('seemp_logempid', $empid)->get()->result();
        return $res;
    }
    function find_from_startdate($start)
    {
        return $this->db
            ->where('seemp_logdate >=', $start)
            ->get('seemployeeloginlog')
            ->result();
    }
    function find_until_enddate($end)
    {
        return $this->db
            ->where('seemp_logdate <=', $end)
            ->get('seemployeeloginlog')
            ->result();
    }
    function find_by_daterange($start, $end)
    {
        return $this->db
            ->where('seemp_logdate >=', $start)
            ->where('seemp_logdate <=', $end)
            ->get('seemployeeloginlog')
            ->result();
    }
    function find_empid_with_daterange($empid, $start, $end)
    {
        return $this->db
            ->where('seemp_logempid', $empid)
            ->where('seemp_logdate >=', $start)
            ->where('seemp_logdate <=', $end)
            ->get('seemployeeloginlog')
            ->result();
    }

    function get_today_login_logout($empid)
{
    $today = date('Y-m-d');

    return $this->db
        ->where('seemp_logempid', $empid)
        ->where('seemp_logdate', $today)
        ->get('seemployeeloginlog')
        ->row();
}
}

?>