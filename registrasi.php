<?php 
require 'functions.php';

if( isset($_POST["register"]) )
{
    if ( registrasi($_POST) > 0) {
        echo "
        <script>
            alert('User Baru Berhasil Ditambahkan');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Registrasi</title>
    <style>
        label {
            display: block;
        }
    </style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <h1 class="ms-3">Registrasi</h1>

    <form action="" method="post" class="ms-3">
        <ul>
            <li class="mb-3">
                <label for="username">Username : </label>
                <input type="text" name="username" id="username"
                required>
            </li>
            <li class="mb-3">
                <label for="password">Password : </label>
                <input type="password" name="password" id="password"
                required>
            </li>
            <li class="mb-3">
                <label for="confirm">Confirm Password : </label>
                <input type="password" name="confirm" id="confirm"
                required>
            </li>
            <li>
                <button type="submit" name="register">Sign Up</button>
            </li>
        </ul>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
</body>
</html>