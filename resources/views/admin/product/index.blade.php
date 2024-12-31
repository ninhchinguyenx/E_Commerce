@extends('admin.layouts.app');

@section('content')
<style>
    /* Khu vực upload ảnh chính */
.upload-area {
    border: 2px dashed #007bff;
    border-radius: 8px;
    padding: 10px;
    text-align: center;
    background-color: #f8f9fa;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.upload-area:hover {
    background-color: #e9ecef;
}

/* Nút chọn ảnh */
.upload-area button {
    margin-top: 2px;
}

/* Khu vực preview ảnh chính */
.preview-area {
    margin-top: 15px;
    display: flex;
    justify-content: center;
}

.preview-area .preview-image {
    position: relative;
    width: 100px;
    height: 100px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.preview-area .preview-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Nút xóa trên ảnh */
.preview-area .preview-image .remove-preview {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: rgba(255, 0, 0, 0.8);
    color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 18px;
    line-height: 1;
    padding: 0;
    transition: background-color 0.3s ease;
}

.preview-area .preview-image .remove-preview:hover {
    background-color: rgba(255, 0, 0, 1);
}

</style>
<div class="container mt-5">
    <h1 class="mb-4">Quản lý sản phẩm</h1>

    <!-- Button to open Add Product modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Thêm sản phẩm</button>
        @if(session('error'))
            <div class="alert alert-danger">
                {!! nl2br(e(session('error'))) !!}
            </div>
        @endif
    <!-- Product Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Ảnh chính sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá gốc</th>
                <th>Giá sale</th>
                <th>Danh mục</th>
                <th>Kích hoạt</th>
                <th>Tags</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="productTableBody">
            <!-- Example row -->
            @foreach ($products as $item)     
                <tr>
                    <td>{{$item->sku}}</td>
                    <td>
                        @if($item->img_thumbnail && Storage::exists($item->img_thumbnail))
                            <img src="{{asset('storage/' . $item->img_thumbnail)}}" alt="" height="100" >
                        @else
                          <span>Không có hình ảnh</span> 
                        @endif
                    </td>
                    <td>{{$item->name}}</td>
                    <td>{{ number_format($item->price_regular, 2) }} ₫</td>
                    <td>{{ number_format($item->price_sale, 2) }} ₫</td>
                    <td>
                        {{$item->category->name}}
                    </td>
                    <td>
                        <span class="badge  {{$item->is_active ? 'text-bg-primary' : 'text-bg-secondary'}} ">{{$item->is_active ? 'Bật' : 'Tắt'}}</span>
                    </td>
                    <td>
                        {{-- dd($item->tags); --}}
                        @foreach ($item->tags as $tagname)
                            <span class="badge text-bg-info">{{$tagname->name}}</span>
                        @endforeach
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#detailProductModal"
                            data-sku = "{{$item->sku}}"
                            data-name="{{$item->name}}"
                            data-price_regular="{{$item->price_regular}}"
                            data-price_sale="{{$item->price_sale}}"
                            data-short_description="{{$item->short_description}}"
                            data-detailed_description="{{$item->detailed_description}}"
                            data-short_description="{{$item->short_description}}"
                            data-category="{{$item->category->name}}"
                            data-tags="{{ json_encode($item->tags)}}"
                            data-is_active="{{$item->is_active}}"
                            data-is_hot_deal="{{$item->is_hot_deal}}"
                            data-is_good_deal="{{$item->is_good_deal}}"
                            data-is_new="{{$item->is_new}}"
                            data-img_thumbnail="{{$item->img_thumbnail}}"
                        >Chi tiết</button>
                        <a href="{{route('products.edit', $item)}}" class="btn btn-warning btn-sm edit-product-btn">Sửa </a>
                       
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $products->links() }}
    </div>
    <!-- Add Product Modal -->
    @include('admin.product.addProductModal')

    {{-- <!-- Detail Product Modal -->
    @include('admin.product.detailProductModal') --}}
    <!-- Edit Product Modal -->

    
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"> </script>
<script src="{{asset('js/product/uploadImg.js') }}"></script>
{{-- <script src="{{asset('js/product/editProduct.js') }}"></script> --}}
{{-- <script src="{{asset('js/product/detailProduct.js') }}"></script> --}}

@endsection