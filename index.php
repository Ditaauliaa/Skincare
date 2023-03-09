<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$skincare = query("SELECT * FROM skincare");

if( isset($_POST["search"]) )
{
    $skincare = search($_POST["keyword"]);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Admin</title>

    <style>
        .loader {
            width: 90px;
            position: absolute;
            top: 107px;
            left: 240px;
            z-index: -1;
            display: none;
        }
    </style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

<a href="logout.php" class="ms-3">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a> <br></br>

<h1 class="ms-3">Daftar Skincare</h1>

<form action="" method="post" class="ms-3">

    <input type="text" name="keyword" size="30" autofocus
    placeholder="Enter Keywords" autocomplete="off" id="keyword">
    <button type="submit" name="search" id="tombol-cari">Search</button>

    <img src="img/loader.gif" class="loader">
    
</form>
<br>

<div id="container">
<table class="table table-light ms-3" border="1" cellpadding="10" cellspacing="0">

<tr>
    <th>No.</th>
    <th>Aksi</th>
    <th>Gambar</th>
    <th>Merk</th>
    <th>Jenis</th>
    <th>Ukuran</th>
    <th>Expired Date</th>
</tr>

<?php $i = 1; ?>
<?php foreach( $skincare as $row ) : ?>
<tr>
    <td><?= $i; ?></td>
    <td>
        <a href="update.php?id= <?= $row["id"]; ?>">update</a> |
        <a href="delete.php?id= <?= $row["id"]; ?>" onclick="
        return confirm('Apakah Anda Yakin?');">delete</a>
    </td>
    <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
    <td><?= $row["merk"]; ?></td>
    <td><?= $row["jenis"]; ?></td>
    <td><?= $row["ukuran"]; ?></td>
    <td><?= $row["expireddate"]; ?></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>

</table>
</div>

<br>
<a href="tambah.php" class="ms-3">Tambah data skincare</a>

<script src="js/jquery-3.6.3.min.js"></script>
<script src="js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>
</html>