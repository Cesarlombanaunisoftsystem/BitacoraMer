<?php

/**
 * Description of Utils
 *
 * @author jhon
 */
class Utils extends CI_Model {

    public function sendMail($mail, $subject, $template, $content) {
        $data['content'] = $content;
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['protocol'] = 'mail';
        $config['smtp_host'] = 'mail.unisoftsystem.com.co';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'jhonjairo.valdes@unisoftsystem.com.co';
        $config['smtp_pass'] = 'Pcu2208*';
        $config['validation'] = TRUE;
        $this->email->initialize($config);
        $this->email->clear();
        $this->email->from('jhonjairo.valdes@unisoftsystem.com.co', 'Unisoft');
        $this->email->to($mail);
        //$this->email->cc($destination);
        //$this->email->bcc($destination);
        $this->email->subject($subject);
        $body = $this->load->view($template, $data, TRUE);
        $this->email->message($body);
        $this->email->send();
    }

}
