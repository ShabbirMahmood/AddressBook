<?php
//   //If user is not logged in, can not access this page
session_start();
//   if (!isset($_SESSION['name'])) {
//     $_SESSION['msg'] = "You must log in first";
//     header('location: login.php');
//     }

//    if (isset($_GET['logout'])) {
//     session_destroy();
//     unset($_SESSION['name']);
//     header("location: index.html");
//     }
// Database Connection
$db = mysqli_connect('localhost', 'root', '', 'address_book_db');

if (isset($_SESSION['name'])) {
    $username = $_SESSION['name']; //*********
    $password = $_SESSION['password'];
}

  //************ */

    if(isset($_POST['delete_contract'])) {

        $id = $_POST['delete_contract'];

        $query = "DELETE FROM contact_tb WHERE id= '$id'";
        $result = mysqli_query($db, $query);

        if ($result == 1) { // If the query selects only one row then log in
            header('location: view.php');
        }else {
            echo  "Fail!!!!!!";
        }

    }
?>