<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Thêm danh mục</h5>
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
                <form  id="addCategoryForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Tên danh mục -->
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <!-- Tên danh mục -->
                        <div class="col-md-12 mb-3">
                            <label for="img_url" class="form-label">Ảnh</label>
                            <input type="file" class="form-control" id="img_url" name="img_url" value="{{ old('img_url') }}">
                        </div>               
                    </div>                
                    <button type="submit" class="btn btn-primary">Lưu danh mục</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
            var addCategoryModal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
            addCategoryModal.show();
        @endif
    });
</script>