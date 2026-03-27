<?php
// Suropriyo Eterprise
// Howrah
// fixed By SM
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailModel extends CI_Model
{
    function send_applicant_submission_email($email = '', $aplicantname = '', $jobposition = '', $phone = '')
    {
        $this->load->helper('email');
        $this->load->library('email');

        if (!filter_var($email)) {
            return 1;
        }

        $this->email->set_newline("\r\n");
        
        // Applicant Email
        $this->email->from('hr@suropriyo.in', 'Suropriyo Enterprise');
        $this->email->to($email);
        $this->email->cc('');
        $this->email->bcc('');

        $data = array(
            'name' => $aplicantname,
            'position' => $jobposition
        );

        $this->email->subject('Suropriyo Enterprise - Application Received.');
        $this->email->message($this->load->view('email/emailApplicantView', $data, TRUE));
        $this->email->send();
        echo $this->email->print_debugger();

        // Admin Email
        $admindata = array(
            'email' => $email,
            'name' => $aplicantname,
            'position' => $jobposition,
            'phone' => $phone
        );

        $this->email->from('hr@suropriyo.in', 'Suropriyo Enterprise');
        $this->email->to('eshitasen07@gmail.com');
        $this->email->cc('');
        $this->email->bcc('');
        $this->email->subject('Suropriyo Enterprise - Application Received.');
        $this->email->message($this->load->view('email/emailAdminView', $admindata, TRUE));

        $this->email->send();
        echo $this->email->print_debugger();
        return 0;
    }
}

?>