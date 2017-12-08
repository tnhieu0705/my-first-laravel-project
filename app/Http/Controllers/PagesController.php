<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Chude;
use App\Loaisanpham;
use App\Sanpham;
use App\Donhang;
use App\Chitietdonhang;
use App\Khachhang;
use Session;
use DB;
use Cart;

class PagesController extends Controller
{
	function __construct()
	{
		$ds_chude       = Chude::all();
		$ds_loaisanpham = Loaisanpham::all();

		$data = array(
			'ds_chude'       => $ds_chude,
			'ds_loaisanpham' => $ds_loaisanpham,
		);
		view()->share($data);
	}

    /**
     * Hiển thị sản phẩm trên trang chủ ('/')
     * #sanpham
     * #giỏ hàng (số lượng đặt)
     */
    public function index() 
    {
    	$ds_sanpham = Sanpham::orderBy('created_at', 'desc')->take(9)->get();
        $sl_dat     = 0;

        foreach(Cart::content() as $item) {
            $sl_dat = $sl_dat + $item->qty;
        }
        return view('trangchu/trangchu', ['ds_sanpham' => $ds_sanpham, 'sl_dat' => $sl_dat]);
    }

    //Load thêm sản phẩm trên trang chủ
    public function loadMore(Request $request)
    {
        $output = '';
        $url    = 'http://localhost:1000/www/my-project/public/';
        $id     = $request->id;

        $ds_sanpham = Sanpham::where('sp_ma', '<', $id)->orderBy('created_at', 'desc')->take(6)->get();

        if(!$ds_sanpham->isEmpty()) {
            foreach ($ds_sanpham as $sanpham) {
                $output .= '<div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="#"><img class="card-img-top" src="'.$url.'uploaded/sanpham/'.$sanpham->sp_hinh.'" alt=""></a>
                <div class="card-body">
                <h4 class="card-title">
                <a href="#">'.$sanpham->sp_ten.'</a>
                </h4>
                <h5>'.number_format($sanpham->sp_giaBan, '0', ',', '.').' VNĐ </h5>
                </div>
                <div class="card-footer">
                <a class="btn btn-info btn-sm" role="button" href="'.$url.'dathang/'.$sanpham->sp_ma.'" title="">
                <i class="fa fa-fw fa-shopping-cart"></i> Thêm vào giỏ hàng
                </a>
                </div>
                </div>
                </div>';
            }
            $output .= '<div class="col-lg-12 col-md-12 mb-2 align-middle" id="remove-row">
            <button id="btn-more" data-id="'.$sanpham->sp_ma.'" class="btn btn-block btn-primary" > Xem thêm </button>
            </div>';

            echo $output;
        }
    }

    /**
     * Hiển thị sản phẩm theo #chude và #loaisanpham ('{tenkhongdau}/{id}')
     * $tenkhongdau
     * $id
     */
    public function showListProducts($tenkhongdau, $id)
    {
    	$loaisanpham    = Loaisanpham::where('l_ma', $id)->first();
    	$chude          = $loaisanpham->thuocChuDe->cd_ten;
    	$ds_loaisanpham = Loaisanpham::where('cd_ma', $loaisanpham->thuocChuDe->cd_ma)->get();
    	$ds_sanpham     = Sanpham::where('l_ma', $id)->orderBy('created_at', 'desc')->take(6)->get();
        $sl_dat         = 0;

        foreach(Cart::content() as $item) {
            $sl_dat = $sl_dat + $item->qty;
        }

        $data = array(
          'chude'          => $chude,
          'ds_loaisanpham' => $ds_loaisanpham,
          'ds_sanpham'     => $ds_sanpham,
          'sl_dat'         => $sl_dat
      );
        return view('trangchu/sanpham_danhsach', $data);
    }

    /**
     * Trang quản lý giỏ hàng ('/giohang')
     * #sanpham
     * #cart
     */
    public function shoppingCart()
    {
        $cart = Cart::content();
        $total = 0;
        $totalPrice = 0;
        $sl_dat = 0;
        foreach(Cart::content() as $item) {
            $totalPrice = $item->qty * $item->price;
            $total = $total + $totalPrice;
            $sl_dat = $sl_dat + $item->qty;
        }
        $data = array(
            'cart'   => $cart,
            'total'  => $total,
            'sl_dat' => $sl_dat
        );
        return view('trangchu/giohang', $data);
    }

    /**
     * Chức năng thêm #sanpham vào giỏ hàng
     * #sanpham
     * #id
     */
    public function getOrder($id) 
    {
        $dh_sanpham = DB::table('sanpham')->where('sp_ma', $id)->first();
        Cart::add(array(
            'id' => $id,
            'name' => $dh_sanpham->sp_ten,
            'qty' => 1,
            'price' => $dh_sanpham->sp_giaBan,
        ));
        $cart = Cart::content();
        $cartTotal = Cart::total();
        Session::put('giohang', $cart);
        Session::put('giohang_total', $cartTotal);
        return redirect()->route('trangchu', ['cart' => $cart]);
    }

    /**
     * Chức năng đặt hàng
     * Lưu đơn hàng đã đặt vào #database
     */
    public function order(Request $request)
    {
        if(!Session::has('khachhang_hoten')) {
            return view('dangnhap', [
                'orderError' => 'true',
                'message' => 'Quý khách vui lòng đăng nhập để đặt hàng'
            ]);
        } else {
            $orderCart = $request->session()->get('giohang');
            $kh_ma = $request->session()->get('khachhang_ma');
            $khachhang = Khachhang::where('kh_ma', $kh_ma)->first();
            
            $donhang = new Donhang();
            $donhang->kh_ma = $kh_ma;
            $donhang->dh_thoiGianDatHang = Carbon::now();
            $donhang->dh_thoiGianNhanHang = Carbon::now();
            $donhang->dh_diaChi = $khachhang->kh_diaChi;
            $donhang->dh_dienThoai = $khachhang->kh_dienThoai;
            $donhang->nv_xuLy = 1;
            $donhang->dh_trangThai = 1;
            $donhang->save();

            foreach ($orderCart as $order) {
                $ct_donhang = new Chitietdonhang();
                $ct_donhang->dh_ma = $donhang->dh_ma;
                $ct_donhang->sp_ma = $order->id;
                $ct_donhang->ctdh_soLuong  = $order->qty;
                $ct_donhang->ctdh_donGia = number_format($order->price, 0, ',', '');
                $ct_donhang->save();
            }
            Cart::destroy();
            $request->session()->forget('giohang');
            return redirect()->back()->with('orderMessage', 'Đơn hàng của quý khách đã được ghi nhận');
        }
    }

    //Cập nhật số lượng #sanpham trên trang ('/giohang')
    public function updateCart($id, $sl)
    {
        $cart = Cart::update($id, $sl);
        if($cart) {
            return response([
                'error' => false,
                'message' => $cart->toJson()
            ]);
        } else {
            return response([
                'error' => true,
                'message' => 'Thao tác thất bại'
            ]);
        }
    }

    //Xóa #sanpham đã đặt trên trang ('/giohang')
    public function deleteCart($id)
    {
        Cart::remove($id);
        return redirect()->route('giohang');
    }
}
