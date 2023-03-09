<?php 
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM skincare WHERE
            merk LIKE '%$keyword%' OR
            jenis LIKE '%$keyword%' OR
            ukuran LIKE '%$keyword%' OR
            expireddate LIKE '%$keyword%'
        ";
        
$skincare = query($query);

?>

<table border="1" cellpadding="10" cellspacing="0">

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