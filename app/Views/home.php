<?= $this->include('layout/header') ?>

    
    <section id="features" class="container my-5">
        <div class="row text-center">
            <div class="col-md-4">
                <h3>API Server & Client</h3>
                <p>Basic Restful  API.</p>
            </div>
            <div class="col-md-4">
                <h3>QRcode Berlogo</h3>
                <p>Qrcode.</p>
            </div>
            <div class="col-md-4">
                <h3>PDF dengan Qrcode</h3>
                <p>dokumen pdf dengan fpdf atau tcpdf.</p>
            </div>
        </div>
    </section>
    
    <section id="courses" class="bg-light py-5">
        <div class="container text-center">
            <h2>Popular Courses</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Course">
                        <div class="card-body">
                            <h5 class="card-title">kirim email</h5>
                            <p class="card-text">SMTP google.</p>
                            <a href="#" class="btn btn-primary">Enroll Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Course">
                        <div class="card-body">
                            <h5 class="card-title">Impor/Export data excel</h5>
                            <p class="card-text">Impor/Export data excel</p>
                            <a href="#" class="btn btn-primary">Enroll Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Course">
                        <div class="card-body">
                            <h5 class="card-title">Script kirim whatsapp</h5>
                            <p class="card-text">Create stunning visuals with Adobe Suite.</p>
                            <a href="#" class="btn btn-primary">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
    <div class="container text-left">
        <h1>Panduan</h1>
        <h2>API Server & Client Postman </h2>
        <h4>1. GET Semua</h4>
                curl -X GET "http://localhost:8080/api" -H "Accept: application/json"
        <h4>2. GET Data Berdasarkan ID</h4>
            <p>Cek apakah API bisa mengambil satu data berdasarkan ID.</p>
                <pre>
                    <code>
                        // Gunakan Postman:
                        URL: http://localhost:8080/api/1
                        Method: GET
                        // Gunakan cURL:
                        curl -X GET "http://localhost:8080/api/1" -H "Accept: application/json"
                        Jika data ada, maka API akan merespons:
                        {
                        "id": 1,
                        "name": "John Doe",
                        "email": "john@example.com"
                        }
                        Jika data tidak ada, API akan mengembalikan:
                        {
                        "status": 404,
                        "error": "Data tidak ditemukan"
                        }
                    </code>
                </pre>
                <h4>3. POST (Tambah Data)</h4>
                <p>Cek apakah API bisa menambahkan data baru.</p>
                <pre>
                    <code>
                // Gunakan Postman:
                URL: http://localhost:8080/api
                Method: POST
                Headers: Content-Type: application/json
                Body (JSON):
                {
                "username": "Jane Doe",
                "email": "jane@example.com",
                "password": "abcaderer",
                "city": "Jakarta"
                }
                // Gunakan cURL:
                curl -X POST "http://localhost:8080/api" -H "Content-Type: application/json" -d '{"name": "Jane Doe", "email": "jane@example.com"}'
                Respon Berhasil:
                {
                "message": "Data berhasil disimpan"
                }
                </code>
                </pre>
                <h4>4. PUT (Update Data ID 1)</h4>
                <p>Cek apakah API bisa mengupdate data pengguna berdasarkan ID.</p>
                <pre>
                    <code>
                // Gunakan Postman:
                URL: http://localhost:8080/api/1
                Method: PUT
                Headers: Content-Type: application/json
                Body (JSON):
                {
                "name": "Jane Smith",
                "email": "janesmith@example.com"
                }
                // Gunakan cURL:
                curl -X PUT "http://localhost:8080/api/1" -H "Content-Type: application/json" -d '{"name": "Jane Smith", "email": "janesmith@example.com"}'
                Respon Berhasil:
                {
                "message": "Data berhasil diperbarui"
                }
                </code>
                </pre>
                <h4>5. DELETE Data ID 1</h4>
                <p>Cek apakah API bisa menghapus data pengguna berdasarkan ID.</p>
                <pre>
                    <code>
                // Gunakan Postman:
                URL: http://localhost:8080/api/1
                Method: DELETE
                // Gunakan cURL:
                curl -X DELETE "http://localhost:8080/api/1"
                Respon Berhasil:
                {
                "message": "Data berhasil dihapus"
                }
                </code>
                </pre>

                <h1>Dokumentasi API Client</h1>
    
                <h2>1. GET Semua Pengguna</h2>
                <p>Mengambil semua data pengguna.</p>
                <pre><code>
            URL: http://localhost:8080/client/getAllUsers
            Method: GET
                </code></pre>
                
                <h2>2. GET Pengguna Berdasarkan ID</h2>
                <p>Mengambil data pengguna berdasarkan ID tertentu.</p>
                <pre><code>
            URL: http://localhost:8080/client/getUser/{id}
            Method: GET
            Contoh: http://localhost:8080/client/getUser/1
                </code></pre>
                
                <h2>3. POST Tambah Pengguna</h2>
                <p>Menambahkan pengguna baru.</p>
                <pre><code>
            URL: http://localhost:8080/client/addUser
            Method: POST
            Headers: Content-Type: application/json
            Body:
            {
            "name": "John Doe",
            "email": "john@example.com"
            }
                </code></pre>
                
                <h2>4. PUT Update Pengguna</h2>
                <p>Memperbarui data pengguna berdasarkan ID.</p>
                <pre><code>
            URL: http://localhost:8080/client/updateUser/{id}
            Method: PUT
            Headers: Content-Type: application/json
            Body:
            {
            "name": "Jane Doe",
            "email": "jane@example.com"
            }
                </code></pre>
                
                <h2>5. DELETE Hapus Pengguna</h2>
                <p>Menghapus pengguna berdasarkan ID.</p>
                <pre><code>
            URL: http://localhost:8080/client/deleteUser/{id}
            Method: DELETE
            Contoh: http://localhost:8080/client/deleteUser/1
                </code></pre>

                
                <h1>Dokumentasi QRCODE</h1>
    
                <h2>1.QRCode dengan logo</h2>
                <p>Generate QRcode.</p>
                <pre><code>
            URL: http://localhost:8080/qrcode
                </code></pre>
        </div>
    </section>
    
    <section id="contact" class="container my-5 text-center">
        <h2>Contact Us</h2>
        <p>Email: bbrsoftdream@gmail.com | Phone: +6282169419513</p>
    </section>
    
<?= $this->include('layout/footer') ?>
