<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php?page=home");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config/mysql_connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM NhanVien WHERE email_nhan_vien = '$email' AND mat_khau_nhan_vien = '$password'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['ma_nhan_vien'];
        $_SESSION['username'] = $user['ten_nhan_vien'];

        header("Location: index.php?page=home");
        exit;
    } else {
        $error = "Email hoặc mật khẩu không chính xác!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Muhamad Nauval Azhar">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="This is a login page template based on Bootstrap 5">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="card shadow-lg mt-5">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">ĐĂNG NHẬP</h1>
                            <!-- Hiển thị Bootstrap Alert nếu có lỗi -->
                            <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                            <?php endif; ?>
                            <form method="POST" class="needs-validation" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">Địa chỉ Email</label>
                                    <input id="email" type="email" class="form-control" name="email" value="" required
                                        autofocus>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Mật khẩu</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary ms-auto">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/login.js"></script>
</body>

</html>