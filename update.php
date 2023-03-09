<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

$skc = query("SELECT * FROM skincare WHERE id = $id")[0];

if( isset($_POST["submit"]) )
{
    if (update ($_POST) > 0 ) {
        echo "
        <script>
            alert('Data Berhasil Diubah');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Gagal Diubah');
            document.location.href = 'index.php';
        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Data</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
    <h1>Update Data Skincare</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $skc["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $skc["gambar"]; ?>">
        <ul>
            <li>
                <label for="merk">Merk : </label>
                <input type="text" name="merk" id="merk" required
                value="<?= $skc["merk"]; ?>">
            </li>
            <li>
                <label for="jenis">Jenis : </label>
                <input type="text" name="jenis" id="jenis"required
                value="<?= $skc["jenis"]; ?>">
            </li>
            <li>
                <label for="ukuran">Ukuran : </label>
                <input type="text" name="ukuran" id="ukuran" required
                value="<?= $skc["ukuran"]; ?>">
            </li>
            <li>
                <label for="expireddate">Expired Date : </label>
                <input type="text" name="expireddate" id="expireddate" required
                value="<?= $skc["expireddate"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label> <br>
                <img src="img/<?= $skc['gambar'];?>" width="50"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type="submit" name="submit">Update Data</button>
            </li>
        </ul>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
</body>
</html>