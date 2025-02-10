<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ClientController extends Controller
{
    private $apiUrl = 'http://localhost:8080/api';

    public function getAllUsers()
    {
        $response = file_get_contents($this->apiUrl);
        $data = json_decode($response, true);
        return $this->response->setJSON($data);
    }

    public function getUser($id)
    {
        $response = file_get_contents("$this->apiUrl/$id");
        $data = json_decode($response, true);
        return $this->response->setJSON($data);
    }

    public function addUser()
    {
        $data = [
            'name'  => 'John Doe',
            'email' => 'john@example.com'
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($this->apiUrl, false, $context);
        return $this->response->setJSON(json_decode($response, true));
    }
}
