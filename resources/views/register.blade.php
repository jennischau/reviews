<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Đăng ký – Review Maps 5★</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('style.css') }}" />
</head>
<body>
  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-md-6 col-lg-4">
      <div class="card shadow-lg border-0">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="60" />
            <h3 class="mt-3 mb-0 fw-bold text-primary">ĐĂNG KÝ</h3>
            <p class="mb-0">
              Bạn đã có tài khoản?
              <a href="{{ url('/login') }}" class="text-decoration-none">Đăng nhập tại đây</a>
            </p>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first() }}
            </div>
          @endif

          <form action="{{ route('postRegister') }}" method="post" class="row g-3">
            @csrf

            <div class="col-12">
              <label class="form-label" for="name">Họ tên</label>
              <input class="form-control" id="name" name="name" type="text" placeholder="Họ và tên" required value="{{ old('name') }}" />
            </div>

            <div class="col-12">
              <label class="form-label" for="email">Email</label>
              <input class="form-control" id="email" name="email" type="email" placeholder="Email" required value="{{ old('email') }}" />
            </div>

            <div class="col-12">
              <label class="form-label" for="password">Mật khẩu</label>
              <input class="form-control" id="password" name="password" type="password" placeholder="Nhập mật khẩu" required />
            </div>

            <div class="col-12">
              <label class="form-label" for="password_confirmation">Xác nhận mật khẩu</label>
              <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Nhập lại mật khẩu" required />
            </div>

            <div class="col-12 d-grid">
              <button class="btn btn-primary" type="submit">
                Đăng Ký <i class="fa fa-user-plus ms-1"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('script.js') }}"></script>
</body>
</html>
