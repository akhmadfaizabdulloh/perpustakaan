<?php

session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require '../../backend/functions.php';

if( isset($_POST["submit"]) ) {

   $username = $_POST["username"];
   $password = $_POST["password"];
   $konfirmasi_password = $_POST["konfirmasi_password"];

   $result = mysqli_query($conn, "SELECT * FROM member WHERE username = '$username'");

   if (isset($_POST["jenis_kelamin"])) {
      // Data "jenis_kelamin" ada, lanjutkan dengan pemrosesan
      $jenis_kelamin = $_POST["jenis_kelamin"];
      
      // Lakukan operasi atau proses yang diinginkan dengan data "jenis_kelamin" di sini
      // cek username
      if( mysqli_num_rows($result) !== 1 ) {
   
         // $error = false;
         if( $password === $konfirmasi_password ) {
   
            // $password_error = false;
            if( tambah_member($_POST) > 0 ) {
               echo "
                  <script>
                  alert('data berhasil ditambahkan!');
                  document.location.href = 'member.php';
                  </script>
               ";
            } else {
                  
                  // echo mysqli_error($conn);
                  echo "
                     <script>
                     alert('data gagal ditambahkan!');
                     document.location.href = 'tambah-member.php';
                     </script>
                  ";
            }
   
         }
      
         $password_error = true;
   
      }
   
      $error = true;

  } else {
      // Jika data "jenis_kelamin" tidak dikirimkan, tampilkan pesan kesalahan
      // echo "Error: Data 'jenis_kelamin' tidak dikirimkan.";
      echo "
           <script>
           alert('pilih jenis kelamin terlebih dahulu!');
           document.location.href = 'tambah-member.php';
           </script>
       ";
       $gender_error = true;
   }
   
}

// cek apakah tombol submit sudah ditekan atau belum
// if( isset($_POST["submit"]) ) {
//    if( tambah_member($_POST) > 0 ) {
//        echo "
//            <script>
//            alert('data berhasil ditambahkan!');
//            document.location.href = 'member.php';
//            </script>
//        ";
//    } else {
//        echo "
//            <script>
//            alert('data gagal ditambahkan!');
//            document.location.href = 'tambah-member.php';
//            </script>
//        ";
//    }
   
