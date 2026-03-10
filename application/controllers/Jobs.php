<?php
// This code is Written by :
// PAPPU BISWAS 
// Suropriyo Eterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends CI_Controller
{

    function index()
    {
        $this->load->model('JobsModel');

        $search_query = $this->input->post();
        $ques = '';
        if (isset($search_query['search'])) {
            $ques = $search_query['search'];
        }
        ;

        $query = $this->JobsModel->get_search_in_anyfield_query($ques);
        $result = $this->JobsModel->get_jobmodel_query_result($query);

        $viewData = array('res' => $result);

        $this->load->view('jobsView', $viewData);
        $this->load->view('footerView');
    }

    function SearchJob()
    {
        $this->load->model('JobsModel');

        $search_query = $this->input->post();
        $ques = '';
        if (isset($search_query['search'])) {
            $ques = $search_query['search'];
        }
        ;

        $query = $this->JobsModel->get_search_in_anyfield_query($ques);
        $result = $this->JobsModel->get_jobmodel_query_result($query);

        $viewData = array('res' => $result);

        $this->load->view('jobsView', $viewData);
        $this->load->view('footerView');
    }


    function FilterJob()
    {
        $this->load->model('JobsModel');
        $filter_query = $this->input->post();

        $title = '';
        $location = '';
        $skills = '';
        $experience = '';

        if (isset($filter_query['jtitle'])) {
            $title = $filter_query['jtitle'];
        }
        ;
        if (isset($filter_query['jlocation'])) {
            $location = $filter_query['jlocation'];
        }
        ;
        if (isset($filter_query['jskills'])) {
            $skills = $filter_query['jskills'];
        }
        ;
        if (isset($filter_query['jexp'])) {
            $experience = $filter_query['jexp'];
        }
        ;

        $query = $this->JobsModel->filter_jobs_query($title, $location, $skills, $experience);
        $result = $this->JobsModel->get_jobmodel_query_result($query);

        $viewData = array('res' => $result);

        $this->load->view('jobsView', $viewData);
        $this->load->view('footerView');

    }

    // function Sort(){
    //     $this->load->model('JobsModel');

    //     $search_query = $this->input->post();

    //     $ques = '';
    //     if(isset($search_query['search'])){
    //         $ques = $search_query['search'];
    //     };

    //     $query = $this->JobsModel->get_search_in_anyfield_query($ques); 
    //     $result = $this->JobsModel->get_jobmodel_query_result($query);

    //     $viewData = array('res' => $result);

    //     $this->load->view('jobsView', $viewData);
    // 	$this->load->view('footerView');

    // }


    function Apply()
    {
        $this->load->view('jobsApplyView');
    }

    function ApplyStatus()
    {
        $this->load->model('jobApplicationModel');
        $form_data = $this->input->post();

        if ($form_data == null) {
            die;
        }

        $vconfig = array(
            array(
                'field' => 'fullname',
                'label' => 'FullName',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email|trim'
            ),
            array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'You must provide a valid %s.',
                ),
            ),
            array(
                'field' => 'position',
                'label' => 'Position',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'You must provide a valid Job %s.',
                ),
            ),
            array(
                'field' => 'experience',
                'label' => 'Experience',
                'rules' => 'required|numeric|trim',
                'errors' => array(
                    'required' => 'You must provide a valid %s.',
                ),
            ),
            array(
                'field' => 'salary',
                'label' => 'Salary',
                'rules' => 'required|numeric|trim',
                'errors' => array(
                    'required' => 'You must provide a valid %s.',
                ),
            ),
            array(
                'field' => 'coverletter',
                'label' => 'CoverLetter',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'You must provide a valid %s.',
                ),
            ),
        );

        $this->form_validation->set_rules($vconfig);
        $this->form_validation->run();
        $errors = validation_errors();

        if ($errors == FALSE && isset($_FILES['resume'])) {

            $config['upload_path'] = './resume/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = 'resume_' . strval($form_data['phone'] . '');
            $config['max_size'] = 5120;

            $this->load->library('upload', $config);
            $fileinfo = $this->upload->data();

            //The file path need to be adjusted as per codeigniter
            $filepath = $_SERVER['DOCUMENT_ROOT'] . '/codeigniter/resume/' . $fileinfo['file_name'] . ".pdf";
            $ispresent = file_exists($filepath);
            if ($ispresent) {
                unlink($filepath);
            }
            $isuploaded = $this->upload->do_upload('resume');
            $filerror = $this->upload->display_errors();

            if ($isuploaded == TRUE) {
                $is_success = $this->jobApplicationModel->register_applicant($form_data, $fileinfo['full_path']);
                if ($is_success == 0) {
                    $this->load->model('EmailModel');
                    $this->EmailModel->send_applicant_submission_email($form_data['email'],$form_data['fullname'],$form_data['position'],$form_data['phone']);
                    $this->load->view('applicationSuccessView');
                } else {
                    $this->load->view('alertView', array("alertclass" => '', "heading" => "Something went wrong."));
                    $this->load->view('jobsApplyView');
                }
            } else {
                $this->load->view('alertView', array("alertclass" => '', "heading" => "Please choose the correct file format."));
                $this->load->view('jobsApplyView');
            }

        } else {
            $this->load->view('alertView', array("alertclass" => '', "heading" => " Please Fill the form Correctly. "));
            $this->load->view('jobsApplyView');
        }

    }


}



?>