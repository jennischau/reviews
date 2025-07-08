<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Đăng nhập – Review Maps 5★</title>

  <!-- Bootstrap 5 CSS -->
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
            <h3 class="mt-3 mb-0 fw-bold text-primary">ĐĂNG NHẬP</h3>
            <p class="mb-0">
              Bạn chưa có tài khoản?
              <a href="{{ url('/register') }}" class="text-decoration-none">Đăng ký tại đây</a>
            </p>
          </div>

          @if ($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first() }}
            </div>
          @endif

          <!-- FORM -->
          <form action="{{ route('postLogin') }}" method="post" class="row g-3">
            @csrf

            <div class="col-12">
              <label class="form-label" for="email">Email</label>
              <input
                class="form-control"
                id="email"
                name="email"
                type="email"
                placeholder="Email"
                value="{{ old('email') }}"
                required
              />
            </div>

            <div class="col-12">
              <label class="form-label" for="password">Mật khẩu</label>
              <div class="input-group" id="show_hide_password">
                <input
                  class="form-control border-end-0"
                  id="password"
                  name="password"
                  type="password"
                  placeholder="Nhập mật khẩu"
                  required
                />
                <button type="button" class="input-group-text bg-transparent border-start-0">
                  <i class="fa-solid fa-eye"></i>
                </button>
              </div>
            </div>

            <div class="col-6">
              <div class="form-check form-switch">
                <input
                  class="form-check-input"
                  type="checkbox"
                  id="remember"
                  name="remember"
                  checked
                />
                <label class="form-check-label" for="remember">Nhớ tài khoản</label>
              </div>
            </div>

            <div class="col-6 text-end">
              <a href="{{ url('/forgot-password') }}" class="small text-decoration-none">Quên mật khẩu?</a>
            </div>

            <div class="col-12 d-grid">
              <button class="btn btn-primary" type="submit">
                Đăng Nhập <i class="fa fa-arrow-right ms-1"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('script.js') }}"></script>
</body>
</html>
