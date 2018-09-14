<?php
error_reporting(1);
include('db.php');

//Untuk menghilangkan warning
if (!$_GET['act']){
	$_GET['act']='baru';
}

// Inisiasi data untuk menghindari warning

$pesan = NULL; //bersihkan $pesan

$hasilSimpan=NULL;

$defaultNama = NULL;
$defaultEmail = NULL;
$defaultPesan = NULL;
$defaultID = NULL;


if ($_GET['act']=='simpan'){
	// Proses penyimpanan data

	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$pesan = $_POST['pesan'];
	$id = $_POST['id'];

if ($id){
	// kalau ada $id berarti edit

$sqlSimpan = "
	UPDATE guestbook 
	SET nama='".$nama."', email='".$email."', pesan='".$pesan."'
	WHERE
		id = '".$id."'
	;";
}else{
	// karena tidak ada $id berarti simpan baru
	$sqlSimpan = "
	INSERT INTO guestbook 
	(nama, email, pesan) 
	VALUES 
	('".$nama."',
	'".$email."',
	'".$pesan."');";
}
	echo $sqlSimpan;
	$resultSimpan = mysqli_query($conn,$sqlSimpan);
	$hasilSimpan = mysqli_affected_rows($conn);
	$pesan = "<div>Penyimpanan ".$hasilSimpan." data berhasil.</div>";

}


if ($_GET['act']=='delete'){
	// hapus data  $_GET['nim']

	if ($_GET['id']){
		$sql = "Delete from guestbook where id='".$_GET['id']."'";
		$resultDelete = mysqli_query($conn, $sql);

	}



}

if ($_GET['act']=='edit'){
	// tampilkan form edit data di sini;
$idEdit = $_GET[id]; // $idEdit adalah id dari data yang akan diedit

//Baca dari database data dengan id = $idEdit
$sqlBaca = "SELECT * FROM guestbook WHERE id='".$idEdit."';  ";
$resultBaca = mysqli_query($conn, $sqlBaca);
if ($rowBaca = mysqli_fetch_assoc($resultBaca)){
	// apakah data dengan id tersebut ada di database

	$defaultNama = $rowBaca['nama'];
	$defaultEmail = $rowBaca['email'];
	$defaultPesan = $rowBaca['pesan'];
	$defaultID = $rowBaca['id'];



}else{
	$pesan = '<div>Data tidak diketemukan di database.</div>';
}

}

?><!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Guestbook</h1>
	<div>

		<form method="post" action="tampil.php?act=simpan">
		<input type="hidden" name="id" value="<?php echo $defaultID;?>">
			<div><label for="nama">Nama:</label>
				<input type="text" name="nama" value="<?php echo $defaultNama; ?>"></div>
				<div><label for="email">Email:</label>
					<input type="email" name="email" value="<?php echo $defaultEmail; ?>"></div>
					<div><label for="pesan">Pesan:</label>
						<textarea name="pesan"><?php echo $defaultPesan; ?></textarea></div>
						<div><input type="submit" name="simpan" value="Simpan"></div>
					</form>


				</div>



				<?php
				if ($pesan){
					echo $pesan;
				}






				$sql = "SELECT * FROM guestbook order by tanggal desc";
				$result = mysqli_query($conn, $sql);


				if (mysqli_num_rows($result)>0){

					echo "<table border=1>";
					echo "<thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Pesan</th><th>Tgl Simpan</th><th>Action</th></tr></thead><tbody>";

					while($row = mysqli_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>".$row['id']."</td>";
						echo "<td>".$row['nama']."</td>";
						echo "<td>".$row['email']."</td>";
						echo "<td>".$row['pesan']."</td>";
						echo "<td>".$row['tanggal']."</td>";
						echo "<td><a href='tampil.php?act=delete&id=".$row['id']."'>Delete</a> <a href='tampil.php?act=edit&id=".$row['id']."'>Edit</a></td>";
						echo "</tr>";


					}


					echo "</tbody></table>";

				}else{
					echo "tidak ada data";
				}





				?>

			</body>
			</html>
