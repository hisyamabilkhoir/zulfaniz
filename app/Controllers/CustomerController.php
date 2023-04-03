<?php

namespace App\Controllers;

use Midtrans\Snap;

class CustomerController extends BaseController
{
    private $customerModel;
    private $productModel;
    private $productImageModel;
    private $productVariantModel;
    private $cartModel;
    private $categoryModel;
    private $messageModel;
    private $invoiceModel;
    private $orderModel;

    public function __construct()
    {
        helper("form");
        $this->db      = \Config\Database::connect();
        $this->customerModel = new \App\Models\CustomerModel();
        $this->productModel = new \App\Models\ProductModel();
        $this->productImageModel = new \App\Models\ProductImageModel();
        $this->productVariantModel = new \App\Models\ProductVariantModel();
        $this->cartModel = new \App\Models\CartModel();
        $this->categoryModel = new \App\Models\CategoryModel();
        $this->messageModel = new \App\Models\MessageModel();
        $this->invoiceModel = new \App\Models\InvoiceModel();
        $this->orderModel = new \App\Models\OrderModel();
    }

    public function home()
    {
        // echo "test";
        $data = [
            'products' => $this->productModel->findAll(5),
            'product_variants' => $this->productVariantModel,
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

    public function profile_set_photo()
    {
        $user_id = session()->get('customer_id');

        $data_customer = $this->customerModel->where('id', $user_id)->first();

        if ($data_customer->image != null) {
            //hapus gambar lama 
            unlink('customer_images/' . $data_customer->image);
        }

        //file
        $picture = $this->request->getFile('picture');
        $namePicture = $picture->getRandomName();
        $picture->move(ROOTPATH . 'public/customer_images', $namePicture);

        $this->customerModel->update($user_id, ([
            "image"                      => $namePicture,
        ]));

        session()->setFlashdata("msg_status", "success");
        session()->setFlashdata("msg", "Gambar berhasil disimpan !");
        return redirect()->to(base_url('eshop-customer/profile'));
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
        $data = [
            'categories' => $this->categoryModel->orderBy('name', 'asc')->findAll(),
            'products' => $this->productModel->findAll(),
            'product_variants' => $this->productVariantModel,
            'productModel' => $this->productModel,
            'db' => $this->db,
        ];

        return view('customer/product', $data);
    }

    public function products_search()
    {
        $keyword = $this->request->getPost('search');

        $products_by_search = $this->productModel->like('title', $keyword)->findAll();

        $data = [
            'keyword' => $keyword,
            'products' => $products_by_search,
            'product_variants' => $this->productVariantModel,
            'db' => $this->db,
        ];

        return view('customer/product_search', $data);
    }

    public function products_by_category()
    {
        $category_id = $this->request->getPost('category_id');

        // dd($category_id);

        $products = $this->productModel->where('category_id', $category_id)->findAll();

        // dd($products);

        $data = [
            'category_id' => $category_id,
            'products' => $products,
            'product_variants' => $this->productVariantModel,
            'db' => $this->db,
        ];

        return view('customer/ajax/products_by_category', $data);
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
            'productVariantModel' => $this->productVariantModel,
        ];
        return view('customer/product_detail', $data);
    }

    public function product_detail_select_variant()
    {
        $product_variant_id = $this->request->getPost('product_variant_id');

        $product_variant = $this->productVariantModel->where('id', $product_variant_id)->first();

        if ($product_variant->discount == 0) {
            $harga = 'Rp. ' . number_format($product_variant->price, 0, ",", ".") . '';
        } else {
            $diskon = ($product_variant->price * $product_variant->discount) / 100;
            $perhitungan_harga = $product_variant->price - $diskon;
            $harga = '<span class="old">Rp. ' . number_format($product_variant->price, 0, ",", ".") . '</span><small>(' . $product_variant->discount . '%)</small>
                                  <br>
                                  Rp. ' . number_format($perhitungan_harga, 0, ",", ".") . '';
        }

        $data = [
            'harga' => $harga,
        ];

        return view('customer/ajax/product_detail_select_variant', $data);
    }

    public function contact()
    {
        return view('customer/contact');
    }

    public function contact_send()
    {
        $name = $this->request->getPost('name');
        $subject = $this->request->getPost('subject');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $message = $this->request->getPost('message');
        $status = 1;

        $dataInsert = ([
            "name"                      => $name,
            "subject"                      => $subject,
            "email"                      => $email,
            "phone"                      => $phone,
            "message"                      => $message,
            "status"                      => $status,
        ]);

        $this->messageModel->insert($dataInsert);

        session()->setFlashdata("msg_status", "success");
        session()->setFlashdata("msg", "Pesan Terkirim ! Tunggu balasan pada email atau nomor handphone paling lambat 1 x 24 jam");

        return redirect()->back();
    }

    public function cart()
    {
        $carts = $this->cartModel->where('customer_id', session()->get('customer_id'))->findAll();

        $data = [
            'carts' => $carts,
            'db' => $this->db,
        ];
        return view('customer/cart', $data);
    }

    public function add_to_cart()
    {
        if (session()->get('customer_id') == null) {
            return redirect('eshop-customer');
        }

        $product_variant_id = $this->request->getPost('product_variant_id');
        $quantity = $this->request->getPost('quantity');

        $cart = $this->cartModel->where('product_variant_id', $product_variant_id)->where('customer_id', session()->get('customer_id'))->first();
        $data_product_variant = $this->productVariantModel->where('id', $product_variant_id)->first();

        if ($cart) {
            $this->cartModel->update($cart->id, ([
                "quantity" => $cart->quantity + $quantity,
            ]));
        } else {
            if ($data_product_variant->discount == 0) {
                $price = $data_product_variant->price;
            } else {
                $diskon = $data_product_variant->price * $data_product_variant->discount / 100;
                $price = $data_product_variant->price - $diskon;
            }

            $dataInsert = ([
                "product_id"                      => $data_product_variant->product_id,
                "product_variant_id"              => $data_product_variant->id,
                "customer_id"                     => session()->get('customer_id'),
                "quantity"                     => $quantity,
                "price"                  => $price,
                "weight"                => $data_product_variant->weight,
            ]);

            $this->cartModel->insert($dataInsert);
        }

        session()->setFlashdata("msg_status", "success");
        session()->setFlashdata("msg", "Barang berhasil dimasukan ke dalam keranjang !");

        return redirect()->back();
    }

    public function update_item_cart()
    {
        $cart_id = $this->request->getPost('cart_id');
        $quantity = $this->request->getPost('quantity');

        if ($cart_id && $quantity) {
            $this->cartModel->update($cart_id, ([
                "quantity" => $quantity,
            ]));

            session()->setFlashdata("msg_status", "success");
            session()->setFlashdata("msg", "Keranjang berhasil diperbarui !");
        }
    }

    public function remove_item_cart()
    {
        $cart_id = $this->request->getPost('cart_id');

        $this->cartModel->delete($cart_id);

        session()->setFlashdata("msg_status", "success");
        session()->setFlashdata("msg", "Barang dalam keranjang berhasil dihapus !");
    }

    public function checkout()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . config("App")->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $carts = $this->cartModel->where('customer_id', session()->get('customer_id'))->findAll();
        $grandTotal = 0;
        $weightTotal = 0;
        foreach ($carts as $key => $value) {
            $grandTotal += $value->price * $value->quantity;
            $weightTotal += $value->weight * $value->quantity;
        }
        $data = [
            'provinces' => json_decode($response, true)['rajaongkir']['results'],
            'grandTotal' => $grandTotal,
            'weightTotal' => $weightTotal,
        ];
        return view('customer/checkout', $data);
    }

