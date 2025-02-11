<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class FileManagerController extends Controller
{
    private $baseDir = 'uploads/';

    public function index($folder = '')
    {
        $folderPath = $this->baseDir . ($folder ? $folder . '/' : '');

        if (!is_dir($folderPath)) {
            var_dump($folderPath, file_exists($folderPath), is_readable($folderPath));
            exit;
            return redirect()->to('/file-manager')->with('error', 'Folder tidak ditemukan');
        }
        

        $files = array_filter(scandir($folderPath), function($file) use ($folderPath) {
            return is_file($folderPath . $file) && preg_match('/\.(pdf|png)$/i', $file);
        });

        $folders = array_filter(scandir($folderPath), function($file) use ($folderPath) {
            return is_dir($folderPath . $file) && !in_array($file, ['.', '..']);
        });

        return view('file_manager/index', [
            'files' => $files,
            'folders' => $folders,
            'currentFolder' => $folder,
        ]);
    }


    public function upload()
{
    $folder = $this->request->getPost('folder') ?? '';  // Dapatkan folder saat ini
    $uploadPath = $this->baseDir . ($folder ? $folder . '/' : ''); // Pastikan path sesuai folder saat ini

    // Buat folder jika belum ada
    if (!is_dir($uploadPath) && !mkdir($uploadPath, 0777, true)) {
        return redirect()->to('/file-manager/' . $folder)->with('error', 'Gagal membuat folder');
    }

    $file = $this->request->getFile('file');
    if ($file->isValid() && !$file->hasMoved() && in_array($file->getExtension(), ['pdf', 'png'])) {
        // Simpan file hanya ke dalam folder saat ini
        $file->move($uploadPath, $file->getName());  
        return redirect()->to('/file-manager/' . $folder)->with('success', 'File berhasil diupload');
    }

    return redirect()->to('/file-manager/' . $folder)->with('error', 'Gagal upload file');
}

public function delete()
{
    $file = $this->request->getPost('file');
    $folder = $this->request->getPost('folder') ?? '';
    $filePath = realpath($this->baseDir . ($folder ? $folder . '/' : '') . $file);

    // Debugging: Cek apakah path sudah benar
    error_log("Mencoba menghapus: $filePath");

    if ($filePath && file_exists($filePath)) {
        if (unlink($filePath)) {
            return redirect()->to('/file-manager/' . $folder)->with('success', 'File berhasil dihapus');
        } else {
            return redirect()->to('/file-manager/' . $folder)->with('error', 'Gagal menghapus file, cek izin akses.');
        }
    }

    return redirect()->to('/file-manager/' . $folder)->with('error', 'File tidak ditemukan.');
}

    public function rename()
    {
        $oldName = $this->request->getPost('old_name');
        $newName = $this->request->getPost('new_name');
        $folder = $this->request->getPost('folder') ?? '';
    
        // Pastikan path lama dan baru sesuai lokasi folder saat ini
        $oldPath = realpath($this->baseDir . ($folder ? $folder . '/' : '') . $oldName);
        $newPath = $this->baseDir . ($folder ? $folder . '/' : '') . $newName;
    
        // Cek apakah file lama ada dan tidak sedang digunakan
        if (!$oldPath || !file_exists($oldPath)) {
            return redirect()->to('/file-manager/' . $folder)->with('error', 'File lama tidak ditemukan.');
        }
    
        // Debugging (bisa dihapus nanti)
        error_log("Rename: $oldPath → $newPath");
    
        // Rename file
        if (@rename($oldPath, $newPath)) {
            return redirect()->to('/file-manager/' . $folder)->with('success', 'File berhasil diubah');
        }
    
        return redirect()->to('/file-manager/' . $folder)->with('error', 'Gagal mengubah nama file, cek izin atau file sedang digunakan.');
    }

    
    public function move()
{
    $file = $this->request->getPost('file');
    $fromFolder = trim($this->request->getPost('from_folder'), '/'); // Hapus "/" jika ada
    $toFolder = trim($this->request->getPost('to_folder'), '/'); // Folder tujuan

    // Jika `toFolder` kosong, arahkan ke `uploads`
    $toFolder = $toFolder ?: 'uploads';

    // Pastikan file yang ingin dipindahkan ada
    $fromPath = realpath($this->baseDir . ($fromFolder ? '/' . $fromFolder : '') . '/' . $file);
    $toPath = $this->baseDir . '/' . $toFolder . '/' . $file;

    if (!$fromPath || !file_exists($fromPath)) {
        return redirect()->to(site_url('file-manager/folder/' . ($fromFolder ?: 'uploads')))
                         ->with('error', 'File tidak ditemukan.');
    }

    // Jika folder tujuan tidak ada, buat
    if (!is_dir(dirname($toPath))) {
        mkdir(dirname($toPath), 0775, true);
    }

    // Pindahkan file
    if (@rename($fromPath, $toPath)) {
        return redirect()->to(site_url('file-manager/folder/' . $toFolder))
                         ->with('success', 'File berhasil dipindahkan.');
    }

    return redirect()->to(site_url('file-manager/folder/' . ($fromFolder ?: 'uploads')))
                     ->with('error', 'Gagal memindahkan file.');
}



    public function copy()
{
    $file = $this->request->getPost('file');
    $fromFolder = $this->request->getPost('from_folder') ?? '';
    $toFolder = trim($this->request->getPost('to_folder'), '/'); // Hapus "/" di awal dan akhir jika ada

    // Jika `toFolder` kosong, set default ke 'uploads'
    $toFolder = $toFolder ?: 'uploads';

    // Path folder tujuan
    $destinationFolder = $this->baseDir . $toFolder . '/';
    
    // Path asal dan tujuan
    $fromPath = realpath($this->baseDir . ($fromFolder ? $fromFolder . '/' : '') . $file);
    $toPath = $destinationFolder . $file;

    // Jika file tidak ditemukan
    if (!$fromPath || !file_exists($fromPath)) {
        return redirect()->to('/file-manager/' . ($fromFolder ?: 'uploads'))->with('error', 'File tidak ditemukan.');
    }

    // Pastikan folder tujuan ada, jika tidak buat folder
    if (!is_dir($destinationFolder)) {
        mkdir($destinationFolder, 0775, true);
    }

    // Salin file
    if (@copy($fromPath, $toPath)) {
        return redirect()->to('/file-manager/folder/' . $toFolder)->with('success', 'File berhasil disalin.');
    }

    return redirect()->to('/file-manager/' . ($fromFolder ?: 'uploads'))->with('error', 'Gagal menyalin file.');
}

    

}
