<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhacungcapRequest extends FormRequest
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
            'ten'     => 'required|max:150|unique:nhacungcap,ncc_ten,'.$this->segment(3).',ncc_ma',
            'daiDien' => 'required|max:200',
            'diaChi'  => 'required|max:255',
            'sdt'     => 'required|digits_between:10,12|numeric|unique:nhacungcap,ncc_dienThoai,'.$this->segment(3).',ncc_ma',
            'email'   => 'nullable|email|max:100|unique:nhacungcap,ncc_email,'.$this->segment(3).',ncc_ma'
        ];
    }

    public function messages() 
    {
        return [
            'ten.required'       => 'Vui lòng nhập tên nhà cung cấp',
            'ten.max'            => 'Tên nhà cung cấp tối đa 150 ký tự',
            'ten.unique'         => 'Tên nhà cung cấp đã tồn tại',
            'daiDien.required'   => 'Vui lòng nhập tên người đại diện',
            'daiDien.max'        => 'Tên người đại diện tối đa 200 ký tự',
            'diaChi.required'    => 'Vui lòng nhập địa chỉ nhà cung cấp',
            'diaChi.max'         => 'Địa chỉ tối đa 255 ký tự',
            'sdt.required'       => 'Vui lòng nhập số điện thoại',
            'sdt.digits_between' => 'Nhập sai số điện thoại',
            'sdt.numeric'        => 'Nhập sai số điện thoại',
            'sdt.unique'         => 'Số điện thoại đã tồn tại',
            'email.email'        => 'Địa chỉ email không hợp lệ',
            'email.max'          => 'Địa chỉ email tối đa 100 ký tự',
            'email.unique'       => 'Địa chỉ email đã tồn tại'
        ];
    }
}
