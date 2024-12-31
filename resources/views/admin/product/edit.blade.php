@extends('admin.layouts.app')

@section('content')
    <div class="p-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                  <li class="breadcrumb-item">Quản lí sản phẩm</li>
                  <li class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</li>
                </ol>
              </nav>
        </div>
        <hr class="border border-danger  opacity-50">
        <div class="p-3 border">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="addProductForm" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-7">              
                            <div class="row">
                                <!-- Tên sản phẩm -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                                </div>
                                    
                                <!-- SKU -->
                                <div class="col-md-6 mb-3">
                                    <label for="sku" class="form-label">SKU</label>
                               
                                    <input type="text" class="form-control" id="sku" name="sku" value="{{  old('sku', $product->sku) }}">
                                </div>
                        
                                <!-- Giá -->
                                <div class="col-md-6 mb-3">
                                    <label for="price_regular" class="form-label">Giá</label>
                                    <input type="number" class="form-control" id="price_regular" name="price_regular" value="{{ old('price_regular', $product->price_regular) }}">
                                </div>
                        
                                <!-- Giá giảm -->
                                <div class="col-md-6 mb-3">
                                    <label for="price_sale" class="form-label">Giá Khuyến Mãi</label>
                                    <input type="number" class="form-control" id="price_sale" name="price_sale" value="{{ old('price_sale', $product->price_sale) }}">
                                </div>
                        
                                <!-- Số lượng -->
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Số Lượng</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity' , $product->quantity) }}">
                                </div>
                        
                                <!-- Mô tả ngắn -->
                                <div class="col-md-12 mb-3">
                                    <label for="short_description" class="form-label">Mô Tả Ngắn</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                                </div>
                        
                                <!-- Mô tả chi tiết -->
                                <div class="col-md-12 mb-3">
                                    <label for="detailed_description" class="form-label">Mô Tả Chi Tiết</label>
                                    <textarea class="form-control" id="detailed_description" name="detailed_description" rows="5">{{ old('detailed_description', $product->detailed_description) }}</textarea>
                                </div>
                        
                                <!-- Danh mục -->
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Danh Mục</label>
                                    <select class="form-select" id="category_id" name="category_id">

                                        @foreach ($categories as $key => $val)
                                            <option value="{{ $key }}" @selected($key == $product->category_id)>
                                                {{ $val }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tag -->
                                <div class="col-md-6 mb-3">
                                    <label for="tag" class="form-label">Tag</label>
                                    <select class="form-select" id="tag" name="tags[]" multiple>
                    
                                        @foreach ($tags as $key => $val)
                                            <option value="{{ $key }}"  @selected(in_array($key, $productTags))>
                                                {{ $val }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 border-start p-2">
                            <!-- Checkbox -->
                            <div class="col-md-12 mb-3">
                                <div class="row row-cols-3 p-2">        
                                    <div class="form-check">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="{{$product->is_active}}" @checked($product->is_active == 1)>
                                        <label class="form-check-label" for="is_active">Kích Hoạt</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" name="is_hot_deal" value="0">

                                        <input class="form-check-input" type="checkbox" id="is_hot_deal" name="is_hot_deal" value="{{$product->is_hot_deal}}" @checked($product->is_hot_deal == 1)>
                                        <label class="form-check-label" for="is_hot_deal">Ưu Đãi Nổi Bật</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" name="is_good_deal" value="0">

                                        <input class="form-check-input" type="checkbox" id="is_good_deal" name="is_good_deal" value="{{$product->is_good_deal}}" @checked($product->is_good_deal == 1)>
                                        <label class="form-check-label" for="is_good_deal">Ưu Đãi Tốt</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="hidden" name="is_new" value="0">

                                        <input class="form-check-input" type="checkbox" id="is_new" name="is_new" value="{{$product->is_new}}" @checked($product->is_new == 1)>
                                        <label class="form-check-label" for="is_new">Sản Phẩm Mới</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12  mb-3">
                                <label for="img_thumbnail" class="form-label">Ảnh Chính</label>
                                <input type="file" name="img_thumbnail" onchange="previewImageThumnail(this)" placeholder="Sửa ảnh">                               
                               <div class="mt-2">
                               
                                <img src="{{asset('storage/' . $product->img_thumbnail)}}" id="preview" class="img-thumbnail mt-2" style="; max-width: 100px;">
                               </div>
                            </div>
                            <div class="col-md-12  mb-3">
                                <div class="custom-file-input">
                                    <label for="fileInput">
                                        Chọn ảnh phụ
                                    </label>
                                    <input type="file" id="fileInput" name="gallery[]" multiple onchange="previewImages(this)">
                                </div>
                               
                                <div class="gallery mt-2 "id="gallery">
                                    @if (!empty($product->product_gallery))
                                        @foreach ($product->product_gallery as $image)
                                            <div class="image-container">
                                                <img src="{{ asset('storage/' . $image->img_url) }}" alt="Gallery Image">
                                                <button type="button" class="remove-btn" onclick="removeExistingImage(this, '{{ $image->id }}', '{{ $image->img_url }}')">x</button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Biến Thể</label>

                            <!-- Input đồng giá -->
                            <div class="mt-3 d-none mb-3" id="uniformPriceContainer">
                                <label for="uniformPrice" class="form-label">Giá Đồng Giá</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" id="uniformPrice" placeholder="Nhập giá đồng giá">
                                    <button type="button" class="btn btn-primary" id="applyUniformPriceButton">Áp Dụng</button>
                                </div>
                            </div>
                            <div id="variantContainer">
                                <!-- Table for Variants -->
                                    <table class="table table-bordered" id="variantTable">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $variants = [];
                                                $product->variants->map(function($item) use (&$variants) {
                                                    $key = $item->product_size_id . '-' . $item->product_color_id;
                                                    $variants[$key] = [
                                                        'quantity' => $item->quantity,
                                                        'price' => $item->price,
                                                        'img_url' => $item->img_url
                                                    ];
                                                });  
                                               
                                            @endphp
                                            @foreach ($sizes as $sizeID => $sizeName)
                                            @php
                                                $flagRowspan = true;
                                            @endphp
                                                @foreach ($colors as $colorID => $colorName)
                                                <tr class="text-center">
                                                    @if($flagRowspan)
                                                        <td style="vertical-align: middle;"
                                                            rowspan="{{ count($colors) }}"><b>{{ $sizeName  }}</b></td>
                                                    @endif
                                                    @php
                                                        $flagRowspan = false;
                                                        $key = $sizeID . '-' . $colorID;
                                                    @endphp
                                                 
                                                    <td>{{$colorName}}</td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ $variants[$key]['price'] }}"
                                                        name="product_variants[{{$sizeID}}-{{$colorID}}][price]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="{{ $variants[$key]['quantity'] }}"
                                                        name="product_variants[{{$sizeID}}-{{$colorID}}][quantity]">
                                                        
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" accept="image/*"
                                                        name="product_variants[{{$sizeID}}-{{$colorID}}][img_url]" 
                                                         onchange="previewImage(this)"
                                                        >
                                                        @if(!$variants[$key]['img_url'] == null)    
                                                        <input type="hidden" name="product_variants[{{$sizeID}}-{{$colorID}}][current_image]" value="{{$variants[$key]['img_url']}}">
                                                        <img src="{{asset('storage/' . $variants[$key]['img_url'])}}" alt="Preview" class="img-thumbnail mt-2" style="max-width: 100px;">
                                                        @else 
                                                        <img src="" alt="Preview" class="img-thumbnail mt-2" style="display:none; max-width: 100px;">
                                                        @endif
                                                                        

                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                </form>
        </div>
    </div>
@endsection
<script>
    function previewImage(input) {        
        const file = input.files[0]; // Lấy tệp từ input
        const img = input.nextElementSibling; // Thẻ <img> nằm ngay sau input

        if (file) {
            const reader = new FileReader(); // Tạo FileReader để đọc tệp
            reader.onload = function (e) {
                img.src = e.target.result; // Đặt URL của ảnh vào src
                img.style.display = 'block'; // Hiển thị ảnh
            };
            reader.readAsDataURL(file); // Đọc tệp dưới dạng Data URL
        }
    }
    function previewImageThumnail(input) {
        const preview = document.getElementById('preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block'; // Hiển thị ảnh
            };
            reader.readAsDataURL(input.files[0]); // Đọc file và chuyển thành URL
        }
    }
    function previewImages(input) {
        const gallery = document.getElementById('gallery');
        const files = input.files;

        for (const file of files) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const container = document.createElement('div');
                container.className = 'image-container';

                const img = document.createElement('img');
                img.src = e.target.result;

                const removeBtn = document.createElement('button');
                removeBtn.className = 'remove-btn';
                removeBtn.textContent = 'x';
                removeBtn.onclick = function () {
                    gallery.removeChild(container);
                };

                container.appendChild(img);
                container.appendChild(removeBtn);

                gallery.appendChild(container);
            };

            reader.readAsDataURL(file);
        }
    }
    function removeExistingImage(button, id ,imageUrl,) {
        const container = button.parentElement;
        container.remove();

        // Tạo input ẩn để xóa ảnh trên server khi gửi form
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'removed_images[]'; // Tên mảng để gửi ảnh cần xóa
        hiddenInput.value = id;
        document.getElementById('gallery').appendChild(hiddenInput);
    }
</script>
<style>
    body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .image-container {
            position: relative;
            width: 150px;
            height: 150px;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .image-container .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
            font-size: 16px;
            line-height: 20px;
            text-align: center;
        }
        .custom-file-input {
            position: relative;
            display: inline-block;
            width: 100%;
            max-width: 300px;
        }

        .custom-file-input input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .custom-file-input label {
            display: block;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .custom-file-input label:hover {
            background-color: #45a049;
        }

        .custom-file-input label:active {
            background-color: #3e8e41;
        }

        .custom-file-input label span {
            display: block;
            margin-top: 5px;
            font-size: 14px;
            color: #ddd;
            font-weight: normal;
        }
    .img-thumbnail {
    max-width: 100px;
    max-height: 100px;
}
</style>