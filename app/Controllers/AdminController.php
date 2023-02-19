<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    private $adminModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->validation =  \Config\Services::validation();

        $this->adminModel = new \App\Models\AdministratorModel();
    }
    public function create_admin()
    {
        $data = ([
            'name'     => "Admin 001",
            'email'     => "admin@gmail.com",
            'phone'     => "123456789",
            'address'     => "Jl. Panjunan No. 12, Cirebon",
            'username'     => "admin",
            'password'     => password_hash("admin", PASSWORD_BCRYPT),
            'active'     => 1
        ]);

        $this->adminModel->insert($data);

        return redirect()->to(base_url("eshop-admin/login"));
    }

    public function login()
    {
        return view('admin/login');
    }

    public function process_login()
    {
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $admin = $this->adminModel
            ->where("username", $username)
            ->orWhere("email", $username)
            ->first();

        if ($admin) {
            if ($admin->active == 1) {
                if (password_verify($password, $admin->password)) {
                    $session_data = [
                        "admin_id"           => $admin->id,
                        'logged_in_admin'     => true,
                    ];
                    session()->set($session_data);

                    return redirect()->to(base_url('eshop-admin/dashboard'));
                } else {
                    $this->session->setFlashdata('msg', "<strong>Maaf, login gagal.</strong> <br> Periksa kembali data login anda !");
                    $this->session->setFlashdata('msg_status', 'danger');
                    return redirect()->to(base_url('eshop-admin'));
                }
            } else {
                $this->session->setFlashdata('msg', "<strong>Maaf, login gagal.</strong> <br> akun belum di aktivasi !");
                $this->session->setFlashdata('msg_status', 'danger');
                return redirect()->to(base_url('eshop-admin'));
            }
        } else {
            $this->session->setFlashdata('msg', "<strong>Maaf, login gagal.</strong> <br> Periksa kembali data login anda !");
            $this->session->setFlashdata('msg_status', 'danger');
            return redirect()->to(base_url('eshop-admin'));
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url("eshop-admin"));
    }

    public function dashboard()
    {
        return view('admin/dashboard');
    }
}
