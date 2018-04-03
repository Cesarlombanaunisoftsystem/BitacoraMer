<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//define('DOMPDF_ENABLE_AUTOLOAD', false);
require_once('dompdf/dompdf_config.inc.php');

class Pdfgenerator {

    public function generate($html, $filename = '', $stream = TRUE, $paper = 'A4', $orientation = "portrait") {
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }

    public function saveDisk($filename, $html, $folder) {
        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'landscape');
        $dompdf->render();
        $output = $dompdf->output();
        $file_to_save = $folder . $filename . ".pdf";
        if (!is_dir($folder)) {
            if (mkdir($folder, 0777, TRUE)) {
                file_put_contents($file_to_save, $output);
            }
        } else {
            file_put_contents($file_to_save, $output);
        }
    }

}
