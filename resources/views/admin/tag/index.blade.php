@extends('admin.layouts.app');

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Quản lý Tag</h1>

    <!-- Button to open Add Tag modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTagModal">Thêm tag</button>

    <!-- Tag Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tên Tag</th>
                <th>Slug</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="TagTableBody">
            <!-- Example row -->
            @foreach ($tags as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->slug}}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-Tag-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editTagModal" 
                            data-name="{{ $item->name }}" 
                            data-id="{{ $item->id }}" 
                            >Sửa</button>
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </td>
                </tr>          
            @endforeach
        </tbody>
    </table>
        <!-- Phân trang -->
    <div>
        {{ $tags->links() }}
    </div>
    <!-- Add Tag Modal -->
    @include('admin.tag.addTagModal')

    <!-- Edit Tag Modal -->
    @include('admin.tag.editTagModal')
</div>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"> </script>
<script>
    $(document).on('click', '.edit-Tag-btn', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        // Điền dữ liệu vào modal
        $('#editTagModal input[name="name"]').val(name);

        $('#editTagModal form').attr('action', `http://127.0.0.1:8000/admin/tags/${id}`);
    });

</script>
@endsection

