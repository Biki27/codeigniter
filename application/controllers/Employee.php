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

                if (
                    trim($this->session->userdata('lastlogin')) == '' ||
                    trim($this->session->userdata('lastlogin')) != date('Y-m-d')
                ) {
                    $this->EmployeeModel->update_employee_table_with_today(
                        $info[0]->seemp_id,
                        $info[0]->seemp_email,
                        $info[0]->seseq_id,
                        $info[0]->seemp_status
                    );

                    $this->EmployeeModel->update_log_current_state($info[0]->seemp_id);
                }
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
            $this->session->has_userdata('accesslevel') &&
            $this->session->has_userdata('branch') &&
            $this->session->has_userdata('status') &&
            $this->session->userdata('status') == 'active' &&
            $this->session->userdata('accesslevel') == 'ADMIN'
        ) {
            $this->load->model('EmployeeDetailsModel');
            $this->load->model('jobApplicationModel');
            $this->load->model('ProjectsModel');

            $empdetails = $this->EmployeeDetailsModel->get_this_employee_details();
            $emp_appliction_details = $this->jobApplicationModel->get_applicant_info($empdetails[0]->seempd_jobaid);

            $this->session->set_userdata('empname', $emp_appliction_details[0]->sejoba_name);
            $this->session->set_userdata('empapid', $emp_appliction_details[0]->sejoba_id);

            $pendingproj = count($this->ProjectsModel->getPendingProjects());
            $completedproj = count($this->ProjectsModel->getCompletedProjects());
            $runningproj = count($this->ProjectsModel->getRunningProjects());

            $data = array(
                'projpending' => $pendingproj,
                'projrunning' => $runningproj,
                'projcompleted' => $completedproj,
            );

            $this->load->view('employee/adminHeaderView');
            $this->load->view('employee/adminDashboardView', $data);
        } else {
            $this->session->sess_destroy();
            echo 'INVALID ACCESS';
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


    // HR & ADMIN: View Recruitment / Job Applicants

    // function viewJobApplicants()
    // {
    //     $access = $this->session->userdata('accesslevel');
    //     if ($this->session->userdata('status') == 'active' && ($access == 'ADMIN' || $access == 'HR')) {

    //         $this->load->model('jobApplicationModel');
    //         $data['applicants'] = $this->jobApplicationModel->get_all_applicants();

    //         $header = ($access == 'HR') ? 'hr/hrHeaderView' : 'employee/adminHeaderView';

    //         $this->load->view($header);
    //         // Reusing existing admin view for applicants
    //         $this->load->view('employee/adminJobApplicationsView', $data);
    //     } else {
    //         redirect('Employee/Login');
    //     }
    // }
    //
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


    public function addEmployee()
    {
        if (!$this->session->has_userdata('empid')) {
            echo 'Unauthorized Access';
            return;
        }

        $post = $this->input->post();
        $data = $this->security->xss_clean($post);

        $this->load->model('EmployeeModel');

        $employee = [
            'seemp_id' => $data['empId'],
            'seemp_branch' => strtoupper($data['branch']),
            'seemp_email' => $data['email'],
            'seemp_pass' => password_hash($data['password'], PASSWORD_DEFAULT),
            'seemp_status' => strtolower($data['status']),
            'seemp_acesslevel' => strtoupper($data['accessLevel'])

        ];

        $details = [

            'seempd_empid' => $data['empId'],
            'seempd_name' => $data['empName'],
            'seempd_phone' => $data['phone'],
            'seempd_designation' => $data['designation'],
            'seempd_salary' => $data['salary'],
            'seempd_project' => $data['project'],
            'seempd_experience' => $data['experience'],
            'seempd_jobaid' => $data['applicantId'],
            'seempd_dob' => $data['dob'],
            'seempd_joiningdate' => $data['joiningDate'],
            'seempd_increment' => $data['increment'],
            'seempd_address_permanent' => $data['permAddress'],
            'seempd_address_current' => $data['currentAddress'],
            'seempd_aadhar' => $data['aadhar'],
            'seempd_pan' => $data['pan']
        ];

        $result = $this->EmployeeModel->register_employee($employee, $details);

        if ($result['code'] == 0) {

            redirect('Employee/viewEmployee');

        } else {

            echo "Error adding employee";

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

            // 2. Fetch Pending Leave Requests with Leave Balance Logic
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

            // 3. Fetch Recent Recruitment Activity
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




    function ManagerDashboard()
    {
        if (
            $this->session->userdata('accesslevel') == 'MANAGER' &&
            $this->session->userdata('status') == 'active'
        ) {
            $this->load->model('EmployeeDetailsModel');
            $this->load->model('jobApplicationModel');
            $this->load->model('ProjectsModel');

            $empdetails = $this->EmployeeDetailsModel->get_this_employee_details();
            $emp_appliction_details = $this->jobApplicationModel->get_applicant_info($empdetails[0]->seempd_jobaid);

            $this->session->set_userdata('empname', $emp_appliction_details[0]->sejoba_name);
            $this->session->set_userdata('empapid', $emp_appliction_details[0]->sejoba_id);

            $pendingproj = count($this->ProjectsModel->getPendingProjects());
            $compleatedproj = count($this->ProjectsModel->getCompletedProjects());
            $runningproj = count($this->ProjectsModel->getRunningProjects());

            $data = array(
                'projpending' => $pendingproj,
                'projrunning' => $runningproj,
                'projcompleated' => $compleatedproj,
            );

            $this->load->view('employee/managerHeaderView');
            $this->load->view('employee/managerDashboardView', $data);
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
    public function updateEmployee($empid = '')
    {
        if (!$this->session->has_userdata('empid') || $this->session->userdata('accesslevel') != 'ADMIN') {
            redirect('login');
            return;
        }
        $this->load->model('EmployeeModel'); // FIX

        if ($this->input->post()) {
            $post = $this->input->post();
            $data = $this->security->xss_clean($post);

            $result = $this->EmployeeModel->update_employee($empid, $data);

            if ($result['code'] == 0) {
                $this->session->set_flashdata('success', 'Employee updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Failed to update employee');
            }

            redirect('Employee/viewEmployee');
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
        $applicant_id = $this->input->post('applicant_id');
        $interview_date = $this->input->post('interview_date');
        $interview_time = $this->input->post('interview_time');

        // get applicant details
        $applicant = $this->EmployeeModel->getApplicantById($applicant_id);

        // save interview date and time
        $data = [
            'interview_date' => $interview_date,
            'interview_time' => $interview_time
        ];
        

        $this->EmployeeModel->updateInterview($applicant_id, $data);

        // send email
        $this->load->library('email');

        $this->email->from('satyajitmanna35@gmail.com', 'Supropriyo Enterprise');
        $this->email->to($applicant->sejoba_email);
        $this->email->subject('Interview Invitation');

        $message = "
        Dear {$applicant->sejoba_name}, <br><br>

        Congratulations! You have been shortlisted for the position of <b>{$applicant->sejoba_position}</b>.<br><br>

        Interview Details:<br>
        Date: {$interview_date}<br>
        Time: {$interview_time}<br><br>

        Please be available on time.<br><br>

        Best Regards,<br>
        Supropriyo Enterprise
    ";

        $this->email->message($message);

        if ($this->email->send()) {
            $this->session->set_flashdata('msg', 'Interview invitation sent successfully');
        } else {
            $this->session->set_flashdata('msg', 'Email sending failed');
        }

        redirect('Employee/viewJobApplicants');
    }
}

?>