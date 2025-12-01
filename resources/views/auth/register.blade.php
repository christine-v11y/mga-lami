<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="card-title mb-4 text-center">Register</h3>

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            {{-- add enctype="multipart/form-data" for file upload --}}
            <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name') }}" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email') }}" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>

              <div class="mb-3">
                <label for="profile" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="profile" name="profile" accept="image/*">
              </div>

              <button type="submit" class="btn btn-success w-100">Register</button>
            </form>

            <div class="mt-3 text-center">
              <a href="{{ route('login') }}">Already have an account? Login</a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>