<?php

// This code is Written by :
// PAPPU BISWAS 
// Suropriyo Eterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');

class ContactusModel extends CI_Model
{

    function insertConactus($data)
    {

        $contact_info = array(
            // 'secon_id' => '',
            'secon_name' => $data['name'],
            'secon_email' => $data['email'],
            'secon_subject' => $data['subject'],
            'secon_message' => $data['message'],
            'secon_action' => 'none',
            // 'secon_actioncomment' => ''
        );

        $this->db->trans_start();

        $this->db->insert('secontactus', $contact_info);
        $issucess = $this->db->error();

        $this->db->trans_complete();

        // Send email notification
        if ($issucess['code'] == 0) {
            $this->send_contact_notification_email($data);
        }

        return $issucess;
    }

    //  Send contact notification email to admin
    function send_contact_notification_email($contact_data = array())
    {
        $this->load->helper('email');
        $this->load->library('email');

        // Validate email
        if (!valid_email($contact_data['email'])) {
            return 1;
        }

        $this->email->set_newline("\r\n");

        // Send confirmation to person who contacted
        $this->email->from('satyajitmanna35@gmail.com', 'Suropriyo Enterprise');
        $this->email->to($contact_data['email']);
        $this->email->cc('');
        $this->email->bcc('');

        $data = array(
            'name' => $contact_data['name'],
            'subject' => $contact_data['subject'],
            'message' => $contact_data['message']
        );

        $this->email->subject('Suropriyo Enterprise - Contact Form Received');
        $this->email->message($this->load->view('email/emailContactConfirmationView', $data, TRUE));
        $this->email->send();

        // Send notification to admin
        $admindata = array(
            'name' => $contact_data['name'],
            'email' => $contact_data['email'],
            'subject' => $contact_data['subject'],
            'message' => $contact_data['message'],
            'contact_date' => date('Y-m-d H:i:s')
        );
        // Admin email
        $this->email->from('satyajitmanna35@gmail.com', 'Suropriyo Enterprise');
        $this->email->to('satyajitmanna2024@gmail.com'); 
        $this->email->cc('');
        $this->email->bcc('');
        $this->email->subject('Suropriyo Enterprise - New Contact Form Submission');
        $this->email->message($this->load->view('email/emailContactAdminView', $admindata, TRUE));

        $this->email->send();
        return 0;
    }


}

?>