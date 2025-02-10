<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    // Fungsi Export Data ke Excel
    public function export()
    {
        // Hardcode Data (Bisa diganti dari Database)
        $data = [
            ['ID', 'Nama', 'Email'],
            [1, 'Budi', 'budi@example.com'],
            [2, 'Ani', 'ani@example.com'],
            [3, 'Joko', 'joko@example.com']
        ];

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Masukkan data ke dalam spreadsheet
        $sheet->fromArray($data, NULL, 'A1');

        // Set header response untuk download file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data.xlsx"');
        header('Cache-Control: max-age=0');

        // Buat writer untuk Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // Fungsi Import Data dari Excel
    public function import()
    {
        $file = $this->request->getFile('file_excel');

        if ($file->isValid() && !$file->hasMoved()) {
            $filePath = $file->getTempName();

            // Load Spreadsheet
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            // Simpan hasil import ke log
            print_r($data); // Bisa diganti untuk disimpan ke database
        } else {
            echo "Gagal mengunggah file!";
        }
    }
}
