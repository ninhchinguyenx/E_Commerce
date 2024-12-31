<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form  id="addProductForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-7">              
                            <div class="row">
                                <!-- Tên sản phẩm -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Tên Sản Phẩm</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>
                                    
                                <!-- SKU -->
                                <div class="col-md-6 mb-3">
                                    <label for="sku" class="form-label">SKU</label>
                                    @php
                                        $defaultSKU = 'SP' . str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
                                    @endphp
                                    <input type="text" class="form-control" id="sku" name="sku" value="{{  old('sku', $defaultSKU) }}">
                                </div>
                        
                                <!-- Giá -->
                                <div class="col-md-6 mb-3">
                                    <label for="price_regular" class="form-label">Giá</label>
                                    <input type="number" class="form-control" id="price_regular" name="price_regular" value="{{ old('price_regular') }}">
                                </div>
                        
                                <!-- Giá giảm -->
                                <div class="col-md-6 mb-3">
                                    <label for="price_sale" class="form-label">Giá Khuyến Mãi</label>
                                    <input type="number" class="form-control" id="price_sale" name="price_sale" value="{{ old('price_sale') }}">
                                </div>
                        
                                <!-- Số lượng -->
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" class="form-label">Số Lượng</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}">
                                </div>
                        
                                <!-- Mô tả ngắn -->
                                <div class="col-md-12 mb-3">
                                    <label for="short_description" class="form-label">Mô Tả Ngắn</label>
                                    <textarea class="form-control" id="short_description" name="short_description" rows="3">{{ old('short_description') }}</textarea>
                                </div>
                        
                                <!-- Mô tả chi tiết -->
                                <div class="col-md-12 mb-3">
                                    <label for="detailed_description" class="form-label">Mô Tả Chi Tiết</label>
                                    <textarea class="form-control" id="detailed_description" name="detailed_description" rows="5">{{ old('detailed_description') }}</textarea>
                                </div>
                        
                                <!-- Danh mục -->
                                <div class="col-md-6 mb-3">
                                    <label for="category_id" class="form-label">Danh Mục</label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach ($categories as $key => $val)
                                            <option value="{{ $key }}" {{ old('category_id') == $key ? 'selected' : '' }}>
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
                                            <option value="{{ $key }}" {{ old('tag_id') == $key ? 'selected' : '' }}>
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
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                                        <label class="form-check-label" for="is_active">Kích Hoạt</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_hot_deal" name="is_hot_deal" value="1" checked>
                                        <label class="form-check-label" for="is_hot_deal">Ưu Đãi Nổi Bật</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_good_deal" name="is_good_deal" value="1" checked>
                                        <label class="form-check-label" for="is_good_deal">Ưu Đãi Tốt</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_new" name="is_new" value="1" checked>
                                        <label class="form-check-label" for="is_new">Sản Phẩm Mới</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="img_thumbnail" class="form-label">Ảnh chính</label>
                                <div class="upload-area" id="uploadThumbnailArea">
                                    <p>Kéo và thả ảnh vào đây hoặc</p>
                                    <input type="file" id="img_thumbnail" name="img_thumbnail" class="form-control d-none" accept="image/*">
                                    <button type="button" class="btn btn-primary" id="uploadThumbnailButton">Chọn ảnh</button>
                                </div>
                                <div class="preview-area" id="thumbnailPreviewArea">
                                    <!-- Preview ảnh chính -->
                                </div>
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label for="gallery" class="form-label">Thêm ảnh mới</label>
                                <div class="upload-area" id="uploadGalleryArea">
                                    <p>Kéo và thả ảnh vào đây hoặc</p>
                                    <input type="file" id="gallery" name="gallery[]" class="form-control d-none" multiple accept="image/*">
                                    <button type="button" class="btn btn-primary" id="uploadGalleryButton">Chọn ảnh</button>
                                </div>
                                <div class="preview-area" id="galleryPreviewArea">
                                    <!-- Preview ảnh gallery -->
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
                                    <table class="table table-bordered d-none" id="variantTable">
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
                                            @foreach ($sizes as $sizeID => $sizeName)
                                                @foreach ($colors as $colorID => $colorName)
                                                <tr class="text-center">
                                                    <td>{{$sizeName}}</td>
                                                    <td>{{$colorName}}</td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                        name="product_variants[{{$sizeID}}-{{$colorID}}][price]">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                        name="product_variants[{{$sizeID}}-{{$colorID}}][quantity]">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control" accept="image/*"
                                                        name="product_variants[{{$sizeID}}-{{$colorID}}][img_url]" 
                                                         onchange="previewImage(this)"
                                                        >
                                                        <img src="" alt="Preview" class="img-thumbnail mt-2" style="display:none; max-width: 100px;">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                            <button type="button" class="btn btn-secondary" id="addVariantButton">Thêm Biến Thể</button>
                            <button type="button" class="btn btn-secondary d-none" id="removeVariantButton">Xoá biến thể</button>
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
            var addProductModal = new bootstrap.Modal(document.getElementById('addProductModal'));
            addProductModal.show();
        @endif     
        
        const addVariantButton = document.getElementById('addVariantButton');
        const removeVariantButton = document.getElementById('removeVariantButton');
        const tableVariant  = document.getElementById('variantTable');
        addVariantButton.addEventListener('click', function (){
            tableVariant.classList.remove('d-none');
            addVariantButton.classList.add('d-none');
            removeVariantButton.classList.remove('d-none');      
        })
        removeVariantButton.addEventListener('click', function (){
            tableVariant.classList.add('d-none');
            addVariantButton.classList.remove('d-none');
            removeVariantButton.classList.add('d-none');      

        })
        
    });
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
    function mergeTableCells() {
    const table = document.getElementById("variantTable");
    const rows = table.querySelectorAll("tbody tr");
    let previousCell = null;
    let rowspan = 1;

    rows.forEach((row, index) => {
        const currentCell = row.cells[0]; // Lấy ô trong cột "Size"

        if (previousCell && currentCell.innerText === previousCell.innerText) {
            // Nếu giá trị giống nhau, tăng rowspan và ẩn ô hiện tại
            rowspan++;
            currentCell.style.display = "none";
            previousCell.rowSpan = rowspan;
        } else {
            // Nếu khác, reset rowspan và cập nhật previousCell
            rowspan = 1;
            previousCell = currentCell;
        }
    });
}

// Gọi hàm sau khi bảng được tải
mergeTableCells();

</script>
<style>
    .img-thumbnail {
    max-width: 100px;
    max-height: 100px;
}
</style>