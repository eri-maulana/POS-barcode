<?php

require "../config/config.php";
require "../config/functions.php";

require('../asset/fpdf/vendor/autoload.php');

$stockBrg = getData("SELECT * FROM tbl_barang");

// halaman 
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'Laporan Stock Barang', 0, 1, 'C');

// header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, '', 'B', 1);
$pdf->Cell(10, 10, 'No', 0, 0, 'C');
$pdf->Cell(50, 10, 'Kode Barang', 0, 0, 'C');
$pdf->Cell(70, 10, 'Nama Barang', 0, 0);
$pdf->Cell(30, 10, 'Jumlah Stock', 0, 0, 'C');
$pdf->Cell(30, 10, 'Satuan', 0, 1, 'C');
$pdf->Cell(190, 1, '', 'T', 1);

// body
$pdf->SetFont('Arial', '', 12);
$no = 1;
foreach ($stockBrg as $stock) {
   $pdf->Cell(10, 10, $no++, 0, 0, 'C');
   $pdf->Cell(50, 10, $stock['id_barang'], 0, 0, 'C');
   $pdf->Cell(70, 10, $stock['nama_barang'], 0, 0);
   $pdf->Cell(30, 10, $stock['stock'], 0, 0, 'C');
   $pdf->Cell(30, 10, $stock['satuan'], 0, 1, 'C');
}
$pdf->Cell(190, 1, '', 'T', 1);

$pdf->Output();