// }


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
            <a href="tambah-member.php" class="flex items-center p-2 rounded-lg text-white bg-white group">
            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
               <path d="M8 4.5C8 5.16304 7.73661 5.79893 7.26777 6.26777C6.79893 6.73661 6.16304 7 5.5 7C4.83696 7 4.20107 6.73661 3.73223 6.26777C3.26339 5.79893 3 5.16304 3 4.5C3 3.83696 3.26339 3.20107 3.73223 2.73223C4.20107 2.26339 4.83696 2 5.5 2C6.16304 2 6.79893 2.26339 7.26777 2.73223C7.73661 3.20107 8 3.83696 8 4.5ZM11.5 6C10.9656 5.9996 10.434 6.07708 9.922 6.23C9.69175 5.93456 9.54909 5.58039 9.51027 5.20784C9.47145 4.83528 9.53804 4.45931 9.70244 4.12275C9.86684 3.78619 10.1225 3.50255 10.4402 3.30416C10.7579 3.10576 11.1249 3.00057 11.4995 3.00057C11.8741 3.00057 12.2411 3.10576 12.5588 3.30416C12.8765 3.50255 13.1322 3.78619 13.2966 4.12275C13.461 4.45931 13.5275 4.83528 13.4887 5.20784C13.4499 5.58039 13.3073 5.93456 13.077 6.23C12.5653 6.07718 12.034 5.9997 11.5 6ZM3 8H7.257C6.44269 8.9844 5.99806 10.2225 6 11.5C6 11.834 6.03 12.16 6.087 12.477C5.89172 12.4925 5.6959 12.5002 5.5 12.5C1.5 12.5 1.5 9.575 1.5 9.575V9.5C1.5 9.10218 1.65804 8.72064 1.93934 8.43934C2.22064 8.15804 2.60218 8 3 8ZM16 11.5C16 12.6935 15.5259 13.8381 14.682 14.682C13.8381 15.5259 12.6935 16 11.5 16C10.3065 16 9.16193 15.5259 8.31802 14.682C7.47411 13.8381 7 12.6935 7 11.5C7 10.3065 7.47411 9.16193 8.31802 8.31802C9.16193 7.47411 10.3065 7 11.5 7C12.6935 7 13.8381 7.47411 14.682 8.31802C15.5259 9.16193 16 10.3065 16 11.5ZM12 9.5C12 9.36739 11.9473 9.24021 11.8536 9.14645C11.7598 9.05268 11.6326 9 11.5 9C11.3674 9 11.2402 9.05268 11.1464 9.14645C11.0527 9.24021 11 9.36739 11 9.5V11H9.5C9.36739 11 9.24021 11.0527 9.14645 11.1464C9.05268 11.2402 9 11.3674 9 11.5C9 11.6326 9.05268 11.7598 9.14645 11.8536C9.24021 11.9473 9.36739 12 9.5 12H11V13.5C11 13.6326 11.0527 13.7598 11.1464 13.8536C11.2402 13.9473 11.3674 14 11.5 14C11.6326 14 11.7598 13.9473 11.8536 13.8536C11.9473 13.7598 12 13.6326 12 13.5V12H13.5C13.6326 12 13.7598 11.9473 13.8536 11.8536C13.9473 11.7598 14 11.6326 14 11.5C14 11.3674 13.9473 11.2402 13.8536 11.1464C13.7598 11.0527 13.6326 11 13.5 11H12V9.5Z"/>
            </svg>
               <span class="flex-1 ms-3 text-black">Tambah Member</span>
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
      <p class="mb-4 text-lg font-medium text-black">Tambah Member</p>
   </div>

   <div class="w-full px-4 self-start lg:pl-4">

      <form action="" method="post">

        <div class="flex flex-wrap">
            <div class="w-full md:w-1/2 mb-5 md:px-2">
                <label for="nama_lengkap" class="text-base font-bold text-black">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="Roronoa Zoro" required>
            </div>
            <div class="w-full md:w-1/2 mb-5 md:px-2">
               <label for="email" class="text-base font-bold text-black">Email</label>
               <input type="email" name="email" id="email" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="roronoazoro@gmail.com" required>
            </div>
            <div class="w-full md:w-1/2 mb-5 md:px-2">
                <label for="username" class="text-base font-bold text-black">Username</label>
                <input type="text" name="username" id="username" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="roronoa.zoro" required>


               <?php if( isset($error) ) : ?>
                  <p style="color: red; font-style: italic;">*username sudah terdaftar</p>
               <?php endif; ?>


            </div>
            <div class="w-full md:w-1/2 mb-5 md:px-2">
               <label for="no_telepon" class="text-base font-bold text-black">No. Telepon</label>
               <input type="number" name="no_telepon" id="no_telepon" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="082712675115" required>
           </div>
            <div class="w-full md:w-1/2 mb-5 md:px-2">
              <label for="password" class="text-base font-bold text-black">Password</label>
              <input type="password" name="password" id="password" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="Password Member" required>
          </div>
          <div class="w-full md:w-1/2 mb-5 md:px-2">
              <label for="konfirmasi_password" class="text-base font-bold text-black">Konfirmasi Password</label>
              <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black mt-2" placeholder="Konfirmasi Password">
              
              
            <?php if( isset($password_error) ) : ?>
               <p style="color: red; font-style: italic;">*konfirmasi password tidak sesuai</p>
            <?php endif; ?>


          </div>
          <div class="w-full md:w-1/2 mb-5 md:px-2">
            <label for="jenis_kelamin" class="text-base font-bold text-black">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="w-full text-black bg-white border-white focus:outline-none focus:ring-black focus:ring-1 block p-3 mt-2" required>
              <option disabled selected>Pilih Salah Satu...</option>
              <option value="1">Laki - Laki</option>
              <option value="2">Perempuan</option>
            </select>

            <?php if( isset($gender_error) ) : ?>
               <p style="color: red; font-style: italic;">*Pilih Salah Satu...</p>
            <?php endif; ?>

          </div>
          <div class="ww-full md:w-1/2 mb-5 md:px-2">
            <label for="alamat_lengkap" class="text-base font-bold text-black">Alamat Lengkap</label>
            <textarea type="text" name="alamat_lengkap" id="alamat_lengkap" class="w-full text-black p-3 focus:outline-none focus:ring-black focus:ring-1 focus:border-black h-32 mt-2" placeholder="Jl. Samurai Pulau Langit Pasuruan" required></textarea>
          </div>
          <div class="w-full md:px-2 mb-32">
            <button name="submit" id="submit" rel="noopener noreferrer" class="inline-flex items-center font-semibold text-black bg-green-400 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">Submit</button>
          </div>
        </div>   
    </form>
    </div>

 </div>
 

<script src="../js/script.js"></script>

</body>
</html>