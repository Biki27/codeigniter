<?php
// Suropriyo Enterprise
// Howrah

defined('BASEPATH') OR exit('No direct script access allowed');

class ContactusModel extends CI_Model
{
    function insertConactus($data)
    {
        $contact_info = array(
            'secon_name' => $data['name'],
            'secon_email' => $data['email'],
            'secon_subject' => $data['subject'],
            'secon_message' => $data['message'],
            'secon_action' => 'none',
        );

        $this->db->trans_start();
        $this->db->insert('secontactus', $contact_info);
        $issucess = $this->db->error();
        $this->db->trans_complete();

        // Send email notification only if DB insert succeeded
        if ($issucess['code'] == 0) {
            $this->send_contact_notification_email($data);
        }

        return $issucess;
    }

    // Send contact notification emails
    function send_contact_notification_email($contact_data = array())
    {
        $this->load->helper('email');
        $this->load->library('email');

        // Validate user email
        if (!filter_var($contact_data['email'], FILTER_VALIDATE_EMAIL)) {
            return 1;
        }

        // Fetch values from .env
        $from_email  = getenv('SYSTEM_EMAIL_FROM');
        $from_name   = getenv('SYSTEM_EMAIL_NAME');
        $admin_email = getenv('ADMIN_CONTACT_EMAIL');

        $this->email->set_newline("\r\n");

        // --- 1. Send confirmation to the person who contacted ---
        $this->email->from($from_email, $from_name);
        $this->email->to($contact_data['email']);

        $view_data = array(
            'name' => $contact_data['name'],
            'subject' => $contact_data['subject'],
            'message' => $contact_data['message']
        );

        $this->email->subject($from_name . ' - Contact Form Received');
        $this->email->message($this->load->view('email/emailContactConfirmationView', $view_data, TRUE));
        $this->email->send();

        // --- 2. Send notification to the Admin ---
        $admindata = array(
            'name' => $contact_data['name'],
            'email' => $contact_data['email'],
            'subject' => $contact_data['subject'],
            'message' => $contact_data['message'],
            'contact_date' => date('Y-m-d H:i:s')
        );

        $this->email->from($from_email, $from_name);
        $this->email->to($admin_email);
        $this->email->subject($from_name . ' - New Contact Form Submission');
        $this->email->message($this->load->view('email/emailContactAdminView', $admindata, TRUE));

        $this->email->send();
        return 0;
    }
}