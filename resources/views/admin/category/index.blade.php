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
                <th>Slug</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="CategoryTableBody">
            <!-- Example row -->
            @foreach ($categories as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->slug}}</td>
                    <td>
                        @if($item->img_url && Storage::exists($item->img_url))
                            <img src="{{asset('storage/' . $item->img_url)}}" alt="" width="100">
                        @else
                          <span>Không có hình ảnh</span> 
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-category-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editCategoryModal" 
                            data-id="{{ $item->id }}" 
                            data-name="{{ $item->name }}" 
                            data-slug="{{ $item->slug }}" 
                            data-img-url="{{ $item->img_url }}">Sửa</button>
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </td>
                </tr>          
            @endforeach
        </tbody>
    </table>
        <!-- Phân trang -->
    <div>
        {{ $categories->links() }}
    </div>
    <!-- Add Category Modal -->
    @include('admin.category.addCategoryModal')

    <!-- Edit Category Modal -->
    @include('admin.category.editCategoryModal')
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"> </script>
<script>
    $(document).on('click', '.edit-category-btn', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const slug = $(this).data('slug');
        const imgUrl = $(this).data('img-url');

        // Điền dữ liệu vào modal
        $('#editCategoryModal input[name="id"]').val(id);
        $('#editCategoryModal input[name="name"]').val(name);
        $('#editCategoryModal input[name="slug"]').val(slug);

        $('#editCategoryModal form').attr('action', `http://127.0.0.1:8000/admin/categories/${id}`);

        // Hiển thị ảnh nếu có
        if (imgUrl) {
            $('#editCategoryModal #currentImage').attr('src', '/storage/' + imgUrl).show();
        } else {
            $('#editCategoryModal #currentImage').hide();
        }
    });

</script>
@endsection

