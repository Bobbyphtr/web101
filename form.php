<?php
error_reporting(1);
include('db.php');

//Untuk menghilangkan warning
if (!$_GET['act']){
	$_GET['act']='baru';
}

// Inisiasi data untuk menghindari AXEL YANG NUB ga bisa koding PHP

$pesan = NULL; //bersihkan $pesan

$hasilSimpan=NULL;

$defaultNama = NULL;
$defaultEmail = NULL;
$defaultPesan = NULL;
$defaultID = NULL;


if ($_GET['act']=='simpan'){
	// Proses penyimpanan data

	$nama = $_POST['user_name'];
	$email = $_POST['user_mail'];
	$nim = $_POST['user_nim'];
	$id = $_POST['id'];

if ($id){
	// kalau ada $id berarti edit

// $sqlSimpan = "
// 	UPDATE peserta 
// 	SET nama='".$nama."', email='".$email."', pesan='".$pesan."'
// 	WHERE
// 		id = '".$id."'
// 	;";
}else{
	// karena tidak ada $id berarti simpan baru
	$sqlSimpan = "
	INSERT INTO peserta 
	(`user_mail`, `user_name`, `user_nim`) 
	VALUES 
	('".$email."',
	'".$nama."',
	'".$nim."');";
	$resultSimpan = mysqli_query($conn,$sqlSimpan);
	$sqlHarga = "
	SELECT  `id` FROM `peserta` WHERE peserta.user_name = '".$nama."' && peserta.user_nim = '".$nim."';";
	$resultHarga = mysqli_query($conn,$sqlHarga);
	if (mysqli_num_rows($resultHarga)>0){
	while($row = mysqli_fetch_assoc($resultHarga)){
		$id =  $row['id'];
	}
	$sqlBayar = "
	UPDATE `peserta` SET  biaya =130000 + $id WHERE id = $id";
	$resultHarga = mysqli_query($conn,$sqlBayar);
}
	
	
	
}
	

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Form Pendaftaran</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form method="post" action="form.php?act=simpan">
		<input type="hidden" name="id" value="<?php echo $defaultID;?>">
		<div>
			<label for="mail">E-mail:</label>
			<input type="email" id="mail" name="user_mail">
		</div>
		<div>
			<label for="name">Nama:</label>
			<input type="text" id="name" name="user_name">
		</div>
		<div>
			<label for="name">NIM:</label>
			<input type="text" id="nim" name="user_nim">
		</div>
		<div class="button">
			<button type="submit" name="simpan" value="Simpan">Submit</button>
		</div>
	</form>

</body>
</html>