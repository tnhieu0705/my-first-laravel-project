<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Hinhanh;
use App\Sanpham;
use Validator;
use Image;
use File;

class HinhanhController extends Controller
{
	public function sttHinhMoi($sp_ma) { 
		$hinhanh = Hinhanh::where('sp_ma', $sp_ma)->orderBy('ha_stt', 'DESC')->first();
		$stt = !$hinhanh? 0: $hinhanh["ha_stt"];
		return ++$stt;
	}

	public function hinhanh_sanpham()
	{
        //
		$sp_ma = Input::get('sp_ma');

		$hinhanh = Hinhanh::where('sp_ma', $sp_ma)->get();
        // $json = json_encode($hinhanh);
		if(count($hinhanh) > 0) {
			return response([
				'error'   => false,
				'message' => $hinhanh->toJson()
			], 200);
		} else {
			return response([
				'error'   => true,
				'message' => 'Sản phẩm chưa có hình ảnh'
			], 200);
		}
	}

	public function upload_hinh(Request $request, $id) 
	{
		$sl_hinhanh = Hinhanh::where('sp_ma', $id)->get();
		if(count($sl_hinhanh) >= 3) {
			return response([
				'error'   => true,
				'message' => 'Thao tác thất bại (giới hạn 3 hình cho 1 sản phẩm)'
			], 200);
		} else {
			if(Input::hasFile('hinhAnh')) {
				$file = $request->file('hinhAnh');
				$size = $file->getClientSize();
				if($size > 1500000) {
					return response([
						'error'   => true,
						'message' => 'Dung lượng ảnh không vượt quá 1.5Mb'
					], 200);
				}
				$extension = $file->getClientOriginalExtension();
				if($extension != 'jpg' && $extension != 'jpeg' && $extension != 'png') {
					return response([
						'error'   => true,
						'message' => 'Chỉ chấp nhận hình ảnh dạng (*.jpg, *.jpeg, *.png)'
					], 200);
				}
				$stt = $this->sttHinhMoi($id);
				$tenHinh = $id.'_'.$stt.'_'.$file->getClientOriginalName();
				$path = public_path('uploaded/sanpham/'.$tenHinh);
				Image::make($file->getRealPath())->resize(700, 400)->save($path);
				// $file->move('uploaded/sanpham/', $tenHinh);

				$sanpham_hinhanh = new Hinhanh();
				if($sanpham_hinhanh) {
					$sanpham_hinhanh->sp_ma = $id;
					$sanpham_hinhanh->ha_stt = $stt;
					$sanpham_hinhanh->ha_ten = $tenHinh;
					$sanpham_hinhanh->save();
				}

				$sanpham = Sanpham::where('sp_ma', $id)->first();
				if($sanpham) {
					$sanpham->sp_hinh = $tenHinh;
					$sanpham->save();
				}

				return response([
					'error'   => false,
					'message' => $sanpham_hinhanh->toJson()
				], 200);
			}
			else {
				return response([
					'error'   => true,
					'message' => 'Vui lòng chọn hình ảnh'
				], 200);
			}
		}	
	}

	public function delete_hinh($id)
	{
		$sp_ma = Input::get('sp_ma');
		$sanpham_hinhanh = Hinhanh::where(['sp_ma' => $sp_ma, 'ha_stt' => $id])->first();

		$hinhanh = 'uploaded/sanpham/'.$sanpham_hinhanh->h_ten;
		if(File::exists($hinhanh)) { 
			File::delete($hinhanh); 
		}
		$sanpham_hinhanh->delete();

		$hinhanh_conlai = Hinhanh::where('sp_ma', $sp_ma)->orderBy('ha_stt', 'desc')->first();
		$sohinh = count($hinhanh_conlai);

		if($sohinh > 0) {
			$sanpham = Sanpham::where('sp_ma', $sp_ma)->first();

			$sanpham->sp_hinh = $hinhanh_conlai->ha_ten;
			$sanpham->save();
		}
		else {
			$sanpham = Sanpham::where('sp_ma', $sp_ma)->first();

			$sanpham->sp_hinh = null;
			$sanpham->save();
		}
		return response('data: '.$sanpham_hinhanh. 'ten hinh: '.$hinhanh);
	}
}
