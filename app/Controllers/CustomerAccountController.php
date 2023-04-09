<?php

namespace App\Controllers;

class CustomerAccountController extends BaseController
{
    private $customerModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->validation =  \Config\Services::validation();
        $this->customerModel = new \App\Models\CustomerModel();
        helper("form");
    }

    public function customer_accounts()
    {
        $customer_accounts = $this->customerModel
            ->orderBy("name", "asc")
            ->get()
            ->getResultObject();

        $data = ([
            "customer_accounts"       => $customer_accounts,
        ]);

        return view('admin/customer_accounts', $data);
    }
    public function customer_accounts_view_edit($id)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'dataAccount' => $this->customerModel->where("id", $id)->first(),
        ];

        return view('admin/customer_accounts_view_edit', $data);
    }

    public function customer_accounts_update()
    {
        $id = $this->request->getPost('id');

        //cek data admin untuk validasi ubah
        $data_admin = $this->customerModel->where("id", $id)->first();

        if ($data_admin->email == $this->request->getPost('email')) {
            $rule_email = 'required';
        } else {
            $rule_email = 'required|is_unique[administrators.email]';
        }

        if ($data_admin->phone == $this->request->getPost('phone')) {
            $rule_phone = 'required';
        } else {
            $rule_phone = 'required|is_unique[administrators.phone]';
        }

        if (!$this->validate([
            'email'         => [
                'rules' => $rule_email,
                'errors' => [
                    'required' => 'Masukkan email terlebih dahulu !',
                    'is_unique' => 'Email sudah terdaftar !',
                ]
            ],
            'phone'         => [
                'rules' => $rule_phone,
                'errors' => [
                    'required' => 'Masukkan phone terlebih dahulu !',
                    'is_unique' => 'Nomor telepon sudah terdaftar !',
                ]
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/eshop-admin/customer-accounts/view-edit/' . $id))->withInput()->with('validation', $validation);
        }

        $name = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $phone = $this->request->getPost("phone");
        $address = $this->request->getPost("address");

        $this->customerModel->update($id, ([
            "name"                      => $name,
            "email"                      => $email,
            "phone"                      => $phone,
            "address"                      => $address,
        ]));

        session()->setFlashdata("msg_status", "success");
        session()->setFlashdata("msg", "Admin : $name berhasil disimpan !");
        return redirect()->to(base_url('eshop-admin/customer-accounts/view-edit/' . $id));
    }

    public function customer_accounts_reset_password()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $password = $this->request->getPost('password');

        if (!$this->validate([
            'password'      => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Masukkan password terlebih dahulu',
                    'min_length' => 'Panjang password minimal 3 karakter !',
                ],
            ],
            'confirm_password'      => [
                'confpassword'  => 'matches[password]',
                'errors' => [
                    'matches' => 'konfirmasi password salah !'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('eshop-admin/customer-accounts/view-edit/' . $id . '/?active=password')->withInput()->with('validation', $validation);
        }

        $this->customerModel->update($id, ([
            "password"  => password_hash($password, PASSWORD_BCRYPT),
        ]));

        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', 'Admin : <b>' . $name . '</b> berhasil reset password !');
        return redirect()->to(base_url('eshop-admin/customer-accounts/view-edit/' . $id . '/?active=password'));
    }
}
