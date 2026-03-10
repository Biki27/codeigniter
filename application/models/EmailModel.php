<?php
// This code is Written by :
// PAPPU BISWAS
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

        if (!valid_email($email)) {
            return 1;
        }
        
        $this->email->set_newline("\r\n");
        // Applicant Email
        $this->email->from('satyajitmanna35@gmail.com', 'Suropriyo Enterprise');
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
        
         // Admin Email
        $admindata = array(
            'email' => $email,
            'name' => $aplicantname,
            'position' => $jobposition,
            'phone' => $phone
        );

        $this->email->from('satyajitmanna35@gmail.com', 'Test');
        $this->email->to('goutam201shaw@gmail.com');
        $this->email->cc('');
        $this->email->bcc('');
        $this->email->subject('Suropriyo Enterprise - Application Received.');
        $this->email->message($this->load->view('email/emailAdminView', $admindata, TRUE));

        $this->email->send();
        return 0;
    }
}

?>