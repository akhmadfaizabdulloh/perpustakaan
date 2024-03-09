<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require '../../backend/functions.php';
$buku = query("SELECT * FROM buku");
$member = query("SELECT * FROM member");

// Query untuk menghitung jumlah buku
$sql = "SELECT COUNT(*) as total FROM buku";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalBuku = $row["total"];

// Query untuk menghitung jumlah member
$sql = "SELECT COUNT(*) as total FROM member";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalMember = $row["total"];

$pesan = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page - Dashboard</title>
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
             <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white bg-white group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                   <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                   <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3 text-black">Dashboard</span>
             </a>
          </li>
          <li>
             <a href="daftar-buku.php" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-500 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                   <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Daftar Buku</span>
             </a>
          </li>
          <li>
             <a href="member.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                   <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Member</span>
                <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
             </a>
          </li>
          <li>
            <a href="tambah-buku.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z"/>
                  <path d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z"/>
                  <path d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Tambah Buku</span>
            </a>
         </li>
         <li>
            <a href="tambah-member.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
               <path d="M8 4.5C8 5.16304 7.73661 5.79893 7.26777 6.26777C6.79893 6.73661 6.16304 7 5.5 7C4.83696 7 4.20107 6.73661 3.73223 6.26777C3.26339 5.79893 3 5.16304 3 4.5C3 3.83696 3.26339 3.20107 3.73223 2.73223C4.20107 2.26339 4.83696 2 5.5 2C6.16304 2 6.79893 2.26339 7.26777 2.73223C7.73661 3.20107 8 3.83696 8 4.5ZM11.5 6C10.9656 5.9996 10.434 6.07708 9.922 6.23C9.69175 5.93456 9.54909 5.58039 9.51027 5.20784C9.47145 4.83528 9.53804 4.45931 9.70244 4.12275C9.86684 3.78619 10.1225 3.50255 10.4402 3.30416C10.7579 3.10576 11.1249 3.00057 11.4995 3.00057C11.8741 3.00057 12.2411 3.10576 12.5588 3.30416C12.8765 3.50255 13.1322 3.78619 13.2966 4.12275C13.461 4.45931 13.5275 4.83528 13.4887 5.20784C13.4499 5.58039 13.3073 5.93456 13.077 6.23C12.5653 6.07718 12.034 5.9997 11.5 6ZM3 8H7.257C6.44269 8.9844 5.99806 10.2225 6 11.5C6 11.834 6.03 12.16 6.087 12.477C5.89172 12.4925 5.6959 12.5002 5.5 12.5C1.5 12.5 1.5 9.575 1.5 9.575V9.5C1.5 9.10218 1.65804 8.72064 1.93934 8.43934C2.22064 8.15804 2.60218 8 3 8ZM16 11.5C16 12.6935 15.5259 13.8381 14.682 14.682C13.8381 15.5259 12.6935 16 11.5 16C10.3065 16 9.16193 15.5259 8.31802 14.682C7.47411 13.8381 7 12.6935 7 11.5C7 10.3065 7.47411 9.16193 8.31802 8.31802C9.16193 7.47411 10.3065 7 11.5 7C12.6935 7 13.8381 7.47411 14.682 8.31802C15.5259 9.16193 16 10.3065 16 11.5ZM12 9.5C12 9.36739 11.9473 9.24021 11.8536 9.14645C11.7598 9.05268 11.6326 9 11.5 9C11.3674 9 11.2402 9.05268 11.1464 9.14645C11.0527 9.24021 11 9.36739 11 9.5V11H9.5C9.36739 11 9.24021 11.0527 9.14645 11.1464C9.05268 11.2402 9 11.3674 9 11.5C9 11.6326 9.05268 11.7598 9.14645 11.8536C9.24021 11.9473 9.36739 12 9.5 12H11V13.5C11 13.6326 11.0527 13.7598 11.1464 13.8536C11.2402 13.9473 11.3674 14 11.5 14C11.6326 14 11.7598 13.9473 11.8536 13.8536C11.9473 13.7598 12 13.6326 12 13.5V12H13.5C13.6326 12 13.7598 11.9473 13.8536 11.8536C13.9473 11.7598 14 11.6326 14 11.5C14 11.3674 13.9473 11.2402 13.8536 11.1464C13.7598 11.0527 13.6326 11 13.5 11H12V9.5Z"/>
            </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Tambah Member</span>
            </a>
         </li>
         <li>
             <a href="peminjaman.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                   <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Peminjaman</span>
                <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
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

   <div class="px-2 mb-4 block py-4">
      <p class="text-lg font-medium text-black">Dashboard</p>
   </div>

   <!-- Count Section Start -->

        <div class="flex flex-col sm:flex-row justify-between show-on-scroll">

          <div class="flex flex-col items-center w-full mb-10">
            <p class="font-bold text-4xl lg:text-5xl mt-5"><?= $totalBuku; ?></p>
            <p class="text-base mt-1">Total Buku</p>
          </div>
  
          <div class="flex flex-col items-center w-full mb-10">
            <p class="font-bold text-4xl lg:text-5xl mt-5"><?= $totalMember; ?></p>
            <p class="text-base mt-1">Total Member</p>
          </div>
          
          <div class="flex flex-col items-center w-full mb-10">
            <p class="font-bold text-4xl lg:text-5xl mt-5">-</p>
            <p class="text-base mt-1">Peminjaman</p>
          </div>
  
          <div class="flex flex-col items-center w-full mb-10">
            <p class="font-bold text-4xl lg:text-5xl mt-5">-</p>
            <p class="text-base mt-1">Terlambat</p>
          </div>
          
        </div>
    <!-- Count Section End -->

    <div class="px-2  block py-4">
      <p class="mb-4 text-lg font-medium text-black">Daftar Buku</p>
   </div>

   <div id="table-daftar-buku" class="relative overflow-x-auto">
       <table class="w-full text-sm text-left rtl:text-righ">
           <thead class="text-xs text-gray-700 uppercase bg-gray-50">
               <tr>
                   <th scope="col" class="px-6 py-3">
                       No.
                   </th>
                   <th scope="col" class="px-6 py-3">
                       Judul Buku
                   </th>
                   <th scope="col" class="px-6 py-3">
                       Penulis
                   </th>
                   <th scope="col" class="px-6 py-3">
                       Kode rak buku
                   </th>
                   <th scope="col" class="px-6 py-3">
                       Ketersediaan
                   </th>
                   <th scope="col" class="px-6 py-3">
                     Aksi
                 </th>
               </tr>
           </thead>

           <tbody>
            
           <?php
            if ($totalBuku == 0) {
               $pesan = '
               <div class="flex justify-center items-center">
               <img src="../asset/data-kosong.png" style="width: 11rem;margin-top: 7rem;" alt="Data kosong">
               </div>
               <p class="mt-2 font-medium text-black text-center" style="margin-bottom: 7rem;">Data kosong</p>';
            } else {
            ?>
            
            <?php $i = 1; ?>
            <?php foreach ($buku as $row) :   
               $status = $row["ketersediaan"];

               if ($status === "1") {
                   $status_buku = '<button class="px-4 py-2 bg-green-500 rounded-full">Tersedia</button>';
               } elseif ($status === "2") {
                  $status_buku = '<button class="px-4 py-2 bg-yellow-400 rounded-full">Sedang Dipinjam</button>';
               } else {
                   $status_buku = '<button class="px-4 py-2 bg-red-500 rounded-full">Tidak Tersedia</button>';
               }?>
               
            

               <tr class="bg-white border-b">
                   <td class="px-6 py-4">
                     <?= $i ?>
                   </td>
                   <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                     <?= $row["judul"]; ?>
                   </th>
                   <td class="px-6 py-4">
                     <?= $row["penulis"]; ?>
                   </td>
                   <td class="px-6 py-4">
                     <?= $row["rak_buku"]; ?>
                   </td>
                   <td class="px-6 py-4">
                     <?= $status_buku ?>
                   </td>
                   <td class="px-6 py-4">
                     <div class="flex gap-x-4">
                        <a href="detail-buku.php?id=<?= $row["id"]; ?>">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1.48446 9.30824C1.39438 9.19698 1.31288 9.09368 1.24039 9C1.31288 8.90632 1.39438 8.80302 1.48446 8.69175C1.91801 8.15628 2.54388 7.44437 3.31349 6.73557C4.88844 5.28506 6.89993 4 9 4C11.1001 4 13.1116 5.28506 14.6865 6.73557C15.4561 7.44437 16.082 8.15628 16.5155 8.69175C16.6056 8.80302 16.6871 8.90632 16.7596 9C16.6871 9.09368 16.6056 9.19698 16.5155 9.30824C16.082 9.84372 15.4561 10.5556 14.6865 11.2644C13.1116 12.7149 11.1001 14 9 14C6.89993 14 4.88844 12.7149 3.31349 11.2644C2.54388 10.5556 1.91801 9.84372 1.48446 9.30824Z" stroke="#333434" stroke-width="2"/>
                              <path d="M11.75 9C11.75 10.5188 10.5188 11.75 9 11.75C7.48122 11.75 6.25 10.5188 6.25 9C6.25 7.48122 7.48122 6.25 9 6.25C10.5188 6.25 11.75 7.48122 11.75 9Z" stroke="#333434" stroke-width="2"/>
                              </svg>
                        </a>
                        <a href="edit-buku.php?id=<?= $row["id"]; ?>">
                           <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip0_738_5210)">
                              <path d="M16.6224 6.43694L15.4007 4.88445C15.2525 4.69649 15.0358 4.57508 14.7981 4.54691C14.5604 4.51875 14.3213 4.58613 14.1333 4.73425L13.1589 5.50106L15.4978 8.46954L16.4714 7.70349C16.863 7.39459 16.9308 6.82837 16.6224 6.43694ZM4.74879 12.124L7.08656 15.0927L14.7897 9.02703L12.4511 6.05762L4.74816 12.1243L4.74879 12.124ZM3.42938 14.3642L2.72841 16.1187L4.5989 15.8482L6.33607 15.5983L4.08023 12.7324L3.42938 14.3642Z" fill="#333434"/>
                              </g>
                              <defs>
                              <clipPath id="clip0_738_5210">
                              <rect width="15.8164" height="15.8164" fill="white" transform="translate(5.31833 0.893555) rotate(19.6488)"/>
                              </clipPath>
                              </defs>
                              </svg>                           
                        </a>
                        <a href="hapus-buku.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?');">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M7.4 1C6.07452 1 5 2.07452 5 3.4H2.6H1.8C1.35817 3.4 1 3.75817 1 4.2C1 4.64183 1.35817 5 1.8 5H2.6V14.6C2.6 15.9255 3.67452 17 5 17H13C14.3255 17 15.4 15.9255 15.4 14.6V5H16.2C16.6418 5 17 4.64183 17 4.2C17 3.75817 16.6418 3.4 16.2 3.4H15.4H13C13 2.07452 11.9255 1 10.6 1H7.4ZM11.4 3.4C11.4 2.95817 11.0418 2.6 10.6 2.6H7.4C6.95817 2.6 6.6 2.95817 6.6 3.4H11.4ZM5 5H4.2V14.6C4.2 15.0418 4.55817 15.4 5 15.4H13C13.4418 15.4 13.8 15.0418 13.8 14.6V5H13H5Z" fill="#333434" stroke="#333434"/>
                              </svg>                           
                        </a>
                     </div>                     
                   </td>    
               </tr>

            <?php $i++; ?>
            <?php endforeach; ?>

            <?php } ?>


           </tbody>
       </table>

       <?= $pesan ?>

    </div>

    <div class="px-2 block py-4 mt-8">
      <p class="mb-4 text-lg font-medium text-black">Data Member</p>
    </div>

   <div class="relative overflow-x-auto">
      <table class="w-full text-sm text-left rtl:text-righ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
              <tr>
                  <th scope="col" class="px-6 py-3">
                      No.
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Nama
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Alamat
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Gender
                  </th>
                  <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
              </tr>
          </thead>

          <tbody>
            
            <?php
            if ($totalMember == 0) {
               $pesan = '
               <div class="flex justify-center items-center">
               <img src="../asset/data-kosong.png" style="width: 11rem;margin-top: 7rem;" alt="Data kosong">
               </div>
               <p class="mt-2 font-medium text-black text-center" style="margin-bottom: 7rem;">Data kosong</p>';
            } else {
            ?>

            <?php $i = 1; ?>
            <?php foreach ($member as $row) :   
               $gender = $row["jenis_kelamin"];

               if ($gender === "1") {
                   $jenis_kelamin = '<button class="px-4 py-2 bg-green-500 rounded-full">Laki - Laki</button>';
               } else {
                   $jenis_kelamin = '<button class="px-4 py-2 bg-yellow-400 rounded-full">Perempuan</button>';
               }?>


              <tr class="bg-white border-b">
                   <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                     <?= $i ?>
                   </th>
                   <td class="px-6 py-4">
                     <?= $row["nama_lengkap"]; ?>
                   </td>
                   <td class="px-6 py-4">
                     <?= $row["alamat_lengkap"]; ?>
                   </td>
                   <td class="px-6 py-4">
                     <?= $row["no_telepon"]; ?>
                   </td>
                   <td class="px-6 py-4">
                     <?= $jenis_kelamin; ?>
                   </td>
                   <td class="px-6 py-4">
                     <div class="flex gap-x-4">
                        <a href="#">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1.48446 9.30824C1.39438 9.19698 1.31288 9.09368 1.24039 9C1.31288 8.90632 1.39438 8.80302 1.48446 8.69175C1.91801 8.15628 2.54388 7.44437 3.31349 6.73557C4.88844 5.28506 6.89993 4 9 4C11.1001 4 13.1116 5.28506 14.6865 6.73557C15.4561 7.44437 16.082 8.15628 16.5155 8.69175C16.6056 8.80302 16.6871 8.90632 16.7596 9C16.6871 9.09368 16.6056 9.19698 16.5155 9.30824C16.082 9.84372 15.4561 10.5556 14.6865 11.2644C13.1116 12.7149 11.1001 14 9 14C6.89993 14 4.88844 12.7149 3.31349 11.2644C2.54388 10.5556 1.91801 9.84372 1.48446 9.30824Z" stroke="#333434" stroke-width="2"/>
                              <path d="M11.75 9C11.75 10.5188 10.5188 11.75 9 11.75C7.48122 11.75 6.25 10.5188 6.25 9C6.25 7.48122 7.48122 6.25 9 6.25C10.5188 6.25 11.75 7.48122 11.75 9Z" stroke="#333434" stroke-width="2"/>
                              </svg>
                        </a>
                        <a href="#">
                           <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <g clip-path="url(#clip0_738_5210)">
                              <path d="M16.6224 6.43694L15.4007 4.88445C15.2525 4.69649 15.0358 4.57508 14.7981 4.54691C14.5604 4.51875 14.3213 4.58613 14.1333 4.73425L13.1589 5.50106L15.4978 8.46954L16.4714 7.70349C16.863 7.39459 16.9308 6.82837 16.6224 6.43694ZM4.74879 12.124L7.08656 15.0927L14.7897 9.02703L12.4511 6.05762L4.74816 12.1243L4.74879 12.124ZM3.42938 14.3642L2.72841 16.1187L4.5989 15.8482L6.33607 15.5983L4.08023 12.7324L3.42938 14.3642Z" fill="#333434"/>
                              </g>
                              <defs>
                              <clipPath id="clip0_738_5210">
                              <rect width="15.8164" height="15.8164" fill="white" transform="translate(5.31833 0.893555) rotate(19.6488)"/>
                              </clipPath>
                              </defs>
                              </svg>                           
                        </a>
                        <a href="#" onclick="return confirm('Apakah anda yakin akan menghapus data ini?');">
                           <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M7.4 1C6.07452 1 5 2.07452 5 3.4H2.6H1.8C1.35817 3.4 1 3.75817 1 4.2C1 4.64183 1.35817 5 1.8 5H2.6V14.6C2.6 15.9255 3.67452 17 5 17H13C14.3255 17 15.4 15.9255 15.4 14.6V5H16.2C16.6418 5 17 4.64183 17 4.2C17 3.75817 16.6418 3.4 16.2 3.4H15.4H13C13 2.07452 11.9255 1 10.6 1H7.4ZM11.4 3.4C11.4 2.95817 11.0418 2.6 10.6 2.6H7.4C6.95817 2.6 6.6 2.95817 6.6 3.4H11.4ZM5 5H4.2V14.6C4.2 15.0418 4.55817 15.4 5 15.4H13C13.4418 15.4 13.8 15.0418 13.8 14.6V5H13H5Z" fill="#333434" stroke="#333434"/>
                              </svg>                           
                        </a>
                     </div>                     
                   </td>  
               </tr>


            <?php $i++; ?>
            <?php endforeach; ?>

            <?php } ?>

          </tbody>
      </table>

      <?= $pesan ?>

   </div>

 </div>
 

<script src="../js/script.js"></script>

</body>
</html>