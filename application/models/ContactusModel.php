<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactusModel extends CI_Model
{
    /**
     * Inserts contact data and triggers notifications
     * Optimized for AJAX response speed
     */
    public function insertConactus($data)
    {
        $contact_info = array(
            'secon_name'    => $data['name'],
            'secon_email'   => $data['email'],
            'secon_subject' => $data['subject'],
            'secon_message' => $data['message'],
            'secon_action'  => 'none',
        );

        // Start Transaction
        $this->db->trans_start();
        $this->db->insert('secontactus', $contact_info);
        $this->db->trans_complete();

        $db_error = $this->db->error();

        // If DB insertion was successful, handle emails
        if ($this->db->trans_status() === TRUE && $db_error['code'] == 0) {
            // We return success immediately to the controller so the user sees the popup,
            // even if the SMTP server takes a few seconds to respond.
            $this->send_contact_notification_email($data);
            return ['code' => 0, 'message' => 'Success'];
        }

        return $db_error;
    }

    /**
     * Handles background email notifications
     */
    private function send_contact_notification_email($contact_data)
    {
        $this->load->library('email');

        // Configure standard SMTP or Mail settings here if needed
        $this->email->set_newline("\r\n");

        // 1. Send Confirmation to the User
        $this->email->from('hr@suropriyo.in', 'Suropriyo Enterprise');
        $this->email->to($contact_data['email']);
        $this->email->subject('Message Received - Suropriyo Enterprise');
        
        $user_email_content = $this->load->view('email/emailContactConfirmationView', $contact_data, TRUE);
        $this->email->message($user_email_content);
        $this->email->send();

        // 2. Send Notification to Admin
        $this->email->clear(); // Clear previous settings for the next email
        $this->email->from('hr@suropriyo.in', 'System Notification');
        $this->email->to('suropriyoenterprise@gmail.com'); 
        $this->email->subject('New Lead: ' . $contact_data['subject']);
        
        $admin_data = $contact_data;
        $admin_data['contact_date'] = date('Y-m-d H:i:s');
        
        $admin_email_content = $this->load->view('email/emailContactAdminView', $admin_data, TRUE);
        $this->email->message($admin_email_content);
        $this->email->send();
    }
}