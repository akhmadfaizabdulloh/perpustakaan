<?php

session_start();
require '../../backend/functions.php';


// cek cookie terlebih dahulu sebelum cek session
// if ( isset($_COOKIE['login']) ) {
//     if ($_COOKIE['login'] == 'true') {
//         $_SESSION['login'] = true;
//     }
// }


// cek cookie dengan id dan username
if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query( $conn, "SELECT username FROM user WHERE id = $id" );
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if( $key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }

}


// cek session dahulu
if ( isset($_SESSION["login"]) ) {
    header("Location: dashboard.php");
    exit;   
}



if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if ( password_verify($password, $row["password"]) ) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if ( isset($_POST['remember']) ) {
                // buat cookie
                // setcookie('login', 'true', time()+60);

                setcookie('id', $row['id'], time()+60);
                // name id sebagai contoh saja, lebih aman gunakan nama lain/samarkan saja

                // bikin cookie ke-2
                setcookie( 'key', hash('sha256', $row['username']), time()+60 );

                // https://www.php.net/manual/en/function.hash.php
            }

            header("Location: dashboard.php");
            exit;
        }
    }

    $error = true;

}

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
    
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Perpuskita</h2>
  </div>

  <?php if( isset($error) ) : ?>
        <p style="color: red; font-style: italic;">username / password salah!</p>
        <?php endif; ?>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form class="space-y-6" action="" method="POST">
      <div>
        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
        <div class="mt-2">
          <input id="username" name="username" type="username" autocomplete="email" required class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <div class="flex items-center justify-between">
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
          <div class="text-sm">
            <a href="#" class="font-base text-black">Forgot password?</a>
          </div>
        </div>
        <div class="mt-2">
          <input id="password" name="password" type="password" autocomplete="current-password" required class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me</label>

        <button type="submit" name="login" class="mt-2 flex w-full justify-center rounded-md bg-green-400 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2">Sign in</button>
      </div>
    </form>
  </div>
</div>


      <!-- End Login -->
    
  </body>
</html>