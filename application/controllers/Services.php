<?php
// This code is Written by :
// PAPPU BISWAS 
// Suropriyo Eterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');


class Services extends CI_Controller
{


    // for sesrv lines --  json data formation

    // function array_cr(){
    //     // $array = [
    //     //     ['react , vuejs ,angular'],
    //     //     ['Nodejs, python , php'],
    //     //     ['Admin Dashboard'],
    //     //     ['Responsive Design'],
    //     //     ['Api integration']
    //     // ];

    //     // echo json_encode($array);
    // }


    // for sesrv majdesc --  json data formation
    //format  [ 'img' , 'title' , 'description long']

    // function array_cr(){
    //     $array = [
    //         ['logo.png' , 'Frontend Excellence' ,'React, Vue.js, Next.js, and modern JavaScript frameworks with pixel-perfect responsive designs, state management, and optimized performance.'],
    //         ['logo.png' ,'Backend Mastery',  'MongoDB, PostgreSQL, MySQL, headless CMS (Strapi, Sanity), Redis caching, and optimized database architecture for high performance.'],
    //         ['logo.png' , 'Database & CMS' , 'Node.js, Python (Django/Flask), PHP (Laravel), REST & GraphQL APIs, microservices architecture, and secure authentication systems.'],
    //         ['logo.png' , 'PWA & Mobile-First' ,'Progressive Web Apps, mobile-first responsive design, service workers, push notifications, and app-like experiences across all devices.'],
    //     ];
    //     echo json_encode($array);
    // }



    function index()
    {
        $this->load->model('ServicesModel');
        $all_srv = $this->ServicesModel->get_all_services();
        $data = array(
            'allserv' => $all_srv
        );

        $this->load->view('headerView');
        $this->load->view('searchServiceView', $data);
    }

    function Searchservice()
    {
        $this->load->model('ServicesModel');
        $query = $this->input->post();

        if (isset($query['ques'])) {
            $all_srv = $this->ServicesModel->get_filtered_service($query['ques']);
            $data = array(
                'allserv' => $all_srv
            );

            $this->load->view('headerView');
            $this->load->view('searchServiceView', $data);
        } else {

            $all_srv = $this->ServicesModel->get_all_services();
            $data = array(
                'allserv' => $all_srv
            );

            $this->load->view('headerView');
            $this->load->view('searchServiceView', $data);
        }

    }

    function ServiceDescription()
    {
        $query = $this->input->post();

        if (isset($query['serv_id'])) {
            $this->load->model('ServicesModel');

            $list  = $this -> ServicesModel -> get_service_by_id($query['serv_id']);

            $data = array (
                'serv' => $list
            );

            $this->load->view('headerView');
            $this->load->view('serviceDescriptionView', $data);
            
        }else{
            redirect('Services');
        }

    }

    function Technologies(){
        $this->load->view('headerView');
        $this->load->view('technologiesView');
        $this->load->view('footerView');
    }

}

?>