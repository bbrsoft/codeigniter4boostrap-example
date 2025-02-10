<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function send()
    {
        // Masukkan SID dan Token dari Twilio
        $sid    = 'your_twilio_sid';
        $token  = 'your_twilio_token';
        $twilio = new Client($sid, $token);

        // Kirim pesan ke nomor tujuan (harus diawali dengan kode negara, contoh: +6281234567890)
        $message = $twilio->messages->create(
            "whatsapp:+6281234567890", // Nomor tujuan (ganti dengan nomor penerima)
            [
                "from" => "whatsapp:+14155238886", // Nomor WhatsApp Twilio
                "body" => "Halo! Ini adalah pesan otomatis dari CodeIgniter 4."
            ]
        );

        return "Pesan berhasil dikirim! SID: " . $message->sid;
    }
}
