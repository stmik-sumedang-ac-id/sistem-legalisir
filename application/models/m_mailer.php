<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class m_mailer extends CI_Model {
  function config(){
            $config['protocol']  = 'smtp';
            $config['smtp_host'] = 'smtp.gmail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'info@stmik-sumedang.ac.id';
            $config['smtp_pass'] = '';
            $config['mailtype']  = 'html';
            $config['charset']   = 'utf-8';
            
            // $this->email->initialize($config);
            // $this->mail->set_newline("\r\n");

           // TES MAIL
            //$result = $this->email->send();
  }
    
} 


// $config = Array(
//   'protocol' => 'smtp',
//   'smtp_host' => 'ssl://smtp.googlemail.com',
//   'smtp_port' => 465,
//   'smtp_user' => 'xxx',
//   'smtp_pass' => 'xxx',
//   'mailtype'  => 'html', 
//   'charset'   => 'iso-8859-1'
// );
// $this->load->library('email', $config);
// $this->email->set_newline("\r\n");

// Set to, from, message, etc.
      
// $result = $this->email->send(); 