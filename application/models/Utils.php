<?php

/**
 * Description of Utils
 *
 * @author jhonj
 */
class Utils extends CI_Model {

    public function sendMail($mail, $subject, $template, $content) {
        $data['content'] = $content;
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['protocol'] = 'mail';
        $config['smtp_host'] = 'mail.hosting4world.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'jhon.valdes@instasoft.com.co';
        $config['smtp_pass'] = 'jhV_3103';
        $config['validation'] = TRUE;
        $this->email->initialize($config);
        $this->email->clear();
        $this->email->from('jhon.valdes@instasoft.com.co', 'Unisoft');
        $this->email->to($mail);
        //$this->email->cc($destination);
        //$this->email->bcc($destination);
        $this->email->subject($subject);
        $body = $this->load->view($template, $data, TRUE);
        $this->email->message($body);
        $this->email->send();
    }

}
