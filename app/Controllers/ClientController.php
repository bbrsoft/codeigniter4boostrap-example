<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ClientController extends Controller
{
    private $apiUrl = 'http://localhost:8080/api';

    // GET Semua Data
    public function getAllUsers()
    {
        $response = file_get_contents($this->apiUrl);
        return $this->response->setJSON(json_decode($response, true));
    }

    // GET Data Berdasarkan ID
    public function getUser($id)
    {
        $response = file_get_contents("$this->apiUrl/$id");
        return $this->response->setJSON(json_decode($response, true));
    }

    // POST Tambah Data
    public function addUser()
    {
        $jsonData = $this->request->getJSON(true); // Ambil dari body Postman (JSON)

        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($jsonData),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($this->apiUrl, false, $context);
        return $this->response->setJSON(json_decode($response, true));
    }

    // PUT Update Data Berdasarkan ID (Mengambil Data dari Body Postman)
    public function updateUser($id)
    {
        $jsonData = $this->request->getJSON(true); // Ambil data dari body Postman

        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'PUT',
                'content' => json_encode($jsonData),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents("$this->apiUrl/$id", false, $context);
        return $this->response->setJSON(json_decode($response, true));
    }

    // DELETE Hapus Data Berdasarkan ID
    public function deleteUser($id)
    {
        $options = [
            'http' => [
                'method' => 'DELETE',
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents("$this->apiUrl/$id", false, $context);
        return $this->response->setJSON(json_decode($response, true));
    }
}
