<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nhanvien;
use App\Khachhang;
use Validator;
use Hash;

class DangnhapController extends Controller
{
	/**
	 * Kiểm tra #email có phải của #nhanvien không
	 * @param  $email 
	 * @return true là nhân viên
	 */
	public function ktNhanVien($email)
	{
		$email = Nhanvien::where('nv_email', $email)->first();
		return $email != null? true : false;
	}

	public function index() 
	{
		return view('dangnhap');
	}

	// Xử lý đăng nhập
	public function login(Request $request) 
	{
		$email       = $request->email;
		$matKhau     = $request->matKhau;
		$la_nhanVien = $this->ktNhanVien($email);

		if($la_nhanVien) {
			try {
				$nhanvien = Nhanvien::where('nv_email', $email)->first();
				$kt_matkhau = Hash::check($matKhau, $nhanvien->nv_matKhau);
				if($nhanvien && $kt_matkhau) {
					$request->session()->put('nhanvien_hoten', $nhanvien->nv_hoTen);
					$request->session()->put('nhanvien_email', $nhanvien->nv_email);
					$request->session()->put('nhanvien_quyen', $nhanvien->q_ma);
					return response([
						'error'   => false,
						'role'    => 'nhanvien',
						'message' => "Đăng nhập thành công"], 200);
				} else {
					return response([
						'error'   => true,
						'message' => "Email và mật khẩu không hợp lệ"], 200);
				}
			} catch(QueryException $ex) {
				return response(['error' => true, 'message' => $ex->getMessage()], 200);
			} catch (PDOException $ex) {
				return response(['error' => true, 'message' => $ex->getMessage()], 200);
			} catch (Exception $ex) {
				return response(['error' => true, 'message' => $ex->getMessage()], 200);
			}
		} else {
			try {
				$khachhang = Khachhang::where('kh_email', $email)->first();
				$kt_matkhau = Hash::check($matKhau, $khachhang->kh_matKhau);
				if($khachhang && $kt_matkhau) {
					$request->session()->put('khachhang_ma', $khachhang->kh_ma);
					$request->session()->put('khachhang_hoten', $khachhang->kh_hoTen);
					$request->session()->put('khachhang_email', $khachhang->kh_email);
					$request->session()->put('khachhang_nhom', $khachhang->kh_nhom);
					return response([
						'error'   => false,
						'role'    => 'khachhang',
						'message' => "Đăng nhập thành công"], 200);
				} else {
					return response([
						'error'   => true,
						'message' => "Email và mật khẩu không hợp lệ"], 200);
				}
			} catch(QueryException $ex) {
				return response(['error' => true, 'message' => $ex->getMessage()], 200);
			} catch (PDOException $ex) {
				return response(['error' => true, 'message' => $ex->getMessage()], 200);
			} catch (Exception $ex) {
				return response(['error' => true, 'message' => $ex->getMessage()], 200);
			}
		}
	}

	public function logout(Request $request) {
		try {
			if($request->session()->exists('nhanvien_hoten')) {
				$request->session()->forget('nhanvien_hoten');
			}
			if($request->session()->exists('nhanvien_email')) {
				$request->session()->forget('nhanvien_email');
			}
			if($request->session()->exists('nhanvien_quyen')) {
				$request->session()->forget('nhanvien_quyen');
			}
			if($request->session()->exists('khachhang_hoten')) {
				$request->session()->forget('khachhang_hoten');
			}
			if($request->session()->exists('khachhang_email')) {
				$request->session()->forget('khachhang_email');
			}
			if($request->session()->exists('khachhang_nhom')) {
				$request->session()->forget('khachhang_nhom');
			}
			return response(['error' => false, 'message' => "Đăng xuất thành công"], 200);
		} catch (Exception $ex) {
			return response(['error' => true, 'message' => $ex->getMessage()], 200);
		}
	}
}
