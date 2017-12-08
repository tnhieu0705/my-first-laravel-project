<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SanphamRequest extends FormRequest
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
            'ten'      => 'required|min:2|max:200|unique:sanpham,sp_ten,'.$this->segment(3).',sp_ma',
            'giaGoc'   => 'required|numeric|max:4200000000',
            'giaBan'   => 'required|numeric|max:4200000000',
            'thongTin' => 'nullable',
            'xuatXu'   => 'required|min:2|max:50'
        ];
    }

    public function messages()
    {
        return [
            'ten.required'    => 'Vui lòng nhập tên sản phẩm',
            'ten.min'         => 'Tên sản phẩm không hợp lệ (tối thiểu 2 ký tự)',
            'ten.max'         => 'Tên sản phẩm không hợp lệ (tối đa 200 ký tự)',
            'ten.unique'      => 'Tên sản phẩm đã tồn tại',
            'giaGoc.required' => 'Vui lòng nhập giá gốc cho sản phẩm',
            'giaGoc.max'      => 'Giá gốc không vượt quá 4.200.000.000',
            'giaBan.required' => 'Vui lòng nhập giá bán cho sản phẩm',
            'giaBan.max'      => 'Giá bán không vượt quá 4.200.000.000',
            'xuatXu.required' => 'Vui lòng nhập xuất xứ của sản phẩm',
            'xuatXu.min'      => 'Xuất xứ không hợp lệ (tối thiểu 2 ký tự)',
            'xuatXu.max'      => 'Xuất xứ không hợp lệ (tối đa 2 ký tự)'
        ];
    }
}
