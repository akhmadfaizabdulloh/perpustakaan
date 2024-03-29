<?php

require '../backend/functions.php';
$id = $_GET["id"];
$buku = query("SELECT * FROM buku WHERE id = $id")[0];

$status = $buku["ketersediaan"];

if ($status === "1") {
   $status_buku = '<p class="font-medium text-sm lg:text-base text-green-700 mb-2 lg:mb-4">Tersedia</p>';
} elseif ($status === "2") {
   $status_buku = '<p class="font-medium text-sm lg:text-base text-yellow-500 mb-2 lg:mb-4">Sedang Dipinjam</p>';
} else {
   $status_buku = '<p class="font-medium text-sm lg:text-base text-red-700 mb-2 lg:mb-4">Tidak Tersedia</p>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - <?= $buku["judul"]; ?></title>
    <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Header Start -->
    <header class="bg-white absolute top-0 w-full flex items-center z-10">
        <div class="container lg:px-16">
          <div class="flex items-center justify-between relative">
            <!-- justify-between : mepet kanan kiri -->
            <div class="px-4">
              <a href="home.php" class="font-bold text-lg text-black block py-6"
                >Perpuskita</a
              >
            </div>
  
            <div class="flex items-center px-4">
              <button
                id="hamburger"
                name="hamburger"
                type="button"
                class="block absolute right-4 lg:hidden"
              >
                <span
                  class="hamburger-line transition duration-300 ease-in-out origin-top-left"
                ></span>
                <span
                  class="hamburger-line transition duration-300 ease-in-out"
                ></span>
                <span
                  class="hamburger-line transition duration-300 ease-in-out origin-bottom-left"
                ></span>
              </button>
  
              <nav
                id="nav-menu"
                class="hidden absolute py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none"
              >
                <ul class="block lg:flex">
                  <li class="group">
                    <a
                      href="./admin/dashboard.php"
                      class="text-base text-dark py-2 mx-8 flex"
                      >Dashboard</a
                    >
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </header>
      <!-- Header End -->
      
    <!-- Detail Section Start -->
    <section id="home" class="bg-green-400">
        <!-- <div class="container lg:px-24"> -->
          <div class="flex flex-wrap justify-center">

            <div class="px-4 pt-32 lg:pt-40 items-center lg:w-1/2">
                  <div class="w-40 lg:w-64 mx-auto bg-white rounded-xl shadow-lg overflow-hidden mb-5 lg:mb-10">
                      <img src="./img/<?= $buku["gambar"]; ?>" alt="Sampul Buku" class="w-full py-2 px-2 lg:py-4 lg:px-4">
                  </div>
              </div>
              <div class="w-full lg:pt-32 lg:pb-32 px-6 lg:px-8 self-start lg:w-1/2 bg-white">
                <div class="lg:pb-40">
                  <h3 href="#" class="block mt-6 lg:mt-9 mb-0 lg:mb-2 font-semibold text-base lg:text-xl text-dark"><?= $buku["judul"]; ?></h3>
                <p class="font-medium text-sm lg:text-base text-secondary mb-2 lg:mb-4"><?= $buku["penulis"]; ?></p>
                <h3 href="#" class="block mb-0 lg:mb-2 font-semibold text-base lg:text-xl text-dark hover:opacity-80"><?= $buku["rak_buku"]; ?></h3>

                <?= $status_buku ?>
                
                <div class="table w-full lg:w-1/2 text-md font-medium text-neutral-900 mb-6 ">
                  <div class="table-row-group">
                    <div class="table-row">
                      <div class="table-cell">Jumlah Halaman</div>
                      <div class="table-cell">:&emsp;&emsp;<?= $buku["halaman"]; ?> Halaman</div>
                    </div>
                    <div class="table-row">
                      <div class="table-cell">Penerbit</div>
                      <div class="table-cell">:&emsp;&emsp;<?= $buku["penerbit"]; ?></div>
                    </div>
                      
                    <div class="table-row">
                      <div class="table-cell">Tahun Terbit</div>
                      <div class="table-cell">:&emsp;&emsp;<?= $buku["tahun_terbit"]; ?></div>
                    </div>
          
                    <div class="table-row">
                      <div class="table-cell">ISBN</div>
                      <div class="table-cell">:&emsp;&emsp;<?= $buku["isbn"]; ?></div>
                    </div>
                      
                    <div class="table-row">
                     <div class="table-cell">Kategori</div>
                     <div class="table-cell">:&emsp;&emsp;<?= $buku["kategori"]; ?></div>
                    </div>
                  </div>

                </div>
                <p class="font-medium text-sm lg:text-base text-secondary mb-6"><?= $buku["deskripsi"]; ?></p>

                </div>
                
              
              </div>


          </div>
        </div>
      </section>
      <!-- Detail Section End -->

</body>
</html>