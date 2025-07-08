<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tạo Đơn Review Map</title>

  <!-- Bootstrap & FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.css"/>

  <style>
    body { background:#f3f8ff; }
    .logo { width:90px; }
    .total_price { font-weight:700; }
  </style>
</head>
<body>
    @include('layouts.header')
    <div class="container py-4">
        @yield('content')
    </div>


  <!-- JS libs -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios@1/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.10.1/sweetalert2.min.js"></script>

  <script>
    const PRICE_PER = 13000 + 2000; // đơn giá
    const EXTRA_PRICE = 500;        // ảnh + nội dung riêng

    function formatCurrency(n) {
      return n.toLocaleString('vi-VN') + ' đ';
    }

    function calcTotal() {
      const quantity = +document.querySelector('[name="quantity"]').value || 0;
      let total = quantity * PRICE_PER;
      if (document.querySelector('[name="drive_link"]').value.trim()) total += quantity * EXTRA_PRICE;
      document.querySelector('.total_price').textContent = formatCurrency(total);
    }

    document.querySelectorAll('[name="quantity"],[name="drive_link"]').forEach(el => el.addEventListener('input', calcTotal));
    calcTotal();
  </script>
</body>
</html>
