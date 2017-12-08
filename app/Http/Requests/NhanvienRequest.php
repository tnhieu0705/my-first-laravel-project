<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhanvienRequest extends FormRequest
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
            'hoTen'    => 'required|min:2|max:100',
            'ngaySinh' => 'required',
            'diaChi'   => 'nullable|min:2|max:255',
            'sdt'      => 'nullable|unique:nhanvien,nv_dienThoai,'.$this->segment(3).',nv_ma|digits_between:10,12|numeric',
            'email'    => 'email|required|unique:nhanvien,nv_email,'.$this->segment(3).',nv_ma|max:100'
        ];
    }

    public function messages()
    {
        return [
            'hoTen.required'     => 'Vui lòng nhập họ tên nhân viên',
            'hoTen.min'          => 'Họ tên nhân viên tối thiểu 2 ký tự',
            'hoTen.max'          => 'Họ tên nhân viên tối đa 100 ký tự',
            'ngaySinh.required'  => 'Vui lòng nhập ngày sinh nhân viên',
            'diaChi.min'         => 'Địa chỉ tối thiểu 2 ký tự',
            'diaChi.max'         => 'Địa chỉ tối đa 255 ký tự',
            'sdt.unique'         => 'Số điện thoại đã tồn tại',
            'sdt.digits_between' => 'Nhập sai só điện thoại',
            'sdt.numeric'        => 'Nhập sai só điện thoại',
            'email.email'        => 'Nhập sai địa chỉ email',
            'email.required'     => 'Vui lòng nhập địa chỉ email',
            'email.unique'       => 'Địa chỉ email đã tồn tại',
            'email.max'          => 'Địa chỉ email tối đa 100 ký tự'
        ];
    }
}
