<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    // change smtp_pass app password 
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.gmail.com';
    $config['smtp_port'] = 587;
    $config['smtp_user'] = 'satyajitmanna35@gmail.com';
    $config['smtp_pass'] = 'jaeoqxyjmmsvjfdz';
    $config['smtp_crypto'] = 'tls';
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['crlf'] = "\r\n";
    $config['wordwrap'] = TRUE;
?>