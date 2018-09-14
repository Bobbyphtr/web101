<?php 
/**
 * This is a formal php script --"  
 * ni gara gara phpcs lgsg merah semua screen ku wwkwkw
 *  
 * PHP version 7
 * 
 * @category Nothing
 * @package  Nothing
 * @author   nothing <nothing@nothing.com>
 * @license  nolisense URL
 * @link     nothing
 */

$servername="localhost";
$username="root";
$password="";
$database="leadership101";
$conn=mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed:". mysqli_connect_error());
}
// echo "connected successfully";
?>