<?php

require '../backend/functions.php';
$buku = query("SELECT * FROM buku");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpuskita - Home</title>
    <link href="./css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Header Start -->
    <header class="bg-white absolute top-0 w-full flex items-center z-10">
        <div class="container lg:px-16">
          <div class="flex items-center justify-between relative">
            <!-- justify-between : mepet kanan kiri -->
            <div class="px-4">
              <a href="#home" class="font-bold text-lg text-black block py-6"
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
                      href="#blog"
                      class="text-base text-dark py-2 mx-8 flex group-hover:text-primary"
                      >Blog</a
                    >
                  </li>
                  <li class="group">
                    <a
                      href="#contact"
                      class="text-base text-dark py-2 mx-8 flex group-hover:text-primary"
                      >Contact</a
                    >
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </header>
      <!-- Header End -->
      
    <!-- Home Section Start -->
    <section id="home" class="pt-32 pb-32 bg-green-400">
        <div class="container lg:px-24">
          <div class="flex flex-wrap justify-start">

          <?php $i = 1; ?>
          <?php foreach ($buku as $row) : ?>

              <div class="px-2 lg:px-4 w-1/2 lg:w-1/4">
                  <div class="w-40 lg:w-64 bg-white rounded-xl shadow-lg overflow-hidden mb-5 lg:mb-10">

                  

                      <img src="./img/<?= $row["gambar"]; ?>" alt="Sampul Buku" class="w-full py-2 px-2 lg:py-4 lg:px-4">
                      <div class="py-0 px-2 lg:px-4">
                          <h3>
                              <a href="detail-buku.php?id=<?= $row["id"]; ?>" class="block mb-0 lg:mb-2 font-semibold text-base lg:text-xl text-dark hover:opacity-80"><?= $row["judul"]; ?></a>
                          </h3>
                          <p class="font-medium text-sm lg:text-base text-secondary mb-2 lg:mb-4"><?= $row["penulis"]; ?></p>
                      </div>
                  </div>
              </div>

              <?php $i++; ?>
              <?php endforeach; ?>

          </div>
        </div>
      </section>
      <!-- Home Section End -->
</body>
</html>