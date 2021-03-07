<?php

namespace App\Helpers;


use Elibyy\TCPDF\Facades\TCPDF;

class PDF extends TCPDF {

    public function footer()
    {
        $this->SetY(1);
        $this->SetFont('Times New Roman', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
