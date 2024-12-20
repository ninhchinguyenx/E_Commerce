@extends('admin.layouts.app');

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Quản lý danh mục</h1>

    <!-- Button to open Add Category modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Thêm danh mục</button>

    <!-- Category Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tên danh mục</th>
                <th>Ảnh</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="CategoryTableBody">
            <!-- Example row -->
            <tr>
                <td>1</td>
                <td>danh mục A</td>
                <td>100,000 VND</td>
                <td>Mô tả danh mục A</td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal">Sửa</button>
                    <button class="btn btn-danger btn-sm">Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Thêm danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  id="addCategoryForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Tên danh mục -->
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                    
                            <!-- Checkbox -->
                            <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Kích Hoạt</label>
                                </div>
                                
                            </div>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Lưu danh mục</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Sửa danh mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="editCategoryName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryPrice" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="editCategoryPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryDescription" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="editCategoryDescription" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

