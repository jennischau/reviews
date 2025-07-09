<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/responsive.css') }}">

</head>

<body>
    <div id="app">
        @include('admin.layout.header')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </header>
            @yield('content')
        </div>
        @include('admin.layout.footer')

    </div>
    <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('js/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const toggleHide = document.querySelector('.sidebar-hide');
            const toggleShow = document.querySelector('.burger-btn');

            // Khi nhấn nút đóng sidebar
            if (toggleHide && sidebar) {
                toggleHide.addEventListener('click', function (e) {
                    e.preventDefault();
                    sidebar.classList.remove('active');

                    // Ẩn các menu đang active (nếu cần)
                    document.querySelectorAll('.sidebar-item.active').forEach(function (item) {
                        item.classList.remove('active');
                    });
                });
            }

            // Khi nhấn nút burger để mở lại
            if (toggleShow && sidebar) {
                toggleShow.addEventListener('click', function (e) {
                    e.preventDefault();
                    sidebar.classList.add('active');

                    // Nếu muốn khôi phục mục menu đang active thì không làm gì thêm
                    // Nếu muốn bật menu cụ thể lại thì có thể thêm thủ công ở đây
                });
            }
        });
    </script>

</body>

</html>
