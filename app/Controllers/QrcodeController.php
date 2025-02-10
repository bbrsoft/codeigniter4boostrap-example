<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;

class QrcodeController extends Controller
{
    public function generate()
    {
        $text = 'https://yourwebsite.com'; // Data QR Code
        $logoPath = WRITEPATH . 'uploads/logo.png'; // Pastikan logo tersedia
        $savePath = WRITEPATH . 'uploads/qrcodes/'; // Direktori penyimpanan

        // Pastikan direktori penyimpanan ada
        if (!is_dir($savePath)) {
            mkdir($savePath, 0777, true);
        }

        // Generate QR Code
        $qrCode = QrCode::create($text)
            ->setSize(300)
            ->setMargin(10);

        $writer = new PngWriter();

        // Tambahkan logo jika tersedia
        if (file_exists($logoPath)) {
            $logo = Logo::create($logoPath)->setResizeToWidth(50);
            $result = $writer->write($qrCode, $logo);
        } else {
            $result = $writer->write($qrCode);
        }

        // Simpan file QR Code
        $fileName = 'qrcode_' . time() . '.png'; // Nama unik untuk setiap QR
        $filePath = $savePath . $fileName;
        $result->saveToFile($filePath);

        return $this->response->setJSON([
            'message' => 'QR Code berhasil dibuat',
            'file_url' => base_url('writable/uploads/qrcodes/' . $fileName) // URL file yang bisa diakses
        ]);
    }


    public function index()
    {
        return view('qrcode_view');
    }
}
