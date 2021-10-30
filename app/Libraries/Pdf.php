<?php namespace App\Libraries;

require_once dirname(__file__). '/autoload.php';
require_once dirname(__file__). '/Fpdi.php';

class Pdf extends \setasign\Fpdi\Tcpdf\Fpdi{

  public function Footer() {
      // Position at 15 mm from bottom
      // $this->SetY(-15);
      // Set font
      // Page number
      $this->writeHTML('<hr>', 0, 0, true, 1);
      $this->ln(4);
      
      $this->MultiCell('', '', 'Gen. Santos Avenue, Lower Bicutan, Taguig City 1632; (Direct Line) 8 837-5858 to 60; (Telefax) 8 837-5859 ', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');

      $this->ln(4);

      $this->writeHTML('<p style="text-align:center">Website: <a href="#">www.pup.edu.ph</a> | Email: <a href="#">taguig@pup.edu.ph</a> | Email: <a href="#">taguig.registrar@pup.edu.ph</a>', 0, 0, true, 1);

      $this->ln(8);

      $this->SetFont('arial', '', 11);

      $this->MultiCell('', '', '“THE COUNTRY’S 1ST POLYTECHNICU”', 0, 'C', 0, 0, '', '', true, 0, false, true, 40, 'T');

  }

}
