<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{
    function index()
    {
        $this->Login();
    }

    function Login()
    {
        $credentials = $this->input->post();
        $data = $this->security->xss_clean($credentials);

        if (!isset($data['username'])) {
            $this->load->view('employee/employeeLoginView');
            return;
        }
        if (!isset($data['password'])) {
            $this->load->view('employee/employeeLoginView');
            return;
        }

        $this->load->model('EmployeeModel');
        $info = $this->EmployeeModel->check_if_employee_exist($data['username'], $data['password']);

        if ($info['code'] != 0) {
            $this->session->sess_destroy();
            $this->load->view('employee/employeeLoginView', array('error' => 'Login details not found.'));
        } else {
            if (password_verify($data['password'], $info[0]->seemp_pass) && $info[0]->seemp_status == 'active') {
                $sdata = array(
                    'email' => $info[0]->seemp_email,
                    'status' => $info[0]->seemp_status,
                    'empid' => $info[0]->seemp_id,
                    'accesslevel' => $info[0]->seemp_acesslevel,
                    'branch' => $info[0]->seemp_branch,
                    'lastlogin' => $info[0]->seemp_lastlogin,
                );
                $this->session->set_userdata($sdata);

                // 1. Update the Main Employee Table (Last Login Date) if it's a new day
                if (trim($info[0]->seemp_lastlogin) != date('Y-m-d')) {
                    $this->EmployeeModel->update_employee_table_with_today(
                        $info[0]->seemp_id,
                        $info[0]->seemp_email,
                        $info[0]->seseq_id,
                        $info[0]->seemp_status
                    );
                }

                // 2. ALWAYS call the Log update. 
                // The Model will be responsible for not overwriting the first login time.
                $this->EmployeeModel->update_log_current_state($info[0]->seemp_id, 'login');

                redirect('Employee/Dashboard');
            } else {
                $this->session->sess_destroy();
                $this->load->view('employee/employeeLoginView', array('error' => 'Login details not found.'));
            }

        }
    }

    function Dashboard()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') != 'inactive'
        ) {
            if ($this->session->userdata('accesslevel') == 'ADMIN') {
                $this->AdminDashboard();
            }

            if ($this->session->userdata('accesslevel') == 'HR') {
                $this->HRDashboard();
            }



            if ($this->session->userdata('accesslevel') == 'EMPL') {
                $this->EmployeeOverview();
            }
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }

    function AdminDashboard()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('branch') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN'
        ) {
            $this->load->model('EmployeeDetailsModel');
            $this->load->model('jobApplicationModel');
            $this->load->model('ProjectsModel');

            // Fetch employee details from seempdetails table
            $empdetails = $this->EmployeeDetailsModel->get_this_employee_details();


            if (!empty($empdetails) && !empty($empdetails[0]->seempd_name)) {
                $this->session->set_userdata('empname', $empdetails[0]->seempd_name);
            } else {
                $this->session->set_userdata('empname', 'Administrator'); // Fallback only if name is missing
            }


            if (!empty($empdetails) && !empty($empdetails[0]->seempd_jobaid)) {
                $emp_appliction_details = $this->jobApplicationModel->get_applicant_info($empdetails[0]->seempd_jobaid);
                if (!empty($emp_appliction_details)) {
                    $this->session->set_userdata('empapid', $emp_appliction_details[0]->sejoba_id);
                }
            }

            $data = array(
                'projpending' => count($this->ProjectsModel->getPendingProjects()),
                'projrunning' => count($this->ProjectsModel->getRunningProjects()),
                'projcompleted' => count($this->ProjectsModel->getCompletedProjects()),
            );

            $this->load->view('employee/adminHeaderView');
            $this->load->view('employee/adminDashboardView', $data);
        } else {
            $this->session->sess_destroy();
            redirect('Employee/Login');
        }
    }

    // AdminEmployee
    /**
     * HR & ADMIN: View Employee Directory
     */
    public function viewEmployee()
    {
        $access = $this->session->userdata('accesslevel');
        if ($this->session->userdata('status') == 'active' && ($access == 'ADMIN' || $access == 'HR')) {

            $this->load->model('EmployeeModel');
            $postdata = $this->security->xss_clean($this->input->post());

            if (!empty($postdata['query'])) {
                $data['employees'] = $this->EmployeeModel->get_employee_with_search($postdata['query'], $postdata['status'] ?? '');
            } else {
                $data['employees'] = $this->EmployeeModel->getallemployee_with_joins();
            }

            if ($access == 'HR') {
                $this->load->view('hr/hrHeaderView');
                $this->load->view('hr/hrEmployeeDirectoryView', $data);
            } else {
                $this->load->view('employee/adminHeaderView');
                $this->load->view('employee/adminEmployeesView', $data);
            }
        } else {
            redirect('Employee/Login');
        }
    }
    function viewJobApplicants()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN' || $this->session->userdata('accesslevel') == 'HR'
        ) {
            $this->load->model('jobApplicationModel');

            $postd = $this->input->post();

            if ($postd) {
                $postdata = $this->security->xss_clean($postd);

                $id = trim($postdata['applicant_id'] ?? '');
                $status = trim($postdata['status'] ?? '');
                $comment = trim($postdata['comment'] ?? '');

                if ($id != '' && $status != '') {
                    $this->jobApplicationModel->update_applicant_review(
                        $id,
                        $status,
                        $comment
                    );

                    $this->session->set_flashdata('msg', 'Review saved successfully.');
                    redirect('Employee/viewJobApplicants');
                }
            }

            $list = $this->jobApplicationModel->get_all_applicants();

            $data['applicants'] = $list;
            if ($this->session->userdata('accesslevel') == 'HR') {
                $this->load->view('hr/hrHeaderView');
                $this->load->view('hr/hrJobApplicantsView', $data);
                return;
            }
            $this->load->view('employee/adminHeaderView');
            $this->load->view('employee/adminJobApplicationsView', $data);
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }

    // Admin Section forward to view details
    function viewEmployeeDetails()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN' || $this->session->userdata('accesslevel') == 'HR'
        ) {
            $postd = $this->input->post();
            $postdata = $this->security->xss_clean($postd);

            if (isset($postdata['empid'])) {
                $this->load->model('EmployeeModel');
                $data = array();

                $res1 = $this->EmployeeModel->get_employee_with_id($postdata['empid'])[0];
                $data += ['info' => $res1];

                $_POST = [];
                if ($this->session->userdata('accesslevel') == 'HR') {
                    $this->load->view('hr/hrHeaderView');
                    $this->load->view('employee/adminEmployeeDetailsView', $data);
                    return;
                }
                $this->load->view('employee/adminHeaderView');
                $this->load->view('employee/adminEmployeeDetailsView', $data);
            }
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }

    // AdminAttendence and also hr attendance
    function viewAttendance()
    {
        $access = $this->session->userdata('accesslevel');
        // Ensure both ADMIN and HR can access
        if ($this->session->userdata('status') == 'active' && ($access == 'ADMIN' || $access == 'HR')) {

            $this->load->model('AttendanceModel');
            $this->load->model('EmployeeModel');

            $empid_session = $this->session->userdata('empid');

            // 1. ALWAYS fetch today's attendance for the logged-in user for the top card
            $data['todayAttendance'] = $this->AttendanceModel->get_today_login_logout($empid_session);

            $postd = $this->input->post();
            if ($postd) {
                $postdata = $this->security->xss_clean($postd);
                $s_id = trim($postdata['searchempid'] ?? '');
                $start = $postdata['startdate'] ?? '';
                $end = $postdata['enddate'] ?? '';
                // Search logic
                $list = $this->AttendanceModel->find_empid_with_daterange($s_id, $start, $end);
            } else {
                // 2. DEFAULT: Load all attendance logs for the table on initial load
                $list = $this->AttendanceModel->get_attendance_of_all_employee();
            }

            $data['atten'] = $list;

            // 3. Load the correct header based on role
            $header = ($access == 'HR') ? 'hr/hrHeaderView' : 'employee/adminHeaderView';

            $this->load->view($header);
            $this->load->view('employee/adminAttendanceView', $data);

        } else {
            $this->session->sess_destroy();
            redirect('Employee/Login');
        }
    }
    // Admin view fetch job applicants details
    public function getApplicantDetails($id)
    {
        // Authorization Check
        if (!$this->session->has_userdata('empid')) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $this->load->model('jobApplicationModel');

        // Querying directly for a selected applicant
        $this->db->where('sejoba_id', $id);
        $this->db->where('sejoba_state', 'selected');
        $query = $this->db->get('sejobapplicant');
        $applicant = $query->row();

        if ($applicant) {
            echo json_encode(['success' => true, 'data' => $applicant]);
        } else {
            // Provide a clear message if the ID exists but hasn't been "Selected" yet
            echo json_encode(['success' => false, 'message' => 'Applicant not found or not in "Selected" state.']);
        }
    }


    // AdminviewProjects
    function viewProjects()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN'
        ) {
            $this->load->model('ProjectsModel');

            $status = $this->input->get('status');

            if ($status) {
                $projects = $this->ProjectsModel->getProjectsByStatus($status);
            } else {
                $projects = $this->ProjectsModel->getAllProjects();
            }

            $data['projects'] = $projects;

            $data['total'] = $this->ProjectsModel->count_all_projects();
            $data['running'] = $this->ProjectsModel->count_running_projects();
            $data['pending'] = $this->ProjectsModel->count_pending_projects();
            $data['completed'] = $this->ProjectsModel->count_completed_projects();

            $this->load->view('employee/adminHeaderView');
            $this->load->view('employee/adminProjectsView', $data);
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }
    // Add Project
    function addProject()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN'
        ) {
            $this->load->model('ProjectsModel');

            $post = $this->input->post();

            if ($post) {
                $postdata = $this->security->xss_clean($post);

                $data = array(
                    'seproj_name' => $postdata['projectName'],
                    'seproj_desc' => $postdata['description'],
                    'seproj_date' => $postdata['startDate'],
                    'seproj_deadline' => $postdata['deadlineDate'],
                    'seproj_clientid' => $postdata['clientName'],
                    'seproj_headid' => $postdata['projectHead'],
                    'seproj_price' => $postdata['price'],
                    'seproj_status' => strtolower($postdata['status'])
                );
                $this->ProjectsModel->insert_project($data);

                $this->session->set_flashdata('msg', 'Project Added Successfully');
                // $this->load->view('employee/adminHeaderView');
                redirect('Employee/viewProjects');
            }
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }

    function addProjectPage()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN'
        ) {
            $this->load->view('employee/adminHeaderView');
            $this->load->view('employee/addNewProjectView');
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }

    function fetchProject()
    {
        $id = $this->input->post('id');

        $this->load->model('ProjectsModel');

        $project = $this->ProjectsModel->getProjectById($id);

        echo json_encode($project);
    }

    function updateProject()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN'
        ) {
            $this->load->model('ProjectsModel');

            $post = $this->input->post();

            if ($post) {
                $postdata = $this->security->xss_clean($post);

                $projectId = preg_replace('/[^0-9]/', '', $post['projectId']);

                $data = [
                    'seproj_name' => $post['projectName'],
                    'seproj_desc' => $post['description'],
                    'seproj_date' => $post['startDate'],
                    'seproj_deadline' => $post['deadlineDate'],
                    'seproj_clientid' => $post['clientName'],
                    'seproj_headid' => $post['projectHead'],
                    'seproj_price' => $post['price'],
                    'seproj_status' => $post['status']
                ];

                $this->ProjectsModel->update_project($projectId, $data);

                $this->session->set_flashdata('msg', 'Project Updated Successfully');

                redirect('Employee/viewProjects');
            } else {
                $this->session->sess_destroy();
                echo 'INVALID ACCESS';
            }
        }
    }

    // AdminEmployeeRegistration
    function RegisterEmployee()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN' || $this->session->userdata('accesslevel') == 'HR'
        ) {
            $this->load->model('EmployeeModel');
            $post = $this->input->post();
            $data = [];

            if (!empty($post['empid'])) {

                $empid = $post['empid'];

                $emp = $this->EmployeeModel->get_employee_full_details($empid);

                if (!empty($emp)) {
                    $data['emp'] = $emp[0];
                }
            }

            // if ($this->session->userdata('accesslevel') == 'HR') {
            //     $this->load->view('hr/hrHeaderView');
            //     // $this->load->view('hr/hrEmployeeRegistrationView', $data);
            //     return;
            // }else {
            //    $this->load->view('employee/adminHeaderView'); 
            // }
            //ternary operator to decide which view to load based on access level
            $header = ($this->session->userdata('accesslevel') == 'HR') ? 'hr/hrHeaderView' : 'employee/adminHeaderView';
            $this->load->view($header);
            $this->load->view('employee/adminEmployeeRegistrationView', $data);

        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }
    //changed 10/11/2024
    // added cv and photo fields to employee details 
    // public function addEmployee()
    // {
    //     $this->load->library('upload');
    //     $this->load->model('EmployeeModel');

    //     // 1. Prepare Upload Configuration
    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
    //     $config['max_size'] = 5120; // 5MB
    //     $config['encrypt_name'] = TRUE; // Security: rename files to random strings

    //     $this->upload->initialize($config);

    //     // 2. Handle Photo Upload
    //     $photo_name = '';
    //     if (!empty($_FILES['photo']['name'])) {
    //         if ($this->upload->do_upload('photo')) {
    //             $data = $this->upload->data();
    //             $photo_name = $data['file_name'];
    //         }
    //     }

    //     //  Handle CV Upload
    //     $cv_name = '';
    //     if (!empty($_FILES['cv']['name'])) {
    //         if ($this->upload->do_upload('cv')) {
    //             $data = $this->upload->data();
    //             $cv_name = $data['file_name'];
    //         }
    //     }

    //     // Collect all form data
    //     $formData = $this->input->post();

    //     // Prepare data for 'seemployee' table
    //     $employee = [
    //         'seemp_id' => $formData['empid'],
    //         'seemp_branch' => $formData['branch'],
    //         'seemp_email' => $formData['email'],
    //         'seemp_pass' => password_hash($formData['password'], PASSWORD_DEFAULT),
    //         'seemp_status' => strtolower($formData['status']),
    //         'seemp_acesslevel' => $formData['accessLevel']
    //     ];

    //     // Prepare data for 'seempdetails' table
    //     $details = [
    //         'seempd_empid' => $formData['empid'],
    //         'seempd_name' => $formData['empName'],
    //         'seempd_phone' => $formData['phone'],
    //         'seempd_designation' => $formData['designation'],
    //         'seempd_salary' => $formData['salary'],
    //         'seempd_project' => $formData['project'],
    //         'seempd_experience' => $formData['experience'],
    //         'seempd_dob' => $formData['dob'],
    //         'seempd_joiningdate' => $formData['joiningDate'],
    //         'seempd_increment' => $formData['increment'],
    //         'seempd_address_permanent' => $formData['permAddress'],
    //         'seempd_address_current' => $formData['currentAddress'],
    //         'seempd_aadhar' => $formData['aadhar'],
    //         'seempd_pan' => $formData['pan'],
    //         'seempd_img' => $photo_name,
    //         'seempd_cv' => $cv_name
    //     ];

    //     $result = $this->EmployeeModel->register_employee($employee, $details);
    //     if ($result['code'] == 0) {
    //         redirect('Employee/viewEmployee');
    //     } else {
    //         $this->session->set_flashdata('msg', 'Error adding employee: ' . $result['message']);
    //         redirect('Employee/RegisterEmployee');
    //     }
    // }


    // addEmployee function with improved validation and error handling

    public function addEmployee()
    {
        $this->load->library('upload');
        $this->load->model('EmployeeModel');
        $this->load->library('form_validation'); 

        //  Set Validation Rules
        $this->form_validation->set_rules('empName', 'Employee Name', 'required|trim');
        $this->form_validation->set_rules('empid', 'Employee ID', 'required|trim|is_unique[seemployee.seemp_id]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[seemployee.seemp_email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('aadhar', 'Aadhar', 'required|numeric|exact_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('branch', 'Branch', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('accessLevel', 'Access Level', 'required');

        // 2. Check Validation Result
        if ($this->form_validation->run() == FALSE) {
            // Strip HTML tags and separate errors with a standard newline
            $error_msg = strip_tags(validation_errors('', "\n"));
            
            $this->session->set_flashdata('msg', "Validation Failed:\n" . $error_msg);
            redirect('Employee/RegisterEmployee');
            return; 
        }

        //  Prepare Upload Configuration
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);

        // Handle Photo & CV Uploads
        $photo_name = '';
        if (!empty($_FILES['photo']['name']) && $this->upload->do_upload('photo')) {
            $photo_name = $this->upload->data('file_name');
        }

        $cv_name = '';
        if (empty($_FILES['cv']['name'])) {
            $this->session->set_flashdata('msg', 'Error: CV Document is required for new employees.');
            redirect('Employee/RegisterEmployee');
            return;
        } else if ($this->upload->do_upload('cv')) {
            $cv_name = $this->upload->data('file_name');
        } else {
            $this->session->set_flashdata('msg', 'CV Upload Error: ' . strip_tags($this->upload->display_errors('','')));
            redirect('Employee/RegisterEmployee');
            return;
        }

         $formData = $this->input->post();
        
        $employee = [
            'seemp_id' => $formData['empid'],
            'seemp_branch' => $formData['branch'],
            'seemp_email' => $formData['email'],
            'seemp_pass' => password_hash($formData['password'], PASSWORD_DEFAULT),
            'seemp_status' => strtolower($formData['status']),
            'seemp_acesslevel' => $formData['accessLevel']
        ];

        $details = [
            'seempd_empid' => $formData['empid'],
            'seempd_name' => $formData['empName'],
            'seempd_phone' => $formData['phone'],
            'seempd_designation' => $formData['designation'],
            'seempd_salary' => $formData['salary'],
            'seempd_project' => $formData['project'],
            'seempd_experience' => $formData['experience'],
            'seempd_dob' => $formData['dob'],
            'seempd_joiningdate' => $formData['joiningDate'],
            'seempd_increment' => $formData['increment'],
            'seempd_address_permanent' => $formData['permAddress'],
            'seempd_address_current' => $formData['currentAddress'],
            'seempd_aadhar' => $formData['aadhar'],
            'seempd_pan' => $formData['pan'],
            'seempd_img' => $photo_name,
            'seempd_cv' => $cv_name
        ];

        $result = $this->EmployeeModel->register_employee($employee, $details);
        
        if ($result['code'] == 0) {
            $this->session->set_flashdata('msg', 'Employee Added Successfully!');
            redirect('Employee/viewEmployee');
        } else {
            $this->session->set_flashdata('msg', 'Database Error adding employee. ID or Email may already exist.');
            redirect('Employee/RegisterEmployee');
        }
    }
    // updateEmployee function with improved validation, file handling, and error management
    public function updateEmployee($empid)
    {
        $this->load->library('upload');
        $this->load->model('EmployeeModel');
        $this->load->library('form_validation');

        // Fetch current employee details FIRST (Before validation)
        $current = $this->EmployeeModel->get_employee_full_details($empid);
        if (empty($current)) {
            show_error('Employee not found');
        }

        // Set Standard Validation Rules
        $this->form_validation->set_rules('empName', 'Employee Name', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|exact_length[10]');
        $this->form_validation->set_rules('aadhar', 'Aadhar', 'required|numeric|exact_length[12]');

        // Email Uniqueness Check
        $posted_email = $this->input->post('email');
        if (trim($posted_email) !== $current[0]->seemp_email) {
            // They changed the email, so check if the NEW email already belongs to someone else
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[seemployee.seemp_email]',
                array('is_unique' => 'This Email is already registered to another employee.')
            );
        } else {
            // They kept their current email, just validate the format
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        }

        // 4 Employee ID Uniqueness Check (In case they bypassed the readonly HTML)
        $posted_empid = $this->input->post('empid');
        if (trim($posted_empid) !== $current[0]->seemp_id) {
            $this->form_validation->set_rules('empid', 'Employee ID', 'required|trim|is_unique[seemployee.seemp_id]',
                array('is_unique' => 'This Employee ID is already taken.')
            );
        }

        // Password Validation (Only if they typed something)
        if (!empty($this->input->post('password'))) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        }

        // Run Validation
        if ($this->form_validation->run() == FALSE) {
            $error_msg = strip_tags(validation_errors('', "\n"));
            
            $this->session->set_flashdata('msg', "Validation Failed:\n" . $error_msg);
            redirect('Employee/RegisterEmployee'); 
            return;
        }

        // File Upload Config
        $photo_name = $current[0]->seempd_img;
        $cv_name = $current[0]->seempd_cv;

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
        $config['max_size'] = 5120;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);

        // Process Uploads (Only overwrite if new file exists)
        if (!empty($_FILES['photo']['name']) && $this->upload->do_upload('photo')) {
            $photo_name = $this->upload->data('file_name');
        }
        if (!empty($_FILES['cv']['name']) && $this->upload->do_upload('cv')) {
            $cv_name = $this->upload->data('file_name');
        }

        // Update Data
        $updateData = [
            'empName' => $this->input->post('empName'),
            'email' => $this->input->post('email'),
            'branch' => $this->input->post('branch'),
            'status' => $this->input->post('status'),
            'designation' => $this->input->post('designation'),
            'phone' => $this->input->post('phone'),
            'salary' => $this->input->post('salary'),
            'experience' => $this->input->post('experience'),
            'dob' => $this->input->post('dob'),
            'joiningDate' => $this->input->post('joiningDate'),
            'permAddress' => $this->input->post('permAddress'),
            'currentAddress' => $this->input->post('currentAddress'),
            'aadhar' => $this->input->post('aadhar'),
            'pan' => $this->input->post('pan'),
            'accessLevel' => $this->input->post('accessLevel'),
            'project' => $this->input->post('project'),
            'increment' => $this->input->post('increment'),
            'photo' => $photo_name, 
            'cv' => $cv_name     
        ];

        $result = $this->EmployeeModel->update_employee($empid, $updateData);

        if ($result['code'] == 0) {
            $this->session->set_flashdata('msg', 'Employee Updated Successfully');
        } else {
            $this->session->set_flashdata('msg', 'Update failed: ' . $result['message']);
        }
        redirect('Employee/viewEmployee');
    }


    function EmployeeOverview()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'EMPL'
        ) {
            $this->load->model('RequestsModel');
            $holidaycount = $this->RequestsModel->get_holidays_count();

            $this->load->model('EmployeeDetailsModel');

            $empdetails = $this->EmployeeDetailsModel->get_this_employee_details();

            if (empty($empdetails)) {
                echo "Employee details not found";
                return;
            }

            $emp = $empdetails[0];

            $this->session->set_userdata('empname', $emp->seempd_name);

            $data = array(

                'holidays_taken' => $holidaycount,
                'holidays_used' => 20 - $holidaycount,
                'holidays_percent' => 100 * (20 - $holidaycount) / 20,

                'empdetails' => $emp

            );

            $this->load->view('employee/employeeHeaderView');
            $this->load->view('employee/employeeOverView', $data);

        } else {

            $this->session->sess_destroy();
            echo 'INVALID ACCESS';

        }
    }
    function EmployeeAttendence()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'EMPL'
        ) {
            $this->load->model('EmployeeModel');
            $attendeces = $this->EmployeeModel->get_all_loginlog_for_thisempid();

            $data = array(
                'attendence' => $attendeces
            );

            $this->load->view('employee/employeeHeaderView');
            $this->load->view('employee/employeeAttendenceView.php', $data);
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }

    function EmployeeRequest()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'EMPL'
        ) {
            $this->load->model('RequestsModel');
            $data = $this->input->post();
            $postdata = $this->security->xss_clean($data);

            if (isset($postdata['action']) && trim($postdata['action']) == 'requestsubmit') {
                $config = array(
                    array(
                        'field' => 'startdate',
                        'label' => 'StartDate',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'enddate',
                        'label' => 'EndDate',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'reason',
                        'label' => 'Reason',
                        'rules' => 'required|in_list[Medical,Leave,Personal,Business]',
                        'errors' => array(
                            'required' => 'You must provide a valid %s.',
                        ),
                    ),
                    array(
                        'field' => 'summary',
                        'label' => 'Summary',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'You must provide a %s.',
                        ),
                    ),
                );

                $this->form_validation->set_rules($config);
                $this->form_validation->run();

                $errors = validation_errors();
                if ($errors == FALSE) {
                    $this->RequestsModel->addRequest($postdata);
                    $_POST = [];
                }
            }

            $all_requests = $this->RequestsModel->get_requestes_for_thisempid();

            $data = array(
                'requests' => $all_requests
            );

            $this->load->view('employee/employeeHeaderView');
            $this->load->view('employee/employeeRequestView.php', $data);
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }

    function ChangePassword()
    {
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'EMPL'
        ) {
            $post = $this->input->post();
            $postdata = $this->security->xss_clean($post);

            $this->load->model('EmployeeModel');

            if (
                isset($postdata['oldpass']) &&
                isset($postdata['newpass']) &&
                isset($postdata['confirmpass']) &&
                trim($postdata['newpass']) == trim($postdata['confirmpass'])
            ) {
                $config = array(
                    array(
                        'field' => 'oldpass',
                        'label' => 'OldPassword',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'newpass',
                        'label' => 'NewPassword',
                        'rules' => 'required'
                    ),
                    array(
                        'field' => 'confirmpass',
                        'label' => 'ConfirmPassword',
                        'rules' => 'required',
                        'errors' => array(
                            'required' => 'You must provide a valid %s.',
                        ),
                    ),
                );

                $this->form_validation->set_rules($config);
                $this->form_validation->run();

                $errors = validation_errors();
                if ($errors == FALSE) {
                    $issuccess = $this->EmployeeModel->change_employee_password($postdata['oldpass'], $postdata['newpass']);
                    $_POST = [];

                    if ($issuccess['code'] == 0) {
                        $this->Logout();
                    } else {
                        $this->load->view('alertView', ['heading' => 'Error Changing Password']);
                        $this->Dashboard();
                    }
                }
            } else {
                $this->load->view('alertView', ['heading' => 'Password Match Error.']);
                $this->Dashboard();
            }
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }
    // HR Dashboard
    function HRDashboard()
    {
        if ($this->session->userdata('accesslevel') == 'HR' && $this->session->userdata('status') == 'active') {

            // 1. Load Required Models
            $this->load->model('EmployeeModel');
            $this->load->model('AttendanceModel');
            $this->load->model('RequestsModel');
            $this->load->model('jobApplicationModel');

            $empid = $this->session->userdata('empid');

            // Fetch Logged-in HR Details
            $emp_details = $this->EmployeeModel->get_employee_with_id($empid);
            if (!empty($emp_details) && !empty($emp_details[0]->seempd_name)) {
                $this->session->set_userdata('empname', $emp_details[0]->seempd_name);
            } else {
                $this->session->set_userdata('empname', 'HR Manager');
            }

            $data['todayAttendance'] = $this->AttendanceModel->get_today_login_logout($empid);

            // Fetch Dashboard Statistics
            $data['total_staff'] = $this->EmployeeModel->get_total_staff_count();
            $data['pending_count'] = $this->RequestsModel->get_pending_requests_count();
            $data['new_applicants'] = $this->jobApplicationModel->get_new_applicants_count();
            $data['present_today'] = $this->AttendanceModel->get_present_today_count();

            // Fetch Lists for Dashboard Tables
            $data['today_attendance'] = $this->AttendanceModel->get_today_attendance_list();
            $data['recent_leaves'] = $this->RequestsModel->get_pending_leaves_with_balance();
            $data['recent_applicants'] = $this->jobApplicationModel->get_recent_applicants(5);

            // Load Views
            $this->load->view('hr/hrHeaderView');
            $this->load->view('hr/hrDashboardView', $data);

        } else {
            redirect('Employee/Login');
        }
    }
    /**
     * Process Leave Decisions from Dashboard
     */
    public function updateLeaveStatus($id, $status)
    {
        // Authorization Check
        if ($this->session->userdata('accesslevel') != 'HR') {
            show_error('Unauthorized access', 403);
        }

        $valid_statuses = ['approved', 'rejected'];
        if (in_array($status, $valid_statuses)) {
            // Update the seemprequests table status
            $this->db->where('seemrq_id', $id);
            $this->db->update('seemprequests', ['seemrq_status' => $status]);

            $this->session->set_flashdata('msg', 'Leave request has been ' . $status);
        }

        // Redirect back to the dashboard to refresh the table
        redirect('Employee/Dashboard');
    }

    // Process Hiring Decisions from Dashboard
    public function updateHiringStatus($id, $state)
    {
        if ($this->session->userdata('accesslevel') != 'HR') {
            show_error('Unauthorized', 403);
        }

        $this->db->where('sejoba_id', $id);
        $this->db->update('sejobapplicant', ['sejoba_state' => $state]);

        redirect('Employee/Dashboard');
    }
    /**
     * HR Attendance Monitoring
     */
    public function hrAttendance()
    {
        if ($this->session->userdata('accesslevel') == 'HR') {
            $this->load->model('AttendanceModel');

            // FIX 1: Fetch the HR's specific login/logout times for the left card
            $empid = $this->session->userdata('empid');
            $data['todayAttendance'] = $this->AttendanceModel->get_today_login_logout($empid);

            // Get all logs to show HR the history in the right table
            $data['atten'] = $this->AttendanceModel->get_attendance_of_all_employee();

            $this->load->view('hr/hrHeaderView');
            // Reusing the Admin Attendance View for data consistency
            $this->load->view('employee/adminAttendanceView', $data);
        } else {
            redirect('Employee/Login');
        }
    }

    // Logout Function
    function Logout()
    {
        $this->load->model('EmployeeModel');
        $sion = $this->session->userdata('empid');
        $this->EmployeeModel->update_log_current_state($sion, 'logout');
        $this->session->unset_userdata(['empid', 'email', 'accesslevel', 'branch', 'status']);
        $this->session->sess_destroy();
        $this
            ->output
            ->set_header('Cache-Control: no-store, no-cache, must-revalidate')
            ->set_header('Pragma: no-cache');
        redirect('Employee/Login');
    }

     

    /**
     * Reset Employee Functionality
     */
    public function resetEmployee($empid = '')
    {
        if (!$this->session->has_userdata('empid') || $this->session->userdata('accesslevel') != 'ADMIN') {
            redirect('login');
            return;
        }

        // Reset password to default
        $default_password = 'temp123456';
        $hashed_password = password_hash($default_password, PASSWORD_DEFAULT);

        $result = $this->EmployeeModel->reset_employee_password($empid, $hashed_password);

        if ($result['code'] == 0) {
            $this->session->set_flashdata('success', 'Employee password reset successfully. Default password: temp123456');
        } else {
            $this->session->set_flashdata('error', 'Failed to reset employee password');
        }

        redirect('Employee/viewEmployee');
    }

    /**
     * Get Employee for Edit via AJAX
     */
    public function getEmployeeForEdit($empid = '')
    {
        if (!$this->session->has_userdata('empid') || $this->session->userdata('accesslevel') != 'ADMIN') {
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }

        $employee = $this->EmployeeModel->get_employee_full_details($empid);

        if (!empty($employee)) {
            echo json_encode([
                'success' => true,
                'data' => $employee[0]
            ]);
        } else {
            echo json_encode(['error' => 'Employee not found']);
        }
    }

    public function sendInterviewInvite()
    {
        $this->load->model('InterviewModel');
        $this->load->model('jobApplicationModel'); // Step 3: Load model

        $post = $this->security->xss_clean($this->input->post());

        $email = $post['email'];
        $name = $post['name'];
        $position = $post['position'];
        $phone = $post['phone'];
        $applicant_id = $post['applicant_id']; // Step 3: Get applicant ID

        $date = $post['interview_date'];
        $time = $post['interview_time'];
        $location = $post['location'];

        $hr_name = $this->session->userdata('empname') ?? 'HR Team';

        // Step 3: Save to database first
        $interview_data = array(
            'date' => $date,
            'time' => $time,
            'location' => $location,
            'scheduled_by' => $hr_name
        );

        $db_result = $this->jobApplicationModel->schedule_interview($applicant_id, $interview_data);

        if ($db_result['code'] == 0) {
            // Database save successful, now send emails
            $email_result = $this->InterviewModel->send_interview_email(
                $email,
                $name,
                $position,
                $date,
                $time,
                $location,
                $phone,
                $hr_name
            );

            if ($email_result == 0) {
                $this->session->set_flashdata('msg', 'Interview Invitation Sent Successfully and Saved to Database');
            } else {
                $this->session->set_flashdata('error', 'Interview saved but email failed to send');
            }
        } else {
            $this->session->set_flashdata('error', 'Failed to save interview to database: ' . $db_result['message']);
        }

        redirect('Employee/viewJobApplicants');
    }
    public function viewScheduledInterviews()
    {
        if (!$this->session->has_userdata('empid') || $this->session->userdata('accesslevel') != 'HR') {
            redirect('login');
            return;
        }

        $this->load->model('jobApplicationModel');
        $data['interviews'] = $this->jobApplicationModel->get_interview_scheduled_applicants();

        $this->load->view('hr/hrHeaderView');
        $this->load->view('hr/scheduledInterviewsView', $data);
    }
}

?>