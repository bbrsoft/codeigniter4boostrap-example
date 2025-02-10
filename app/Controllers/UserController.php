<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class UserController extends Controller
{
    public function index()
    {
        return view('users/index'); // View utama tabel
    }

    public function fetch()
{
    $model = new UserModel();
    $search = $this->request->getGet('search');
    $sort = $this->request->getGet('sort') ?? 'id';
    $order = $this->request->getGet('order') ?? 'asc';
    $perPage = 5;

    // Query dengan filter, sorting, dan pagination
    $query = $model->orderBy($sort, $order);
    if (!empty($search)) {
        $query->groupStart()
              ->like('username', $search)
              ->orLike('email', $search)
              ->groupEnd();
    }

    $data['users'] = $query->paginate($perPage, 'group1');
    $data['pager'] = $model->pager;
    $data['sort'] = $sort;
    $data['order'] = $order;

    return view('users/table', $data);
}

}