    public function get_cities()
    {
        $provinceId = $this->request->getPost('provinceId');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinceId",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . config("App")->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $data = [
            'cities' => json_decode($response, true)['rajaongkir']['results'],
        ];
        // dd($data);
        return view('customer/ajax/view_option_cities', $data);
    }

    public function get_costs()
    {
        $cityId = $this->request->getPost('cityId');
        $weight = $this->request->getPost('weight');
        $courier = $this->request->getPost('courier');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=109&destination=$cityId&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . config("App")->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $data = [
            'costs' => json_decode($response, true)['rajaongkir']['results'][0]['costs'],
        ];
        // dd(json_decode($response, true)['rajaongkir']['results'][0]['costs']);
        return view('customer/ajax/view_option_service_courier', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url("/"));
    }
    public function process_checkout()
    {
        $weight = $this->request->getPost('weight');
        $grand_total = $this->request->getPost('grand_total');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $province = $this->request->getPost('province');
        $city = $this->request->getPost('city');
        $courier = $this->request->getPost('courier');
        $cost = $this->request->getPost('cost');
        $service = $this->request->getPost('service');
        $address = $this->request->getPost('address');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.rajaongkir.com/starter/city?id=$city&province=$province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . config("App")->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $type = json_decode($response, true)['rajaongkir']['results']['type'];
        $city =  $type . ' ' . json_decode($response, true)['rajaongkir']['results']['city_name'];
        $province = json_decode($response, true)['rajaongkir']['results']['province'];
        $length = 10;
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
            helper('text');
        }

        $no_invoice = 'INV - ' . strtoupper(random_string('alnum', 10));

        $invoice = $this->invoiceModel->insert([
            'invoice'       => $no_invoice,
            'customer_id'          => session()->get('customer_id'),
            'courier'          => $courier,
            'service'          => $service,
            'cost_courier'          => $cost,
            'weight'          => $weight,
            'name'          => $name,
            'order_date'          => date('y-m-d'),
            'phone'         => $phone,
            'province'         => $province,
            'city'         => $city,
            'address'       => $address,
            'status'        => 'pending',
            'grand_total'   => $grand_total + $cost,
        ]);
        $invoice = $this->invoiceModel->where('id', $invoice)->first();
        $carts = $this->cartModel
            ->select([
                'carts.product_id',
                'carts.product_variant_id',
                'carts.quantity',
                'carts.price',
                'products.title',
                'product_variants.size',
            ])
            ->join('products', 'carts.product_id = products.id')
            ->join('product_variants', 'carts.product_variant_id = product_variants.id')
            ->where('carts.customer_id', session()->get('customer_id'))
            ->findAll();
        foreach ($carts as $cart) {
            //insert product ke table order
            $this->orderModel->insert([
                'invoice_id'    => $invoice->id,
                'product_id'    => $cart->product_id,
                'product_variant_id'    => $cart->product_variant_id,
                'product_name'  => $cart->title,
                'variant_name'  => $cart->size,
                'qty'           => $cart->quantity,
                'price'         => $cart->price,
            ]);
        }
        $payload = [
            'transaction_details' => [
                'order_id'      => $invoice->invoice,
                'gross_amount'  => $grand_total + $cost,
            ],
            'customer_details' => [
                'first_name'       => $name,
                'email'            => $email,
                'phone'            => $phone,
                'shipping_address' => $address
            ],
            "cstore" => [
                "alfamart_free_text_1" => "qwerty",
                "alfamart_free_text_2" => "asdfg",
                "alfamart_free_text_3" => "zxcvb"
            ],
            "shopeepay" => [
                "callback_url" => "http://shopeepay.com?order_id=" . $invoice->invoice,
            ]
        ];

        //create snap token
        $snapToken = Snap::getSnapToken($payload);
        $this->invoiceModel->update($invoice->id, ['snap_token' => $snapToken]);
        $this->cartModel->where('customer_id', session()->get('customer_id'))->delete();

        return redirect()->to("/eshop-customer/order-history/$snapToken");
    }

    public function order_histories()
    {
        $data = [
            'invoices' => $this->invoiceModel->orderBy('invoice', 'asc')->findAll(),
        ];
        return view('customer/order_histories', $data);
    }

    public function order_update_status($snap_token, $status)
    {
        $this->invoiceModel->where('snap_token', $snap_token)->set([
            'status' => $status,
        ])->update();
        return redirect()->to(base_url("/eshop-customer/order-history/$snap_token"));
    }

    public function order_history($snapToken)
    {
        $invoice = $this->invoiceModel->where('snap_token', $snapToken)->first();
        $productsId = $this->orderModel->where('invoice_id', $invoice->id)->findColumn('product_id');
        $products = $this->orderModel->where('invoice_id', $invoice->id)->whereIn('product_id', $productsId)->get()->getResultObject();
        $productImages = $this->productImageModel->whereIn('product_id', $productsId)->get()->getResultObject();
        foreach ($products as $key => $value) {
            $i = 0;
            while ($i < count($productImages)) {
                if ($productImages[$i]->product_id == $value->product_id) {
                    $value->product_images[$i] = $productImages[$i]->product_image;
                }
                $i++;
            }
        }
        $data = [
            'invoice' => $this->invoiceModel->where('snap_token', $snapToken)->first(),
            'products' => $products,
        ];
        // dd($data);
        return view('customer/order_detail', $data);
    }
}
