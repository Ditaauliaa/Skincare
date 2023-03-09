<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpskc");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data)
{
    global $conn;
    $merk = htmlspecialchars($data["merk"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $expireddate = htmlspecialchars($data["expireddate"]);

    //upload gambar
    $gambar = upload();
    if( !$gambar ){
        return false;
    }

    // query insert data
    $query = "INSERT INTO skincare VALUES
    (NULL, '$merk', '$jenis', '$ukuran', '$expireddate', '$gambar')
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


    //  cek apakah tidak ada gambar yang diupload
    if( $error === 4 ){
        echo "<script>
                alert('Pilih gambar terlebih dahulu');
             </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ekstensiGambarValid) )
    {
        echo "<script>
                alert('Yang anda upload bukan gambar');
            </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('Ukuran gambar terlalu besar');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}


function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM skincare WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function update($data)
{
    global $conn;

    $id = $data["id"];
    $merk = htmlspecialchars($data["merk"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $expireddate = htmlspecialchars($data["expireddate"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE skincare SET
                merk = '$merk',
                jenis = '$jenis',
                ukuran = '$ukuran',
                expireddate = '$expireddate',
                gambar = '$gambar'
            WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function search($keyword)
{
    $query = "SELECT * FROM skincare WHERE
                merk LIKE '%$keyword%' OR
                jenis LIKE '%$keyword%' OR
                ukuran LIKE '%$keyword%' OR
                expireddate LIKE '%$keyword%'
            ";
    return query($query);
}


function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm = mysqli_real_escape_string($conn, $data["confirm"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'" );

    if( mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar');
            </script>";
        return false;
    }

    // cek konfirmasi
    if( $password !== $confirm ) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO users VALUES(NULL, '$username', '$password')");

    return mysqli_affected_rows($conn);
}

?>