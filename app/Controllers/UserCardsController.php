<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UserModel;

class UserCardsController extends Controller
{
    public function index()
    {
        return view('usercards/index'); // View utama daftar user dalam cards
    }

    public function fetch()
    {
        $model = new UserModel();
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort') ?? 'id';
        $order = $this->request->getGet('order') ?? 'asc';
        $perPage = 6; // Jumlah card per halaman

        $query = $model->orderBy($sort, $order);
        if (!empty($search)) {
            $query->groupStart()
                ->like('username', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        $data['users'] = $query->paginate($perPage, 'group2');
        $data['pager'] = $model->pager;
        $data['sort'] = $sort;
        $data['order'] = $order;

        return view('usercards/cards', $data);
    }
}
