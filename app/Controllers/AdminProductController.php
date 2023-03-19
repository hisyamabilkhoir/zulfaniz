<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminProductController extends BaseController
{
    private $categoryModel;
    private $productModel;
    private $productImageModel;
    private $productVariantModel;
    private $OrderModel;
    private $cartModel;

    public function __construct()
    {
        $this->categoryModel = new \App\Models\CategoryModel();
        $this->productModel = new \App\Models\ProductModel();
        $this->productImageModel = new \App\Models\ProductImageModel();
        $this->productVariantModel = new \App\Models\ProductVariantModel();
        $this->OrderModel = new \App\Models\OrderModel();
        $this->cartModel = new \App\Models\CartModel();
        helper("form");
    }

    public function admin_product()
    {
        $products = $this->productModel
            ->join('categories', 'products.category_id = categories.id', 'left')
            ->select(
                'products.id,
                products.slug,
                products.title,
                products.category_id,
                products.content,
                categories.name as category_name,'
            )
            ->orderBy('products.title')
            ->get()
            ->getResultObject();
        $data = [
            'products' => $products,
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/admin_products', $data);
    }

    public function admin_products_view_add()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'categories' => $this->categoryModel->findAll(),
        ];
        return view('admin/admin_products_view_add', $data);
    }

    public function admin_product_add_process()
    {

        $name = $this->request->getPost('title');
        $category = $this->request->getPost('category');
        $content = $this->request->getPost('content');

        $names = explode(" ", $name);
        $slug = implode('-', $names);
        if (!$this->validate([
            'title'      => [
                'title' => 'is_unique[products.title]',
                'errors' => [
                    'is_unique' => 'Nama produk sudah ada',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/eshop-admin/products/view-add'))->withInput()->with('validation', $validation);
        }

        $this->productModel->insert([
            "title"          => $name,
            "slug"          => strtolower($slug),
            "category_id"          => $category,
            "content"          => $content,
        ]);

        $id = $this->productModel->getInsertID();
        $totalImage = $this->request->getPost('totalImage');
        for ($i = 0; $i <= $totalImage; $i++) {
            $image = $this->request->getFile("image_$i");
            if (is_uploaded_file($image)) {
                $namePicture = $image->getRandomName();
                $image->move(ROOTPATH . 'public/product_images', $namePicture);
                $this->productImageModel->insert([
                    'product_id' => $id,
                    'product_image' => $namePicture,
                ]);
            }
        }
        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', "Produk $name berhasil ditambahkan!");
        return redirect()->to(base_url("eshop-admin/products"));
    }

    public function admin_products_view_edit($id)
    {
        $product = $this->productModel
            ->join('categories', 'products.category_id = categories.id', 'left')
            ->select(
                'products.id,
                products.slug,
                products.title,
                products.category_id,
                products.content,
                categories.name as category_name,'
            )
            ->where('products.id', $id)
            ->first();
        $productImage = $this->productImageModel->where('product_id', $id)->findAll();

        $data = [
            'product' => $product,
            'product_images' => $productImage,
            'categories' => $this->categoryModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/admin_products_view_edit', $data);
    }

    public function admin_products_edit_process()
    {
        $id = $this->request->getPost('id');
        $name = $this->request->getPost('title');
        $category = $this->request->getPost('category');
        $content = $this->request->getPost('content');

        $names = explode(" ", $name);
        $slug = implode('-', $names);
        $dataTitleSama = $this->productModel->where(['title' => $name, 'id !=' => $id])->first();
        $rule = 'required';
        if ($dataTitleSama) {
            $rule = 'is_unique[products.title]';
        }
        if (!$this->validate([
            'title'      => [
                'title' => $rule,
                'errors' => [
                    'is_unique' => 'Nama produk sudah ada',
                ],
            ],
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to(base_url("eshop-admin/products/view_edit/$id"))->withInput()->with('validation', $validation);
        }

        $this->productModel->set([
            "title"          => $name,
            "slug"          => strtolower($slug),
            "category_id"          => $category,
            "content"          => $content,
        ])->where('id', $id)->update();


        $totalImageEdit = $this->request->getPost('totalImageEdit');
        for ($i = 1; $i < $totalImageEdit; $i++) {
            $Idimage = $this->request->getPost("id_image_edit_$i");
            $image = $this->request->getFile("image_edit_$i");
            if (is_uploaded_file($image)) {
                $namePicture = $image->getRandomName();
                $nameOldImage = $this->productImageModel->where('id', $Idimage)->first();
                unlink('product_images/' . $nameOldImage->product_image);
                $image->move(ROOTPATH . 'public/product_images', $namePicture);
                $this->productImageModel->set([
                    'product_image' => $namePicture,
                ])->where('id', $Idimage)->update();
            }
        }

        $totalImage = $this->request->getPost('totalImage');
        for ($i = 0; $i <= $totalImage; $i++) {
            $image = $this->request->getFile("image_$i");
            $this->productImageModel->where('product_id', $i);
            if (is_uploaded_file($image)) {
                $namePicture = $image->getRandomName();
                $image->move(ROOTPATH . 'public/product_images', $namePicture);
                $this->productImageModel->insert([
                    'product_id' => $id,
                    'product_image' => $namePicture,
                ]);
            }
        }
        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', "Gambar Produk berhasil Diubah!");
        return redirect()->to(base_url("eshop-admin/products/view_edit/$id"));
    }

    public function admin_product_images_delete($productId, $id)
    {
        $productImage = $this->productImageModel->find($id);
        $product_images = $this->productImageModel->countAllResults();
        if ($product_images < 2) {
            session()->setFlashdata('msg_status', 'warning');
            session()->setFlashdata('msg', "Produk harus memiliki gambar minimal 1");
            return redirect()->to(base_url("eshop-admin/products/view_edit/$productId"));
        }
        unlink('product_images/' . $productImage->product_image);
        $this->productImageModel->delete($id);
        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', "Gambar Produk berhasil dihapus!");
        return redirect()->to(base_url("eshop-admin/products/view_edit/$productId"));
    }

    public function admin_products_delete($id)
    {
        $productData = $this->productModel->where('id', $id)->first();
        $productInCart = $this->cartModel->where('product_id', $id)->first();
        $productInOrder = $this->OrderModel->where('product_id', $id)->first();
        if ($productInCart && $productInOrder) {
            session()->setFlashdata('msg_status', 'warning');
            session()->setFlashdata('msg', "Produk gagal dihapus karena sudah terpakai");
            return redirect()->to(base_url("eshop-admin/products"));
        }
        $Images = $this->productImageModel->select('product_image')->where('product_id', $id)->findAll();
        foreach ($Images as $image) {
            unlink('product_images/' . $image->product_image);
        }
        $this->productImageModel->where('product_id', $id)->delete();
        $this->productVariantModel->where('product_id', $id)->delete();
        $this->productModel->delete($id);
        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', "Produk $productData->title berhasil dihapus!");
        return redirect()->to(base_url('eshop-admin/products'));
    }

    public function admin_product_variants($productId)
    {
        $data = [
            'product_variants' => $this->productVariantModel->where('product_id', $productId)->findAll(),
            'productId' => $productId,
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/admin_product_variants', $data);
    }

    public function admin_product_variants_add_process()
    {
        $productId = $this->request->getPost('productId');


        $size = $this->request->getPost("size");
        $price = $this->request->getPost("price");
        $weight = $this->request->getPost("weight");
        $discount = $this->request->getPost("discount");
        $stock = $this->request->getPost("stock");
        $productId = $this->request->getPost("productId");
        $dataSizeSama = $this->productVariantModel->where(['size' => $size, 'product_id' => $productId])->first();
        if ($dataSizeSama) {
            session()->setFlashdata('msg_status', 'warning');
            session()->setFlashdata('msg', "Ukuran produk $size sudah ada");
            return redirect()->to("/eshop-admin/product/variants/$productId");
        }
        $this->productVariantModel->insert([
            "size"          => $size,
            "price"          => $price,
            "weight"          => $weight,
            "discount"          => $discount,
            "stock"          => $stock,
            "product_id"          => $productId,
        ]);
        // dd()
        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', "Produk varian $size berhasil ditambahkan!");
        return redirect()->to(base_url("/eshop-admin/product/variants/$productId"));
    }

    public function admin_product_variants_edit()
    {
        $id = $this->request->getPost('id');
        $data = [
            'product_variant' => $this->productVariantModel->find($id),
            'productId' => $this->request->getPost('productId'),
        ];
        return view('admin/ajax/modal_view_edit_product_variant', $data);
    }

    public function admin_product_variants_edit_process()
    {
        $product_variant_id = $this->request->getPost('product_variant_id');
        $product_id = $this->request->getPost('product_id');
        $size = $this->request->getPost('size');
        $price = $this->request->getPost('price');
        $weight = $this->request->getPost('weight');
        $discount = $this->request->getPost('discount');
        $stock = $this->request->getPost('stock');
        $stock_in = $this->request->getPost('stock_in');
        $stock_out = $this->request->getPost('stock_out');
        $dataSizeSama = $this->productVariantModel->where(['size' => $size, 'id !=' => $product_variant_id, 'product_id' => $product_id])->first();
        if ($dataSizeSama) {
            session()->setFlashdata('msg_status', 'warning');
            session()->setFlashdata('msg', "Ukuran produk $size sudah ada");
            return redirect()->to("/eshop-admin/product/variants/$product_id");
        }
        $newStock = (int)$stock - (int)$stock_out;
        if ($newStock < 0) {
            session()->setFlashdata('msg_status', 'warning');
            session()->setFlashdata('msg', "stock keluar produk variant melebihi batas stok awal");
            return redirect()->to(base_url("/eshop-admin/product/variants/$product_id"));
        }
        $stock = (int)$stock_in + (int)$newStock;
        $this->productVariantModel->where("id", $product_variant_id)
            ->set([
                "size" => $size,
                "price" => $price,
                "weight" => $weight,
                "discount" => $discount,
                "stock" => $stock,
            ])->update();
        $this->cartModel->where("product_variant_id", $product_variant_id)
            ->set([
                "price" => $price - ($price * $discount / 100),
            ])->update();

        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', "Kategori $size berhasil disimpan!");
        return redirect()->to(base_url("/eshop-admin/product/variants/$product_id"));
    }

    public function admin_product_variants_delete($id, $productId)
    {
        $productVariantData = $this->productVariantModel->find($id);
        $productInCart = $this->cartModel->where('product_variant_id', $id)->first();
        $productInOrder = $this->OrderModel->where('product_variant_id', $id)->first();
        if ($productInCart && $productInOrder) {
            session()->setFlashdata('msg_status', 'warning');
            session()->setFlashdata('msg', "Produk gagal dihapus karena sudah terpakai");
            return redirect()->to(base_url("eshop-admin/products"));
        }
        $this->productVariantModel->where('id', $id)->delete();
        session()->setFlashdata('msg_status', 'success');
        session()->setFlashdata('msg', "Produk varian $productVariantData->size berhasil dihapus!");
        return redirect()->to(base_url("/eshop-admin/product/variants/$productId"));
    }
}
