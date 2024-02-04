<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "root", "perpuskita");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    if (!$result) {
        httpNotFound();
    }
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function httpNotFound()
{
    http_response_code(404);
    header('Content-type: text/html');

    // Generate standard apache 404 error page
    echo <<<HTML
    <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
    <html><head>
    <title>404 Not Found</title>
    </head><body>
    <h1>Not Found</h1>
    <p>The requested URL was not found on this server.</p>
    </body></html>  
    HTML;

    exit;
}


function tambah($data) {
    global $conn;

    

    $judul = htmlspecialchars($data["judul"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $rak_buku = htmlspecialchars($data["rak_buku"]);
    $halaman = htmlspecialchars($data["halaman"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $isbn = htmlspecialchars($data["isbn"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    


    // upload gambar
    $gambar = upload();

    // if ( $gambar === false )
    if ( !$gambar ) {
        return false;
    }


    $query = "INSERT INTO buku
                VALUES
                (0, '$gambar','$judul','$penulis','$rak_buku','1','$halaman','$penerbit','$tahun_terbit','$isbn','$kategori','$deskripsi')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function upload() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    
    // cek apakah tidak ada gambar yang diupload
    if ( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        
        return false;
    }


    // cek apakah yang diupload adalah gambar
    $eksensiGambarValid = ['jpg', 'jpeg', 'png'];

    // explode(delimiter, string)
    $eksensiGambar = explode('.', $namaFile);
    // sandhika.jpg = ['sandhika', 'jpg']

    // jika kita pakai ini
    // $eksensiGambar = $eksensiGambar[1]
    // jika nama file-nya sandika.galih.jpg
    // maka yang di ambil "galih"

    $eksensiGambar = strtolower(end($eksensiGambar));
    // end() >>> untuk mengambil yang terakhir
    // srttolower >>> untuk mengatasi jika ada nama file "sandhika.JPG" agar di convert menjadi huruf kecil (jpg).

    if( !in_array($eksensiGambar, $eksensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // in_array(needle, haystack)
    // in_array(jarum, jerami)



    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 100000 ){
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }
    // 100.000 byte = 100 kb
    // 1.000.000 byte = 1 MB


    // lolos pengecekan, gambar siap diupload
    // generte nama gambar baru

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $eksensiGambar;

    // var_dump($namaFileBaru); die;


    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

    // move_uploaded_file(filename, destination)

    return $namaFileBaru;
    // untuk $gambar

}

function tambah_member($data) {
    global $conn;

    $nama_lengkap = htmlspecialchars($data["nama_lengkap"]);
    $email = htmlspecialchars($data["email"]);
    $username = strtolower( stripslashes($data["username"]) );
    $no_telepon = htmlspecialchars($data["no_telepon"]);
    $password = htmlspecialchars($data["password"]);
    
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $isbn = htmlspecialchars($data["isbn"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    // upload gambar
    $gambar = upload();

    // if ( $gambar === false )
    if ( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO buku
                VALUES
                (0, '$username','$password','$nama_lengkap','$email','$jenis_kelamin','$no_telepon','$alamat_lengkap','$foto_profil','$is_verified')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function upload_member() {
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $eksensiGambarValid = ['jpg', 'jpeg', 'png'];

    // explode(delimiter, string)
    $eksensiGambar = explode('.', $namaFile);

    $eksensiGambar = strtolower(end($eksensiGambar));

    if( !in_array($eksensiGambar, $eksensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 2000000 ){
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }
    // 100.000 byte = 100 kb
    // 1.000.000 byte = 1 MB

    // generte nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $eksensiGambar;

    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

    return $namaFileBaru;

}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM buku WHERE id = $id");

    return mysqli_affected_rows($conn);
}


function ubah($data){
    global $conn;

    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $rak_buku = htmlspecialchars($data["rak_buku"]);
    $halaman = htmlspecialchars($data["halaman"]);
    $ketersediaan = htmlspecialchars($data["ketersediaan"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $isbn = htmlspecialchars($data["isbn"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    // tidak perlu htmlspecialchars() karna tidak di input oleh user


    // cek apakah user pilih gambar baru atau tidak
    if ( $_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // $query = "INSERT INTO buku
    //             VALUES
    //             (0, '$gambar','$judul','$penulis','$rak_buku','1','$halaman','$penerbit','$tahun_terbit','$isbn','$kategori','$deskripsi')";


    $query = "UPDATE buku SET
                gambar = '$gambar',
                judul = '$judul',
                penulis = '$penulis',
                rak_buku = '$rak_buku',
                ketersediaan = '$ketersediaan',
                halaman = '$halaman',
                penerbit = '$penerbit',
                tahun_terbit = '$tahun_terbit',
                isbn = '$isbn',
                kategori = '$kategori',
                deskripsi = '$deskripsi'  
              WHERE id = $id
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

?>