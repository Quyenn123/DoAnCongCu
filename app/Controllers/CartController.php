<?php 

namespace App\Controllers;

use App\Lib\Mail\Mail;
use System\Src\Controller;
use App\Models\ProductModel;
use System\Src\Session;
use App\Models\CustomerModel;
use App\Models\CartModel;

class CartController extends Controller
{
    protected $productModel;
    protected $customerModel;
    protected $cartModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->customerModel = new CustomerModel();
        $this->cartModel = new CartModel();
    }

    public function store()
    {
        if (! $this->isMethod('post')) return redirect('/');

        $productId = (int) $this->input('product_id');
        $qty = (int) $this->input('qty');

        #Lấy thông tin sản phẩm và kiểm tra 
        $product = $this->productModel->getProductById($productId);
        if ($product == null) return redirect('/');
        if ($product['price'] == 0) return redirect('/');

        #Kiểm tra giỏ hàng
        if (isset($_SESSION['cart'][$productId])) {
            #sản phẩm đã tồn tại trong giỏ hàng thì mình cộng số lượng
            $_SESSION['cart'][$productId]['qty'] += $qty;
        } else {
            #tạo mới giỏ hàng cho sản phẩm $productId
            $_SESSION['cart'][$productId] = [
                'qty' => $qty,
                'title' => $product['title'],
                'price' => $product['price_sale'] != 0 ? $product['price_sale'] : $product['price'],
                'thumb' => $product['thumb']
            ];
        }

        return redirect('/cart');
    }

    public function index()
    {
        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
            return view('main', [
                'title' => 'Giỏ hàng trống',
                'template' => 'carts/empty'
            ]);
        }

        return view('main', [
            'title' => 'Giỏ hàng',
            'template' => 'carts/detail'
        ]);
    }

    public function update()
    {
        if (! $this->isMethod('post')) return redirect('/');

        $qty = $this->input('qty');
        foreach ($qty as $productId => $number) {
            if ($number > 0 && isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['qty'] = $number;
            }
        }

        Session::flash('success', 'Cập nhật thành công');
    
        return redirect('/cart');
    }

    public function delete($id = 0)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }

        Session::flash('success', 'Xóa thành công');

        return redirect('/cart');
    }

    public function order()
    {
        if (! $this->isMethod('post')) return redirect('/');

        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
            Session::flash('error', 'Giỏ hàng trống, vui lòng thử lại');
            return redirect('/cart');
        }

        $data = [
            'name' => $this->input('name'),
            'phone' => $this->input('phone'),
            'address' => $this->input('address'),
            'email' => $this->input('email'),
            'note' => $this->input('note'),
        ];

        if ($data['name'] == null || $data['phone'] == null || $data['address'] == null) {
            Session::flash('error', 'Trường tên, điện thoại, địa chỉ không được bỏ trống');
            return redirect('/cart');
        }

        #insert customer
        $customerId = $this->customerModel->insert($data);
        if ($customerId == null) {
            Session::flash('error', 'Hệ thống đang bận vui lòng quay lại sau');
            return redirect('/cart');
        }

        #Insert Giỏ hàng
        $dataCart = $this->getDataCart($customerId);
        $result = $this->cartModel->insert($dataCart);
        if ($result) {
            $mail = Mail::send();
            if ($mail) {
                unset($_SESSION['cart']);
                Session::flash('success', 'Đặt hàng thành công');
                return redirect('/cart');
            }
        }

        Session::flash('error', 'Hệ thống đang bận vui lòng quay lại sau');
        return redirect('/cart');
    }

    private function getDataCart($customerId)
    {
        $dataCart = [];
        foreach ($_SESSION['cart'] as $productId => $cart) {
            $dataCart[] = array_merge($cart, [
                'customer_id' => $customerId,
                'product_id' => $productId,
                'sum' => $cart['qty'] * $cart['price']
            ]);
        }

        return $dataCart;
    }
}