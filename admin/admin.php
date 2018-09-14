<?php
include('db.php');


// if ($_GET['act']=='delete'){
// 	// hapus data  $_GET['nim']

// 	if ($_GET['nim']){
// 		$sql = "Delete from peserta where nim='".$_GET['nim']."'";
// 		$resultDelete = mysqli_query($conn, $sql);

// 	}



// }

// if ($_GET['act']=='edit'){
// 	// tampilkan form edit data di sini;




// }


$sql = "SELECT * FROM peserta";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result)>0){

	echo "<table border=1>";
	echo "<thead><tr><th>ID</th><th>Email</th><th>Nama</th><th>NIM</th><th>Biaya</th><th>Action</th></tr></thead><tbody>";

	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		echo "<td>".$row['id']."</td>";
		echo "<td>".$row['user_mail']."</td>";
		echo "<td>".$row['user_name']."</td>";
		echo "<td>".$row['user_nim']."</td>";
		echo "<td>".$row['biaya']."</td>";
		// echo "<td><a href='tampil.php?act=delete&nim=".$row['nim']."'>Delete</a> <a href='tampil.php?act=edit&nim=".$row['nim']."'>Edit</a></td>";
		echo "</tr>";


	}


	echo "</tbody></table>";

}else{
	echo "tidak ada data";
}





?>
