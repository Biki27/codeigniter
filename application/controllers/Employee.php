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

            // if ($this->session->userdata('accesslevel') == 'MANAGER') {
            //     $this->ManagerDashboard();
            // }

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

        $empdetails = $this->EmployeeDetailsModel->get_this_employee_details();
        
        // CHECK: Does this employee have a linked job application ID?
        if (!empty($empdetails) && !empty($empdetails[0]->seempd_jobaid)) {
            $emp_appliction_details = $this->jobApplicationModel->get_applicant_info($empdetails[0]->seempd_jobaid);
            
            // CHECK: Was an application actually found in the database?
            if (!empty($emp_appliction_details)) {
                $this->session->set_userdata('empname', $emp_appliction_details[0]->sejoba_name);
                $this->session->set_userdata('empapid', $emp_appliction_details[0]->sejoba_id);
            } else {
                $this->session->set_userdata('empname', 'Administrator'); // Fallback name
            }
        } else {
            $this->session->set_userdata('empname', 'Administrator'); // Fallback name
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
        if (
            $this->session->has_userdata('empid') &&
            $this->session->has_userdata('email') &&
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN' || $this->session->userdata('accesslevel') == 'HR'

        ) {
            $this->load->model('AttendanceModel');
            $postd = $this->input->post();
            $empid = $this->session->userdata('empid'); 
            $todayAttendance = $this->AttendanceModel->get_today_login_logout($empid);
            $data['todayAttendance'] = $todayAttendance;

            $list = $this->AttendanceModel->get_attendance_of_all_employee();

            if ($postd) {
                $postdata = $this->security->xss_clean($postd);

                $empid = trim($postdata['searchempid'] ?? '');
                $start = trim($postdata['startdate'] ?? '');
                $end = trim($postdata['enddate'] ?? '');

                if ($empid == '' && $start == '' && $end == '') {
                    $data['alert'] = 'Please enter at least one search value.';
                } else if ($empid != '' && $start == '' && $end == '') {
                    $list = $this->AttendanceModel->find_attendance_for_employee_id($empid);
                } else if ($empid == '' && $start != '' && $end == '') {
                    $list = $this->AttendanceModel->find_from_startdate($start);
                } else if ($empid == '' && $start == '' && $end != '') {
                    $list = $this->AttendanceModel->find_until_enddate($end);
                } else if ($empid == '' && $start != '' && $end != '') {
                    $list = $this->AttendanceModel->find_by_daterange($start, $end);
                } else {
                    $list = $this->AttendanceModel->find_empid_with_daterange($empid, $start, $end);
                }
            }
            // for hr attendance view
            if ($this->session->userdata('accesslevel') == 'HR') {
                
                $this->load->view('hr/hrHeaderView');
                $this->load->view('hr/hrAttendenceView', $data);
                return;
            }
            $data['atten'] = $list;
            $this->load->view('employee/adminHeaderView');
            $this->load->view('employee/adminAttendanceView', $data);


        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
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
            if ($this->session->userdata('accesslevel') == 'HR') {
                $this->load->view('hr/hrHeaderView');
                $this->load->view('hr/hrEmployeeRegistrationView', $data);
                return;
            }

            $this->load->view('employee/adminHeaderView');
            $this->load->view('employee/adminEmployeeRegistrationView', $data);

        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
        }
    }
    //changed 10/11/2024
    // added cv and photo fields to employee details 


    public function addEmployee()
    {
        $this->load->library('upload');
        $this->load->model('EmployeeModel');

        // 1. Prepare Upload Configuration
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE; // Security: rename files to random strings

        $this->upload->initialize($config);

        // 2. Handle Photo Upload
        $photo_name = '';
        if (!empty($_FILES['photo']['name'])) {
            if ($this->upload->do_upload('photo')) {
                $data = $this->upload->data();
                $photo_name = $data['file_name'];
            }
        }

        //  Handle CV Upload
        $cv_name = '';
        if (!empty($_FILES['cv']['name'])) {
            if ($this->upload->do_upload('cv')) {
                $data = $this->upload->data();
                $cv_name = $data['file_name'];
            }
        }

        // Collect all form data
        $formData = $this->input->post();

        // Prepare data for 'seemployee' table
        $employee = [
            'seemp_id' => $formData['empid'],
            'seemp_branch' => $formData['branch'],
            'seemp_email' => $formData['email'],
            'seemp_pass' => password_hash($formData['password'], PASSWORD_DEFAULT),
            'seemp_status' => strtolower($formData['status']),
            'seemp_acesslevel' => $formData['accessLevel']
        ];

        // Prepare data for 'seempdetails' table
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
            redirect('Employee/viewEmployee');
        } else {
            $this->session->set_flashdata('msg', 'Error adding employee: ' . $result['message']);
            redirect('Employee/RegisterEmployee');
        }
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
        // Security check for HR access level
        if ($this->session->userdata('accesslevel') == 'HR' && $this->session->userdata('status') == 'active') {

            // 1. Fetch Quick Statistics from Database
            $data['total_staff'] = $this->db->count_all('seemployee');
            $data['pending_count'] = $this->db->where('seemrq_status', 'pending')->count_all_results('seemprequests');
            $data['new_applicants'] = $this->db->where('sejoba_state', 'applied')->count_all_results('sejobapplicant');
            $data['present_today'] = $this->db->where('seemp_logdate', date('Y-m-d'))->count_all_results('seemployeeloginlog');

            // 2. Fetch Today's Attendance with Login/Logout Times
            $this->load->model('AttendanceModel');
            $today = date('Y-m-d');
            
            $this->db->select('l.*, d.seempd_name, d.seempd_designation');
            $this->db->from('seemployeeloginlog l');
            $this->db->join('seempdetails d', 'l.seemp_logempid = d.seempd_empid', 'left');
            $this->db->where('l.seemp_logdate', $today);
            $this->db->order_by('l.seemp_logintime', 'ASC');
            $data['today_attendance'] = $this->db->get()->result();

            // 3. Fetch Pending Leave Requests with Leave Balance Logic
            $current_year = date('Y');

            // We use 'r' as an alias for 'seemprequests' to avoid column name conflicts
            $this->db->select('r.*, d.seempd_name, 
            (SELECT SUM(seemrq_days) FROM seemprequests 
             WHERE seemrq_empid = r.seemrq_empid 
             AND seemrq_status = "approved" 
             AND YEAR(seemrq_reqdate) = ' . $current_year . ') as total_taken');

            $this->db->from('seemprequests r');
            $this->db->join('seemployee e', 'r.seemrq_empid = e.seemp_id');
            $this->db->join('seempdetails d', 'e.seemp_id = d.seempd_empid');
            $this->db->where('r.seemrq_status', 'pending');

            // Use the alias 'r' and the correct column name 'seemrq_reqdate'
            $this->db->order_by('r.seemrq_reqdate', 'DESC');

            $data['recent_leaves'] = $this->db->get()->result_array();

            // 4. Fetch Recent Recruitment Activity
            $this->db->order_by('sejoba_atime', 'DESC');
            $this->db->limit(5);
            $data['recent_applicants'] = $this->db->get('sejobapplicant')->result_array();

            // Load sequential views for the HR Portal
            $this->load->view('hr/hrHeaderView');
            $this->load->view('hr/hrDashboardView', $data);
        } else {
            // Redirect unauthorized users back to login
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

    /**
     * Recruitment Decision Handler
     */
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
            // Get all logs to show HR the history
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

    //  Update Employee Functionality
    public function updateEmployee($empid)
    {
        $this->load->library('upload');
        $this->load->model('EmployeeModel');

        // 1. Fetch current data to keep existing files if no new ones are uploaded
        $current = $this->EmployeeModel->get_employee_full_details($empid);
        if (empty($current)) {
            show_error('Employee not found');
        }
        $old_photo = $current[0]->seempd_img;
        $old_cv = $current[0]->seempd_cv;

        // 2. Configure Upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx';
        $config['max_size'] = 5120;
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);

        // 3. Process Photo
        $photo_name = $old_photo;
        if (!empty($_FILES['photo']['name'])) {
            if ($this->upload->do_upload('photo')) {
                $photo_name = $this->upload->data('file_name');
            }
        }

        // 4. Process CV
        $cv_name = $old_cv;
        if (!empty($_FILES['cv']['name'])) {
            if ($this->upload->do_upload('cv')) {
                $cv_name = $this->upload->data('file_name');
            }
        }

        // 5. Prepare data matching the Model's expected keys
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
            'photo' => $photo_name, // Must match Model key
            'cv' => $cv_name     // Must match Model key
        ];

        $result = $this->EmployeeModel->update_employee($empid, $updateData);

        if ($result['code'] == 0) {
            $this->session->set_flashdata('msg', 'Employee Updated Successfully');
            redirect('Employee/viewEmployee'); // Redirect to list view
        } else {
            echo "Update failed: " . $result['message'];
        }
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