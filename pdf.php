<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

require('./fpdf.php');
 
class MyPDF extends FPDF
{
    function DashedRect($x1, $y1, $x2, $y2, $width=1, $nb=15)
    {
        $this->SetLineWidth($width);
        $longueur=abs($x1-$x2);
        $hauteur=abs($y1-$y2);
        if($longueur>$hauteur) {
            $Pointilles=($longueur/$nb)/2; // length of dashes
        }
        else {
            $Pointilles=($hauteur/$nb)/2;
        }
        for($i=$x1;$i<=$x2;$i+=$Pointilles+$Pointilles) {
            for($j=$i;$j<=($i+$Pointilles);$j++) {
                if($j<=($x2-1)) {
                    $this->Line($j,$y1,$j+1,$y1); // upper dashes
                    $this->Line($j,$y2,$j+1,$y2); // lower dashes
                }
            }
        }
        for($i=$y1;$i<=$y2;$i+=$Pointilles+$Pointilles) {
            for($j=$i;$j<=($i+$Pointilles);$j++) {
                if($j<=($y2-1)) {
                    $this->Line($x1,$j,$x1,$j+1); // left dashes
                    $this->Line($x2,$j,$x2,$j+1); // right dashes
                }
            }
        }
    }
}

function generatePdf($date_value, $lot_number)
{
  $pdf=new MyPDF('l','mm',array(282.19,186.94));
  $pdf->AddPage();
  $pdf->AddFont('MyriadProBI','BI','MyriadPro-BoldIt.php');
  $pdf->SetFont('MyriadProBI','BI',70);
  $pdf->Cell(0,100,'Best before   '.$date_value,0,1,'C');
  $pdf->DashedRect(140,38,275,82,2);
  $lot_number_len=strlen($lot_number);

  if($lot_number_len <=15) 
  {
    $pdf->Cell(0,30,'Lot # - '.$lot_number,0,1,'C');
  }
  else
  {
    //$pdf->SetX(61);
    $pdf->Cell(0,25,'Lot # - ',0,1,'C');
    //$pdf->SetX(61);
    $pdf->Cell(0,25,$lot_number,0,1,'C');
  }
  $pdf->Output();
}
?>
