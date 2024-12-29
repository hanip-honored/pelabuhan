<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelabuhan</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="form-container">
            <div class="mb-4">
                <span class="fs-4 fw-bold">Login Pelabuhan</span>
            </div>
            <form action="login" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required />
                </div>
                <button class="btn btn-dark w-100">Login</button>
            </form>
        </div>
        <div class="image-container">
            <img src="<?php echo base_url('assets/images/image_login.png'); ?>" alt="Welcome Aboard">
        </div>
    </div>
</body>
</html>
