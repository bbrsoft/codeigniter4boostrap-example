<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\DocumentModel;

class DocumentController extends Controller
{
    public function index()
    {
        $model = new DocumentModel();
        $data['documents'] = $model->findAll();
        return view('documents/index', $data);
    }

    public function create()
    {
        return view('documents/create');
    }

    public function store()
    {
        $validation = $this->validate([
            'title' => 'required|min_length[3]',
            'category' => 'required',
            'sub_category' => 'required',
            'description' => 'required|min_length[5]',
            'file' => 'uploaded[file]|ext_in[file,pdf]|max_size[file,2048]',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        $file = $this->request->getFile('file');
        $newName = $file->getRandomName();
        $file->move('uploads/', $newName);

        $model = new DocumentModel();
        $model->save([
            'title' => $this->request->getPost('title'),
            'category' => $this->request->getPost('category'),
            'sub_category' => $this->request->getPost('sub_category'),
            'description' => $this->request->getPost('description'),
            'file_path' => $newName,
        ]);

        return redirect()->to('/documents')->with('success', 'Document added successfully');
    }

    public function delete($id)
    {
        $model = new DocumentModel();
        $document = $model->find($id);
        
        if ($document) {
            unlink('uploads/' . $document['file_path']);
            $model->delete($id);
        }

        return redirect()->to('/documents')->with('success', 'Document deleted successfully');
    }
}
