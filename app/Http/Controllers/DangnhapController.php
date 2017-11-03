<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nhanvien;
use Validator;
use Hash;

class DangnhapController extends Controller
{
	public function index() 
	{
		return view('dangnhap');
	}

	public function login(Request $request) 
	{
		$email = $request->email;
		$matKhau = $request->matKhau;

		try {
			$nhanvien = Nhanvien::where('nv_email', $email)->first();
			$kt_matkhau = Hash::check($matKhau, $nhanvien->nv_matKhau);
			if($nhanvien && $kt_matkhau) {
				$request->session()->put('nhanvien_hoten', $nhanvien->nv_hoTen);
				$request->session()->put('nhanvien_email', $nhanvien->nv_email);
				$request->session()->put('nhanvien_quyen', $nhanvien->q_ma);
				return response([
					'error' => false,
					'message' => "Đăng nhập thành công"], 200);
			} else {
				return response([
					'error' => true,
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

	public function logout(Request $request) {
		try {
			if($request->session()->exists('nhanvien_hoten')) {
				$request->session()->forget('nhanvien_hoten');
			}
			if($request->session()->exists('nhanvien_email'))
				$request->session()->forget('nhanvien_email');
			if($request->session()->exists('nhanvien_quyen'))
				$request->session()->forget('nhanvien_quyen');
			return response(['error' => false, 'message' => "Đăng xuất thành công"], 200);
		} catch (Exception $ex) {
			return response(['error' => true, 'message' => $ex->getMessage()], 200);
		}
	}
}
