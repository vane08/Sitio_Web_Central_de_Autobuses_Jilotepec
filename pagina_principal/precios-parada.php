<?php
require('../fpdf/fpdf.php');
require '../app/config/database.php';
date_default_timezone_set('America/El_Salvador');

$rutaPrecio = $conectar->real_escape_string($_POST['txtId']);
//echo $rutaPrecio;


class PDF extends FPDF
{
// Cabecera de página
//Numeros de paginas
//SetTextColor(255,255,255);es RGB extraer colores con GIMP
//SetFillColor()
//SetDrawColor()
//Line(derecha-izquierda, arriba-abajo,ancho,arriba-abajo)
//Color line setDrawColor(61,174,233)
//GetX() || GetY() posiciones en cm
//Grosor SetLineWidth(1)
// SetFont(tipo{COURIER, HELVETICA,ARIAL,TIMES,SYMBOL, ZAPDINGBATS}, estilo[normal,B,I ,A], tamaño)
// Cell(ancho , alto,texto,borde,salto(0/1),alineacion,rellenar, link)
//AddPage(orientacion[PORTRAIT, LANDSCAPE], tamño[A3.A4.A5.LETTER,LEGAL],rotacion)
//Image(ruta, poscisionx,pocisiony,alto,ancho,tipo,link)
//SetMargins(10,30,20,20) luego de addpage
  
function Header()
{
$this->Image('../app/img/IconoMA.png',-1,-1,65);
$this->Image('../app/img/logoManoAmiga.png',150,15,35);
$this->SetY(40);
$this->SetX(143);

$this->SetFont('Arial','B',12);
$this->Cell(89, 8, 'Reporte Transporte Publico',0,1);
$this->SetY(45);
$this->SetX(144);
$this->SetFont('Arial','',8);
$this->Cell(40, 8, utf8_decode('Servicios Unidos Urbanos y Suburbanos'));

$this->Ln(20);

}

function Footer()
{
     $this->SetFont('helvetica', 'B', 8);
        $this->SetY(-15);
        $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        $this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
        $this->Line(10,287,200,287);
        $this->Cell(0,5,utf8_decode("Servicios Unidos Urbanos y Suburbanos de Jilotepec © Todos los derechos reservados."),0,0,"C");
        
}

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(15);
$pdf->SetRightMargin(10);

$pdf->SetX(15);
$pdf->SetFillColor(25,132,151);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(12, 12, utf8_decode('N° Ruta'),0,0,'C',1);
$pdf->Cell(50,12, utf8_decode('Nombre Parada'),0,0,'C',1);
$pdf->Cell(50, 12, utf8_decode('Lugar Origen'),0,0,'C',1);
$pdf->Cell(30, 12, utf8_decode('Lugar Destino'),0,0,'C',1);
$pdf->Cell(35, 12, utf8_decode('$Precio'),0,1,'C',1);

$pdf->SetFont('Arial','',10);


//--------------------------------SE LLENA LA TABLA----------------------------
//CONSULTA
$consulta = "SELECT R.id_ruta, parada.nombre_parada as parada, L.nombre_lugar as Origen, LD.nombre_lugar as Destino, precio_boleto
from Ruta
as R
join Lugar as L on R.origen = L.id_lugares
join Lugar as LD on R.destino = LD.id_lugares 
INNER JOIN tarifa ON R.id_ruta = tarifa.ruta
INNER JOIN parada ON tarifa.parada = parada.id_parada WHERE tarifa.estatus=1 AND id_ruta = $rutaPrecio";
$resultados = mysqli_query($conectar, $consulta);

  while ($row = mysqli_fetch_array($resultados)) {
  //$pdf->Cell(12, 8, $i+1,'B',0,'C',1);
  $pdf->Cell(25, 8, $row[0], 'B',0,1);
  $pdf->Cell(50, 8,$row[1], 'B',0,1);
  $pdf->Cell(45, 8,$row[2], 'B',0,1);
  $pdf->Cell(40, 8,$row[3], 'B',0,1);
  $pdf->Cell(18, 8,$row[4], 'B',0,1);
  //$pdf->SetFillColor(232, 232, 232 );

$pdf->Ln(8);

}

$pdf->Output();

?>
