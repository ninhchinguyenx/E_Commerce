<div id="sidebar" class="d-flex flex-column">
    <div class="logo">
        <h4>Logo</h4>
    </div>
    <div class="menu-item">
        <i class="bi bi-house"></i><span>Dashboard</span>
    </div>
    <div class="menu-item">
       <a href="{{route('products.index')}}" class="text-white text-decoration-none"> <i class="bi bi-box"></i><span>Quản lý sản phẩm</span> </a>
    </div>
    <div class="menu-item">
        <a href="{{route('categories.index')}}" class="text-white text-decoration-none"></i> <i class="bi bi-border-width"></i> <span>Quản lý danh mục</span> </a>
     </div>
     <div class="menu-item">
        <a href="{{route('tags.index')}}" class="text-white text-decoration-none"></i> <i class="bi bi-border-width"></i> <span>Quản lý tag</span> </a>
     </div>
    <div class="menu-item">
        <i class="bi bi-gear"></i><span>Cài đặt</span>
    </div>
    <div class="menu-item" id="toggleSidebar">
        <i class="bi bi-list"></i><span>Đóng/mở</span>
    </div>
</div>