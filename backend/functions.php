<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "root", "perpuskita");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
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



function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM buku WHERE id = $id");

    return mysqli_affected_rows($conn);
}




?>