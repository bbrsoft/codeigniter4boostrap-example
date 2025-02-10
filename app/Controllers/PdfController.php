<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use TCPDF;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Logo\Logo;

class PdfController extends Controller
{
    public function generate()
    {
        // Buat PDF baru
        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        // Judul Surat
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 10, 'SURAT KETERANGAN', 0, 1, 'C');
        $pdf->Ln(5);

        // Isi Surat
        $pdf->SetFont('helvetica', '', 12);
        $pdf->MultiCell(0, 10, "Yang bertanda tangan di bawah ini:\nNama: John Doe\nAlamat: Jl. Contoh No. 123, Jakarta\nMenyatakan bahwa ....", 0, 'L');
        $pdf->Ln(10);

        // Buat QR Code
        $text = 'https://yourwebsite.com/verify?id=12345'; // Data QR Code
        $logoPath = WRITEPATH . 'uploads/logo.png'; // Path logo jika ada
        $savePath = WRITEPATH . 'uploads/qrcodes/'; // Simpan di writable/qrcodes/
        
        // Pastikan folder ada
        if (!is_dir($savePath)) {
            mkdir($savePath, 0777, true);
        }

        // Generate QR Code
        $qrCode = QrCode::create($text)->setSize(200)->setMargin(10);
        $writer = new PngWriter();

        // Tambahkan logo jika ada
        if (file_exists($logoPath)) {
            $logo = Logo::create($logoPath)->setResizeToWidth(50);
            $result = $writer->write($qrCode, $logo);
        } else {
            $result = $writer->write($qrCode);
        }

        // Simpan QR Code
        $qrFileName = 'qrcode_' . time() . '.png';
        $qrFilePath = $savePath . $qrFileName;
        $result->saveToFile($qrFilePath);

        // Tambahkan QR Code ke PDF
        $pdf->Image($qrFilePath, 150, 80, 40, 40, 'PNG');

        // // Simpan atau Tampilkan PDF
        // $pdfFileName = 'surat_keterangan.pdf';
        // return $pdf->Output($pdfFileName, 'I'); // Tampilkan di browser

        // Tampilkan di browser
        $pdf->Output('surat_keterangan.pdf', 'I');  
        exit;
    }
}
