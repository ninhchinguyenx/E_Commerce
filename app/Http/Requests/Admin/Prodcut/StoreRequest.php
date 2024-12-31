<?php

namespace App\Http\Requests\Admin\Prodcut;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'sku' => 'required|string|max:255|unique:products,sku',
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|min:0|lt:price_regular',
            'quantity' => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:500',
            'detailed_description' => 'nullable|string',
            'img_thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category_id' => 'required',
            'product_gallery_id' => 'nullable|array',
            'product_gallery_id.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm là bắt buộc.',
            'sku.required' => 'SKU là bắt buộc.',
            'sku.unique' => 'SKU đã tồn tại.',
            'price_regular.required' => 'Giá sản phẩm là bắt buộc.',
            'price_regular.numeric' => 'Giá phải là số.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'quantity.required' => 'Số lượng là bắt buộc.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'img_thumbnail.image' => 'Ảnh chính phải là file hình ảnh.',
            'category_id.required' => 'Danh mục là bắt buộc.',
            // 'category_id.exists' => 'Danh mục không hợp lệ.',
        ];
    }
}
