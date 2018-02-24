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

$identified = mysqli_query($db,"SELECT id FROM user_tb WHERE name = '$username' AND password ='$password' ");
$row = mysqli_fetch_array($identified);
$user_id = $row['id']; //************ */

$query = "SELECT * FROM contact_tb where user_id = '$user_id'";
$result = mysqli_query($db, $query);  //************ */

if(isset($_POST['download_csv'])) {

    $filename = "Information.csv";
    $fp = fopen('php://output', 'w');

    $header = array(
        'Full Name',
        'Nick Name',
        'Birth Date',
        'Address',

        'Email',
        'Contact Number',

    );

    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename='.$filename);
    fputcsv($fp, $header);

    $csv_query = "SELECT full_name, nick_name, birth_date, address, email, contact_number FROM contact_tb where user_id = '$user_id'";
    $csv_result = mysqli_query($db, $csv_query);

    while($row = mysqli_fetch_row($csv_result)) {
        fputcsv($fp, $row);
    }
}
?>