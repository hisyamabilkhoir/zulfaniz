<?php

namespace App\Controllers;

class CustomerController extends BaseController
{
    private $customerModel;
    private $productModel;
    private $productImageModel;
    private $productVariantModel;

    public function __construct()
    {
        helper("form");
        $this->db      = \Config\Database::connect();
        $this->customerModel = new \App\Models\CustomerModel();
        $this->productModel = new \App\Models\ProductModel();
        $this->productImageModel = new \App\Models\ProductImageModel();
        $this->productVariantModel = new \App\Models\ProductVariantModel();
    }

    public function home()
    {
        // echo "test";
        $data = [
            'products' => $this->productModel->findAll(5),
            'db' => $this->db,
        ];

        // dd($data['products']);

        // dd($data['products']);
        return view('customer/home', $data);
    }

    public function login()
    {
        $data = [
            'title' => 'Halaman Login',
            'validation' => \Config\Services::validation(),
        ];
        return view('customer/login', $data);
    }

    public function process_login()
    {
        $phone = $this->request->getPost("phone");
        $password = $this->request->getPost("password") || null;

        $customer = $this->customerModel
            ->where("phone", $phone)
            ->orWhere("email", $phone)
            ->first();

        if ($customer) {
            if (password_verify($password, $customer->password)) {
                $session_data = [
                    "customer_id"           => $customer->id,
                    'logged_in_customer'     => true,
                ];
                session()->set($session_data);

                return redirect()->to(base_url('/'));
            } else {
                session()->setFlashdata('msg', "<strong>Maaf, login gagal.</strong> <br> Periksa kembali data login anda !");
                session()->setFlashdata('msg_status', 'danger');
                return redirect()->to(base_url('eshop-customer'));
            }
        } else {
            session()->setFlashdata('msg', "<strong>Maaf, login gagal.</strong> <br> Periksa kembali data login anda !");
            session()->setFlashdata('msg_status', 'danger');
            return redirect()->to(base_url('eshop-customer'));
        }
    }

    public function registration()
    {
        $data = [
            'title' => 'Halaman Registrasi',
            'validation' => \Config\Services::validation(),
        ];
        return view('customer/registration', $data);
    }

    public function process_registration()
    {
        if (!$this->validate([
            'email'          => [
                'rules' => 'is_unique[customers.email]',
                'errors' => [
                    'is_unique' => 'Email sudah terdaftar !',
                ],
            ],
            'phone'          => [
                'rules' => 'is_unique[customers.phone]',
                'errors' => [
                    'is_unique' => 'Nomor telepon sudah terdaftar !',
                ],
            ],
            'password'      => [
                'rules' => 'min_length[3]',
                'errors' => [
                    'min_length' => 'Panjang password minimal 3 karakter !',
                ],
            ],
            'confirm_password'      => [
                'confpassword'  => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password salah !'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('eshop-customer/registration'))->withInput()->with('validation', $validation);
        }

        $name = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $phone = $this->request->getPost("phone");
        $address = $this->request->getPost("address");
        $password = $this->request->getPost("password") || null;

        $dataInsert = ([
            "name"                      => $name,
            "address"                   => $address,
            "phone"                     => $phone,
            "email"                     => $email,
            "password"                  => password_hash($password, PASSWORD_BCRYPT),
            "active"                    => 1,
        ]);

        $this->customerModel->insert($dataInsert);

        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', "<strong>Registrasi berhasil !</strong> <br> Silahkan masuk !");
        return redirect()->to(base_url('eshop-customer'));
    }

    public function profile()
    {
        return view('customer/profile');
    }

    public function profile_edit()
    {
        return view('customer/profile_edit');
    }

    public function profile_update()
    {
        $id = $this->request->getPost('id');

        //cek data admin untuk validasi ubah
        $data_customer = $this->customerModel->where("id", $id)->first();
        if ($data_customer->email == $this->request->getPost('email')) {
            $rule_email = 'required';
        } else {
            $rule_email = 'required|is_unique[customers.email]';
        }

        if ($data_customer->phone == $this->request->getPost('phone')) {
            $rule_phone = 'required';
        } else {
            $rule_phone = 'required|is_unique[customers.phone]';
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
            return redirect()->to(base_url('/eshop-customer/profile/edit'))->withInput()->with('validation', $validation);
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
        session()->setFlashdata("msg", "Akun Customer : $name berhasil disimpan !");
        return redirect()->to(base_url('eshop-customer/profile/edit'));
    }

    public function password_edit()
    {
        return view('customer/password_edit');
    }

    public function password_update()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('name');
        $password = $this->request->getPost('password') || null;

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
            return redirect()->to('eshop-customer/password/edit')->withInput()->with('validation', $validation);
        }

        $this->customerModel->update($id, ([
            "password"  => password_hash($password, PASSWORD_BCRYPT),
        ]));

        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', 'Akun Customer : <b>' . $name . '</b> berhasil reset password !');
        return redirect()->to(base_url('eshop-customer/password/edit'));
    }

    public function products()
    {
        return view('customer/product');
    }

    public function product_detail($slug)
    {
        $product = $this->productModel->where('slug', $slug)->first();

        $data = [
            'db'    => $this->db,
            'products_mores' => $this->productModel->where('id !=', $product->id)->findAll(4),
            'product' => $product,
            'product_images' => $this->productImageModel->where('product_id', $product->id)->findAll(),
            'product_variants' => $this->productVariantModel->where('product_id', $product->id)->findAll(),
        ];
        return view('customer/product_detail', $data);
    }

    public function contact()
    {
        return view('customer/contact');
    }

    public function cart()
    {
        return view('customer/cart');
    }

    public function checkout()
    {
        return view('customer/checkout');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url("/"));
    }
}
