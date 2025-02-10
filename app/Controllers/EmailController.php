<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class EmailController extends Controller
{
    public function send()
    {
        $email = \Config\Services::email();

        // Konfigurasi email (hardcode)
        $email->setFrom('bbrsoftdream@gmail.com', 'Admin');
        $email->setTo('recipient@example.com'); // Ganti dengan email tujuan
        $email->setSubject('Tes Kirim Email');
        $email->setMessage('<h3>Halo!</h3> <p>Ini adalah email tes dari CodeIgniter 4.</p>');
        $email->setMailType('html'); // Bisa 'text' atau 'html'

        if ($email->send()) {
            return 'Email berhasil dikirim!';
        } else {
            return 'Gagal mengirim email: ' . $email->printDebugger(['headers']);
        }
    }
}
