<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminCategoryController extends BaseController
{
    private $categoryModel;
    private $productModel;

    public function __construct()
    {
        $this->categoryModel = new \App\Models\CategoryModel();
        $this->productModel = new \App\Models\ProductModel();
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
        if (!$this->validate([
            'name'      => [
                'rules' => 'is_unique[categories.name]',
                'errors' => [
                    'is_unique' => 'Nama kategori produk sudah ada',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/eshop-admin/categories'))->withInput()->with('validation', $validation);
        }

        $name = $this->request->getPost("name");

        $this->categoryModel->insert([
            "name"          => $name,
        ]);
        // dd()
        session()->setFlashdata('notif_status', 'success');
        session()->setFlashdata('notif_content', "Kategori $name berhasil ditambahkan!");
        return redirect()->to(base_url('eshop-admin/categories'));
    }

    public function admin_category_edit_process()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $dataNamaSama = $this->categoryModel->where(['name' => $name, 'id !=' => $id])->first();
        if ($dataNamaSama) {
            session()->setFlashdata('msg_status', 'warning');
            session()->setFlashdata('msg', "Nama kategori produk $name sudah ada");
            return redirect()->to(base_url('eshop-admin/categories'));
        }
        $this->categoryModel->where("id", $id)->set(["name" => $name])->update();

        session()->setFlashdata('notif_status', 'success');
        session()->setFlashdata('notif_content', "Kategori $name berhasil disimpan!");
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
        $productData = $this->productModel->where('category_id', $id)->first();
        $category = $this->categoryModel->where('id', $id)->first();
        if ($productData) {
            session()->setFlashdata('msg_status', 'warning');
            session()->setFlashdata('msg', "Kategori $category->name tidak bisa dihapus karena sudah terpakai!");
            return redirect()->to(base_url('eshop-admin/categories'));
        }
        $this->categoryModel->delete($id);
        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', "Kategori $category->name berhasil dihapus!");
        return redirect()->to(base_url('eshop-admin/categories'));
    }
}
