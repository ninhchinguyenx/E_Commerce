<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            margin: 0;
        }
        #sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            transition: width 0.3s;
            height: 100vh;
            position: fixed;
            overflow: hidden;
        }
        #sidebar.collapsed {
            width: 80px;
        }
        #sidebar .logo {
            text-align: center;
            padding: 15px;
        }
        #sidebar .menu-item {
            padding: 10px 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        #sidebar .menu-item i {
            margin-right: 10px;
        }
        #sidebar.collapsed .menu-item span {
            display: none;
        }
        #sidebar .menu-item:hover {
            background-color: #495057;
        }
        #content {
            flex-grow: 1;
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s;
        }
        #sidebar.collapsed + #content {
            margin-left: 80px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    @include('admin.layouts.components.sidebar')

    <!-- Main Content -->
    <div id="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
    </script>
    @yield('scripts')
</body>
</html>
