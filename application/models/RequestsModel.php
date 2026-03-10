<?php
// This code is Written by :
// PAPPU BISWAS 
// Suropriyo Enterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');

class RequestsModel extends CI_Model
{

    function get_requestes_for_thisempid()
    {
        $empid = $this->session->userdata('empid');
        $res = $this->db->from('seemprequests')
            ->where('seemrq_empid = ', $empid)
            ->get()
            ->result();
        return $res;

    }

    function addRequest($formdata = [])
    {
        $days = (new DateTime($formdata['startdate']))
            ->diff(new DateTime($formdata['enddate']))
            ->days;

        $info = array(
            // 'seemrq_id' => '',
            'seemrq_empid' => $this->session->userdata('empid'),
            'seemrq_reason' => $formdata['reason'],
            'seemrq_summary' => $formdata['summary'],
            'seemrq_reqdate' => date('Y-m-d'),
            'seemrq_fromdate' => $formdata['startdate'],
            'seemrq_todate' => $formdata['enddate'],
            'seemrq_days' => $days,
            // 'seemrq_status' => '',
        );

        $this->db->trans_start();
        $this->db->insert('seemprequests', $info);
        $this->db->trans_complete();

        $issucess = $this->db->error();

        return $issucess;
    }

    function updateRequest($requestid = '', $empid = '', $status = 'pending')
    {

        $this->db->trans_start();
        $this->db->where('seemrq_id', $requestid)->where('seemrq_empid =', trim($empid))->update('seemprequests', ['seemrq_status' => $status]);
        if ($this->db->affected_rows() == 1) {
            $this->db->trans_complete();
        } else {
            $this->db->trans_rollback();
        }

        $issuccess = $this->db->error();
        return $issuccess;
    }

    function get_holidays_count()
    {
        $thisyear = date('Y');
        $empid = $this->session->userdata('empid');
        // from('seemprequests')

        $res = $this->db->select_sum('seemrq_days')
            ->where('seemrq_empid =', $empid)
            ->where('YEAR(seemrq_reqdate) = '. $thisyear,null, false)
            ->where('seemrq_status =','approved')
            ->get('seemprequests')
            ->row();


        if(trim($res->seemrq_days) == ''){
            return 0;
        }else{
            return trim($res->seemrq_days);
        }

    }

}

?>