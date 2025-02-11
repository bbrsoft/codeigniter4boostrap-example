<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel'; // Contoh model
    protected $format    = 'json';

    // Ambil semua data
    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    // Ambil data berdasarkan ID
    public function show($id = null)
    {
        $data = $this->model->find($id);
        return $data ? $this->respond($data) : $this->failNotFound('Data tidak ditemukan');
    }

    // Tambah data baru
    public function create()
    {
        $json = $this->request->getJSON();
        if (!$json) {
            return $this->failValidationErrors("Invalid JSON data");
        }

        $data = [
            'username' => $json->username,
            'email' => $json->email,
            'city' => $json->city,
            'password' => password_hash($json->password, PASSWORD_BCRYPT) // Amankan password
        ];

        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'Data berhasil disimpan']);
        } else {
            return $this->fail('Gagal menyimpan data');
        }
    }


    // Update data
    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $json = $this->request->getJSON();
        $data = [];

        if (isset($json->username)) {
            $data['username'] = $json->username;
        }

        if (isset($json->email)) {
            $data['email'] = $json->email;
        }

        if (isset($json->password)) {
            $data['password'] = password_hash($json->password, PASSWORD_BCRYPT);
        }

        if (isset($json->city)) {
            $data['city'] = $json->city;
        }

        if (!empty($data)) {
            $this->model->update($id, $data);
            return $this->respond(['message' => 'Data berhasil diperbarui']);
        }

        return $this->failValidationErrors('Tidak ada data yang diperbarui');
    }


    // Hapus data
    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        $this->model->delete($id);
        return $this->respondDeleted(['message' => 'Data berhasil dihapus']);
    }

}


# Docimentasi
// 1. GET Semua Data

// Cek apakah semua data pengguna tampil dengan benar.

// Gunakan Browser atau Postman:

//     URL: http://localhost:8080/api
//     Method: GET

// Gunakan cURL (Command Line / Terminal):

// curl -X GET "http://localhost:8080/api" -H "Accept: application/json"

// 2. GET Data Berdasarkan ID

// Cek apakah API bisa mengambil satu data berdasarkan ID.

// Gunakan Postman:

//     URL: http://localhost:8080/api/1
//     Method: GET

// Gunakan cURL:

// curl -X GET "http://localhost:8080/api/1" -H "Accept: application/json"

// Jika data ada, maka API akan merespons seperti ini:

// {
//   "id": 1,
//   "name": "John Doe",
//   "email": "john@example.com"
// }

// Jika data tidak ada, API akan mengembalikan:

// {
//   "status": 404,
//   "error": "Data tidak ditemukan"
// }

// 3. POST (Tambah Data)

// Cek apakah API bisa menambahkan data baru.

// Gunakan Postman:

//     URL: http://localhost:8080/api
//     Method: POST
//     Headers: Content-Type: application/json
//     Body (JSON):

//     {
//       "username": "Jane Doe",
//       "email": "jane@example.com",
        // "password" :"abcaderer"
        // "city" :"Jakarta"
//     }

// Gunakan cURL:

// curl -X POST "http://localhost:8080/api" \
//      -H "Content-Type: application/json" \
//      -d '{"name": "Jane Doe", "email": "jane@example.com"}'

// Respon Berhasil:

// {
//   "message": "Data berhasil disimpan"
// }

// 4. PUT (Update Data ID 1)

// Cek apakah API bisa mengupdate data pengguna berdasarkan ID.

// Gunakan Postman:

//     URL: http://localhost:8080/api/1
//     Method: PUT
//     Headers: Content-Type: application/json
//     Body (JSON):

//     {
//       "name": "Jane Smith",
//       "email": "janesmith@example.com"
//     }

// Gunakan cURL:

// curl -X PUT "http://localhost:8080/api/1" \
//      -H "Content-Type: application/json" \
//      -d '{"name": "Jane Smith", "email": "janesmith@example.com"}'

// Respon Berhasil:

// {
//   "message": "Data berhasil diperbarui"
// }

// 5. DELETE Data ID 1

// Cek apakah API bisa menghapus data pengguna berdasarkan ID.

// Gunakan Postman:

//     URL: http://localhost:8080/api/1
//     Method: DELETE

// Gunakan cURL:

// curl -X DELETE "http://localhost:8080/api/1"

// Respon Berhasil:

// {
//   "message": "Data berhasil dihapus"
// }
