<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AttendanceModel extends CI_Model
{
    // Common helper to add the JOIN to all queries
    private function _get_attendance_with_names()
    {
        $this->db->select('log.*, emp.seempd_name');
        $this->db->from('seemployeeloginlog as log');
        $this->db->join('seempdetails as emp', 'log.seemp_logempid = emp.seempd_empid', 'left');
    }

    function get_attendance_of_all_employee()
    {
        $this->_get_attendance_with_names();
        return $this->db->get()->result();
    }

    function find_attendance_for_employee_id($empid = '')
    {
        if (trim($empid) == '')
            return ['code' => 1];
        $this->_get_attendance_with_names();
        $this->db->where('log.seemp_logempid', $empid);
        return $this->db->get()->result();
    }

    function find_from_startdate($start)
    {
        $this->_get_attendance_with_names();
        $this->db->where('log.seemp_logdate >=', $start);
        return $this->db->get()->result();
    }

    function find_until_enddate($end)
    {
        $this->_get_attendance_with_names();
        $this->db->where('log.seemp_logdate <=', $end);
        return $this->db->get()->result();
    }

    function find_by_daterange($start, $end)
    {
        $this->_get_attendance_with_names();
        $this->db->where('log.seemp_logdate >=', $start);
        $this->db->where('log.seemp_logdate <=', $end);
        return $this->db->get()->result();
    }

    function find_empid_with_daterange($empid, $start, $end)
    {
        $this->_get_attendance_with_names();

        if (!empty($empid)) {
            $this->db->where('log.seemp_logempid', $empid);
        }
        if (!empty($start)) {
            $this->db->where('log.seemp_logdate >=', $start);
        }
        if (!empty($end)) {
            $this->db->where('log.seemp_logdate <=', $end);
        }

        return $this->db->get()->result();
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