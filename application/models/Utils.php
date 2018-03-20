<?php

/**
 * Description of Utils
 *
 * @author jhonj
 */
class Utils extends CI_Model {

    public function sendMail($mail, $subject, $template, $user, $content, $order, $titulo) {
        $data['user'] = $user;
        $data['content'] = $content;
        $data['order'] = $order;
        $data['titulo'] = $titulo;
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['protocol'] = 'mail';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'BitacoraMer@gmail.com';
        $config['smtp_pass'] = 'Bitacora1234*';
        $config['validation'] = TRUE;
        $this->email->initialize($config);
        $this->email->clear();
        $this->email->from('BitacoraMer@gmail.com', 'Unisoft');
        $this->email->to($mail);
        //$this->email->cc($destination);
        //$this->email->bcc($destination);
        $this->email->subject($subject);
        $body = $this->load->view($template, $data, TRUE);
        $this->email->message($body);
        $this->email->send();
    }

}
