@extends('admin.layouts.app');

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Quản lý sản phẩm</h1>

    <!-- Button to open Add Product modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Thêm sản phẩm</button>

    <!-- Product Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="productTableBody">
            <!-- Example row -->
            <tr>
                <td>1</td>
                <td>Sản phẩm A</td>
                <td>100,000 VND</td>
                <td>Mô tả sản phẩm A</td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal">Sửa</button>
                    <button class="btn btn-danger btn-sm">Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  id="addProductForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Tên sản phẩm -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                    
                            <!-- Slug -->
                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                            </div>
                    
                            <!-- SKU -->
                            <div class="col-md-6 mb-3">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}">
                            </div>
                    
                            <!-- Giá -->
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                            </div>
                    
                            <!-- Giá giảm -->
                            <div class="col-md-6 mb-3">
                                <label for="price_sale" class="form-label">Giá Khuyến Mãi</label>
                                <input type="number" class="form-control" id="price_sale" name="price_sale" value="{{ old('price_sale') }}">
                            </div>
                    
                            <!-- Số lượng -->
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Số Lượng</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
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
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <!-- Checkbox -->
                            <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Kích Hoạt</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_hot_deal" name="is_hot_deal" value="1" {{ old('is_hot_deal') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_hot_deal">Ưu Đãi Nổi Bật</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_good_deal" name="is_good_deal" value="1" {{ old('is_good_deal') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_good_deal">Ưu Đãi Tốt</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_new" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_new">Sản Phẩm Mới</label>
                                </div>
                            </div>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Sửa sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="editProductName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="editProductPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="editProductDescription" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

