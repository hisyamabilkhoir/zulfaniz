<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    private $adminModel;
    private $invoiceModel;
    private $orderModel;
    private $messageModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->validation =  \Config\Services::validation();

        helper("form");
        $this->adminModel = new \App\Models\AdministratorModel();
        $this->invoiceModel = new \App\Models\InvoiceModel();
        $this->orderModel = new \App\Models\OrderModel();
        $this->messageModel = new \App\Models\MessageModel();
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
        $data = [
            'title' => 'Halaman Login'
        ];
        return view('admin/login', $data);
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

    public function profile()
    {
        $data = [
            'admin' => $this->adminModel->where('id', session()->get('admin_id'))->first(),
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/profile', $data);
    }

    public function save_profile()
    {
        $id = $this->request->getPost('id');

        //cek data admin untuk validasi ubah
        $data_admin = $this->adminModel->where("id", $id)->first();

        if ($data_admin->username == $this->request->getPost('username')) {
            $rule_username = 'required';
        } else {
            $rule_username = 'required|is_unique[administrators.username]';
        }

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
            'username'          => [
                'rules' => $rule_username,
                'errors' => [
                    'required' => 'Masukkan username terlebih dahulu !',
                    'is_unique' => 'username sudah terdaftar !',
                ],
            ],
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
            return redirect()->to(base_url('eshop-admin/profile'))->withInput()->with('validation', $validation);
        }

        $name = $this->request->getPost("name");
        $email = $this->request->getPost("email");
        $phone = $this->request->getPost("phone");
        $address = $this->request->getPost("address");
        $username = $this->request->getPost("username");

        $this->adminModel->update($id, ([
            "name"                      => $name,
            "email"                      => $email,
            "phone"                      => $phone,
            "address"                      => $address,
            "username"                  => $username,
        ]));

        session()->setFlashdata("msg_status", "success");
        session()->setFlashdata("msg", "Admin : $name berhasil disimpan !");
        return redirect()->to(base_url('eshop-admin/profile/'));
    }

    public function profile_reset_password()
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
            return redirect()->to('eshop-admin/profile')->withInput()->with('validation', $validation);
        }

        $this->adminModel->update($id, ([
            "password"  => password_hash($password, PASSWORD_BCRYPT),
        ]));

        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', 'Admin : <b>' . $name . '</b> berhasil reset password !');
        return redirect()->to(base_url('eshop-admin/profile/'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url("eshop-admin"));
    }

    public function dashboard()
    {
        $start_date = date('Y-m') . '-01';
        $end_date = date('Y-m') . '-31';
        $start_month = date('Y') . '-01-01';
        $end_month = date('Y') . '-12-31';

        $CurrentMonth = $this->orderModel->select('qty, price')->join('invoices', 'orders.invoice_id = invoices.id')->where("order_date BETWEEN '$start_date' AND '$end_date' ")->get()->getResult();
        $totalCurrentMonth = 0;
        foreach ($CurrentMonth as $data) {
            $total = $data->qty * $data->price;
            $totalCurrentMonth += $total;
        }
        $CurrentYear = $this->orderModel->select('qty, price')->join('invoices', 'orders.invoice_id = invoices.id')->where("order_date BETWEEN '$start_month' AND '$end_month' ")->get()->getResult();
        $totalCurrentYear = 0;
        foreach ($CurrentYear as $data) {
            $total = $data->qty * $data->price;
            $totalCurrentYear += $total;
        }
        $AllTimetotal = $this->orderModel->select('qty, price')->join('invoices', 'orders.invoice_id = invoices.id')->get()->getResult();
        $total = 0;
        foreach ($AllTimetotal as $data) {
            $subTotal = $data->qty * $data->price;
            $total += $subTotal;
        }
        // $invoiceData->sum('')->where
        $data = [
            'totalCurrentMonth' => $totalCurrentMonth,
            'totalCurrentYear' => $totalCurrentYear,
            'total' => $total,
            'invoices' => $this->invoiceModel->orderBy('order_date', 'desc')->findAll(5),
        ];
        return view('admin/dashboard', $data);
    }

    public function messages()
    {
        $data = [
            'messages' => $this->messageModel->orderBy('date', 'desc')->orderBy('time', 'desc')->findAll(),
        ];
        return view('admin/messages', $data);
    }

    public function message_whatsapp()
    {
        $id = $this->request->getPost('id');
        $message = $this->messageModel->where('id', $id)->first();

        $data = [
            'message' => $message,
        ];

        return view('admin/message_whatsapp', $data);
    }

    public function message_whatsapp_reply()
    {
        $id = $this->request->getPost('id');
        $reply_message = $this->request->getPost('reply_message');
        $message = $this->messageModel->where('id', $id)->first();

        // bagian reply message
        $str     = $reply_message;
        $order   = array("\r\n", "\n", "\r");
        $replace = ' %20%0a';
        $reply_message = str_replace($order, $replace, $str);

        // bagian message database
        $str_m     = $message->message;
        $order_m   = array("\r\n", "\n", "\r");
        $replace_m = ' %20%0a';
        $db_message = str_replace($order_m, $replace_m, $str_m);

        return redirect()->to('https://api.whatsapp.com/send?phone=' . $message->phone .
            '&text=Subjek :%20' . $message->subject .
            '%20%0aNama :%20' . $message->name .
            '%20%0aEmail :%20' . $message->email .
            '%20%0aNo. WhatsApp :%20' . $message->phone .
            '%20%0aPesan :%20%0a' . $db_message .
            '%20%0a' .
            '%20%0a---- Balasan Pihak Kami ------' .
            '%20%0a' .
            '%20%0aPesan Balasan :%20%0a' . $reply_message);
    }

    public function message_whatsapp_reply_send($id)
    {
        $this->messageModel->update($id, ([
            "status"  => 2
        ]));

        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', 'Pesan berhasil dikirim !');
        return redirect()->to(base_url('eshop-admin/messages'));
    }

    public function message_gmail()
    {
        $id = $this->request->getPost('id');

        $message = $this->messageModel->where('id', $id)->first();

        $data = [
            'message' => $message,
        ];

        return view('admin/message_gmail', $data);
    }

    public function message_gmail_reply($id)
    {
        $this->messageModel->update($id, ([
            "status"  => 2
        ]));

        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', 'Pesan berhasil dikirim !');
        return redirect()->to(base_url('eshop-admin/messages'));
    }
}
