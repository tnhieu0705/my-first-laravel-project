<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KhachhangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hoTen'    => 'required|max:100',
            'diaChi'   => 'nullable|max:255',
            'sdt'      => 'nullable|digits_between:10,12|numeric|unique:khachhang,kh_dienThoai',
            'email'    => 'required|email|max:100|unique:khachhang,kh_email',
            'matKhau'  => 'required|min:6|max:20|same:matKhauConfirmed',
        ];
    }

    public function messages()
    {
        return [
            'hoTen.required'     => 'Vui lòng nhập họ và tên',
            'hoTen.max'          => 'Họ và tên tối đa 100 ký tự',
            'diaChi.max'         => 'Địa chỉ tối đâ 255 ký tự',
            'sdt.digits_between' => 'Nhập sai số điện thoại',
            'sdt.numeric'        => 'Nhập sai số điện thoại',
            'sdt.unique'         => 'Số điện thoại đã được sử dụng',
            'email.required'     => 'Vui lòng nhập địa chỉ email',
            'email.email'        => 'Địa chỉ email không hợp lệ',
            'email.max'          => 'Địa chỉ email tối đa 100 ký tự',
            'email.unique'       => 'Địa chỉ email đã được sử dụng',
            'matKhau.required'   => 'Vui lòng nhập mật khẩu',
            'matKhau.min'        => 'Mật khẩu ít nhất 6 ký tự',
            'matKhau.max'        => 'Mật khẩu tối đa 20 ký tự',
            'matKhau.same' => 'Xác nhận mật khẩu không trùng khớp'
        ];
    }
}
