<?php
session_start();
include "koneksi.php";

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Login - NRWS Kosmetik</title>
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
        }
        .login-panel {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-panel .form-control {
            border-radius: 4px;
        }
        .login-panel .btn-primary {
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <!-- Start Header/Navigation -->
    <?php include "includes/navbar.php"; ?>
    <!-- End Header/Navigation -->

    <div class="container login-container">
        <div class="login-panel">
            <h3 class="text-center mb-4">Log In</h3>
            <form method="post">
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Prepared statement untuk menghindari SQL injection
        $stmt = $koneksi->prepare("SELECT * FROM pelanggan WHERE email_pelanggan = ? AND password_pelanggan = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $akun = $result->fetch_assoc();
            $_SESSION["pelanggan"] = $akun;
            echo "<script>alert('Anda sukses login');</script>";
            echo "<script>location = 'checkout.php';</script>";
        } else {
            echo "<script>alert('Gagal login, periksa email dan password Anda');</script>";
            echo "<script>location = 'login.php';</script>";
        }
        $stmt->close();
    }
    ?>

    <!-- Start Footer Section -->
    <?php include "includes/footer.php"; ?>
    <!-- End Footer Section -->

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
