<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require '../../backend/functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {

    // debugging (melihat isi dari $_POST)
    // var_dump($_POST);
    // var_dump($_FILES);
    // // die; agar program setelahnya tidak di jalankan
    // die; 


    // cek apakah data berhasil di tambahkan atau tidak
    if( tambah($_POST) > 0 ) {
        echo "
            <script>
            alert('data berhasil ditambahkan!');
            document.location.href = 'daftar-buku.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('data gagal ditambahkan!');
            document.location.href = 'daftar-buku.php';
            </script>
        ";
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page - Tambah Buku</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

  <button id="hamburger" data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none hover:ring-2 focus:ring-2 focus:ring-green-400 hover:ring-green-400 focus:bg-green-400">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
    </svg>
 </button>
 
 <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-green-400 ">
      <div class="px-2 mb-4">
         <p class="font-bold text-lg text-black block py-4">Perpuskita</p>
       </div>
       <ul class="space-y-2 font-medium">
          <li>
             <a href="dashboard.php" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                   <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                   <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Dashboard</span>
             </a>
          </li>
          <li>
             <a href="daftar-buku.php" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                   <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                </svg>
                <span class="flex-1 ms-3">Daftar Buku</span>
             </a>
          </li>
          <li>
             <a href="member.php" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                   <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <span class="flex-1 ms-3">Member</span>
                <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
             </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 rounded-lg text-white bg-white group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                  <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                  <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
               </svg>
               <span class="flex-1 ms-3 text-black">Tambah Buku</span>
            </a>
         </li>
          <li>
             <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                   <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Inbox</span>
                <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
             </a>
          </li>
          <li>
             <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                   <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
             </a>
          </li>
          <li>
             <a href="logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
             </a>
          </li>
       </ul>
    </div>
 </aside>
 
 <div class="p-4 sm:ml-64">

    <div class="px-2  block py-4">
      <p class="mb-4 text-lg font-medium text-black">Tambah Buku</p>
   </div>

   <div class="w-full px-4 self-start lg:pl-4">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 mb-5 md:px-2">
                <label for="judul" class="text-base font-bold text-black">Judul Buku</label>
                <input type="text" name="judul" id="judul" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="Senja, Hujan, & Cerita yang telah usai" required>
            </div>
            <div class="w-full md:w-1/2 mb-5 md:px-2">
                <label for="penulis" class="text-base font-bold text-black">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="Boy Candra" required>
            </div>
            <div class="w-full md:w-1/2 mb-5 md:px-2">
              <label for="rak_buku" class="text-base font-bold text-black">Kode Rak Buku</label>
              <input type="text" name="rak_buku" id="rak_buku" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="E-024" required>
          </div>
          <div class="w-full md:w-1/2 mb-5 md:px-2">
              <label for="halaman" class="text-base font-bold text-black">Jumlah Halaman</label>
              <input type="number" name="halaman"  id="halaman" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="239" required>
          </div>
          <div class="w-full md:w-1/2 mb-5 md:px-2">
            <label for="penerbit" class="text-base font-bold text-black">Penerbit</label>
            <input type="text" name="penerbit"  id="penerbit" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="Gramedia" required>
         </div>
         <div class="w-full md:w-1/2 mb-5 md:px-2">
            <label for="tahun_terbit" class="text-base font-bold text-black">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" id="tahun_terbit" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="2017" required>
        </div>
        <div class="w-full md:w-1/2 mb-5 md:px-2">
         <label for="isbn" class="text-base font-bold text-black">ISBN</label>
         <input type="text" name="isbn"  id="isbn" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="979-794-499-9" required>
        </div>
        <div class="w-full md:w-1/2 mb-5 md:px-2">
         <label for="gambar" class="text-base font-bold text-black">Cover Buku</label>
         <input type="file" name="gambar" id="gambar" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" required>
     </div>
     
          <div class="w-full mb-5 md:px-2">
            <label for="kategori" class="text-base font-bold text-black">Kategori</label>
            <select name="kategori" id="kategori" class="w-full text-black bg-white border-white focus:outline-none focus:ring-black focus:ring-1 block p-3 mt-2" required>
              <option disabled selected>Pilih Salah Satu...</option>
              <option value="Fiksi">Fiksi</option>
              <option value="Non-Fiksi">Non-Fiksi</option>
              <option value="Referensi">Referensi</option>
              <option value="Pendidikan">Pendidikan</option>
            </select>
          </div>
          <div class="w-full mb-5 md:px-2">
            <label for="deskripsi" class="text-base font-bold text-black">Deskripsi</label>
            <textarea type="text" name="deskripsi" id="deskripsi" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black h-32 mt-2" placeholder="Deskripsi Buku" required></textarea>
          </div>
          <div class="w-full md:px-2 mb-32">
            <button type="submit" name="submit" id="submit" rel="noopener noreferrer" class="inline-flex items-center font-semibold text-black bg-green-400 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">Submit</button>
          </div>
        </div>   
    </form>
    </div>

 </div>
 

<script src="../js/script.js"></script>

</body>
</html>