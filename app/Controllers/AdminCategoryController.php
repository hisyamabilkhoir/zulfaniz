<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminCategoryController extends BaseController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new \App\Models\CategoryModel();
        helper("form");
    }

    public function admin_category()
    {
        $data = [
            'categories' => $this->categoryModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/admin_category', $data);
    }

    public function admin_category_add_process()
    {
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'name'      => [
                'username' => 'is_unique[categories.name]',
                'errors' => [
                    'is_unique' => 'Nama kategori produk sudah ada',
                ],
            ],
        ])) {
            $data = [
                'categories' => $this->categoryModel->findAll(),
                'validation' => \Config\Services::validation(),
            ];
            return view('admin/admin_category', $data);
        }

        $name = $this->request->getPost("name");

        $this->categoryModel->insert([
            "name"          => $name,
        ]);
        // dd()
        session()->setFlashdata('notif_status', 'success');
        session()->setFlashdata('notif_content', 'Kategori Produk telah berhasil ditambahkan');
        return redirect()->to(base_url('eshop-admin/categories'));
    }

    public function admin_category_edit_process()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $dataNamaSama = $this->categoryModel->where(['name' => $name, 'id !=' => $id])->first();
        if ($dataNamaSama) {
            $validation = \Config\Services::validation();
            return redirect()->to('eshop-admin/categories')->withInput()->with('validation', $validation);
        }
        $this->categoryModel->where("id", $id)->set(["name" => $name])->update();

        session()->setFlashdata('notif_status', 'success');
        session()->setFlashdata('notif_content', 'Kategori Produk telah berhasil disimpan');
        return redirect()->to(base_url('eshop-admin/categories'));
    }

    public function admin_category_view_edit($id)
    {
        $data = [
            'category' => $this->categoryModel->find($id),
        ];
        return view('admin/ajax/modal_view_edit', $data);
    }

    public function admin_category_delete($id)
    {
        $this->categoryModel->delete($id);
        return redirect()->to(base_url('eshop-admin/categories'));
    }
}
