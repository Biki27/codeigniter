<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    // change smtp_pass app password 
    $config['protocol'] = 'mail';
    $config['smtp_auth'] = TRUE;
    $config['smtp_host'] = 'mail.suropriyo.in';
    $config['smtp_port'] = 465;
    $config['smtp_user'] = 'hr@suropriyo.in';
    $config['smtp_pass'] = 'Suropriyo@123';
    $config['smtp_crypto'] = 'ssl';
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['crlf'] = "\r\n";
    $config['wordwrap'] = TRUE;
?>