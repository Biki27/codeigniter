<?php
// This code is Written by :
// PAPPU BISWAS 
// Suropriyo Eterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');

class JobsModel extends CI_Model
{

    // Here Query Return String ... 
    function get_avilable_jobs_query()
    {
        $query = $this->db->get_compiled_select("sejobs");
        return $query;
    }

    function get_search_in_anyfield_query($mq = '')
    {
        $query = $this->db->from('sejobs');
        $this->db->or_like('sejob_jobtitle', $mq);
        $this->db->or_like('sejob_experience', $mq);
        $this->db->or_like('sejob_address', $mq);
        $this->db->or_like('sejob_workinghours', $mq);
        $this->db->or_like('sejob_skills', $mq);
        $this->db->or_like('sejob_salary', $mq);
        $this->db->or_like('sejob_desc', $mq);
        $this->db->or_like('sejob_state', $mq);
        $this->db->or_like('sejob_urgency', $mq);
        return $this->db->get_compiled_select();
    }

    function filter_jobs_query($title = '', $location = '', $skills = '', $experience = '')
    {
        $dynamic_query = array();
        if (trim($title) != '') {
            $dynamic_query += ['sejob_jobtitle' => $title];
        }
        if (trim($location) != '') {
            $dynamic_query += ['sejob_address' => $location];
        }
        if (trim($skills) != '') {
            $dynamic_query += ['sejob_skills' => $skills];
        }

        if (count($dynamic_query) <= 0 && empty($experience)) {
            $query = $this->db->get_compiled_select("sejobs");
            return $query;
        } else {
            $this->db->from('sejobs');
            foreach ($dynamic_query as $key => $value) {
                $this->db->like($key, $value);
            }

            if (trim($experience) != '') {
                switch ($experience) {
                    case '1':
                        $this->db->where("sejob_experience <", $experience);
                        break;
                    case '3':
                        $this->db->where("sejob_experience <", $experience);
                        break;
                    case '7':
                        $this->db->where("sejob_experience <", $experience);
                        break;
                    case '7plus':
                        $this->db->where("sejob_experience >", $experience);
                        break;
                    default:
                        $this->db->where("sejob_experience", $experience);
                        break;
                }

            }

            $query = $this->db->get_compiled_select();
            return $query;
        }
    }

    function get_jobmodel_query_result($query = '')
    {
        $mquery = $this->db->query($query);
        //returns result array
        return $mquery->result();
    }


    function get_jobs_orderby_date($title = '', $location = '', $skills = '', $experience = '')
    {
        $query = $this->filter_jobs_query($title, $location, $skills, $experience);
        return $query . ' ORDER BY sejob_dateofpost ';
    }

    function get_jobs_orderby_salary($title = '', $location = '', $skills = '', $experience = '')
    {
        $q = $this->filter_jobs_query($title, $location, $skills, $experience);
        return $q . " ORDER BY sejob_salary ";
    }

    function get_jobs_orderby_experience($title = '', $location = '', $skills = '', $experience = '')
    {
        $q = $this->filter_jobs_query($title, $location, $skills, $experience);
        return $q . " ORDER BY sejob_experience ";
    }

    function limit_query($mquery = '', $limit = '', $offset = '')
    {
        $param = array();
        $query = $mquery;

        if (trim($limit) != '') {
            $param += [" LIMIT " => $limit];

            if (trim($offset) != '') {
                $param += [" OFFSET " => $offset];
            }

        }

        foreach ($param as $key => $value) {
            $query += "" . $key . " " . $value;
        }

        return $query;
    }



}

?>