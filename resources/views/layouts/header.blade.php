<header class="py-4 text-center d-none d-md-block">
    <a href="/"><img src="/images/logo/logo.png" class="logo" alt="logo"></a>
    <h1 class="text-danger fs-4 fw-bold mt-3">DOANH NGHIỆP THUÊ REVIEW</h1>
</header>

  <!-- Navbar desktop -->
    <div class="container">
    <nav class="navbar navbar-expand-md d-none d-md-block bg-white shadow-sm">
      <div class="container">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}"><i class="fas fa-map me-2"></i></i>Tạo Đơn Review Map</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}"><i class="fas fa-user me-1"></i>Tài khoản</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('payment') }}"><i class="fas fa-credit-card me-1"></i>Nạp Tiền</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('order') }}"><i class="fas fa-history me-1"></i>Lịch Sử</a></li>
            <li class="nav-item"><a class="nav-link" href="https://zalo.me/0878067442" target="_blank"><i class="fas fa-circle-info me-1"></i>Liên hệ</a></li>
            <li class="nav-item" style="display: flex; align-items: center;">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-link nav-link p-0">
                    <i class="fas fa-sign-out me-1"></i>Đăng Xuất
                  </button>
                </form>
              </li>

          </ul>
      </div>
    </nav>
    </div>

  <!-- Quick menu mobile -->
  <div class="d-md-none bg-white border-bottom py-2">
    <div class="container d-flex flex-wrap gap-2">
      <a class="btn btn-primary flex-grow-1" href="/business"><i class="fas fa-map"></i> Review Map</a>
      <a class="btn btn-outline-primary flex-grow-1" href="/business/profile"><i class="fas fa-user"></i></a>
      <a class="btn btn-outline-primary flex-grow-1" href="/business/deposits"><i class="fas fa-credit-card"></i></a>
      <a class="btn btn-outline-primary flex-grow-1" href="/business/orders"><i class="fas fa-history"></i></a>
    </div>
  </div>
