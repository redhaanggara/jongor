<!DOCTYPE html>
<html>
<head>
	<title>Regis Profile</title>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
		
	<!-- animate.css -->
	<link rel="stylesheet" href="<?= base_url('assets/animate/animate.css') ?>" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewpost" content="width=device-width, initial-scale">
</head>
<body>
<br><br><br><br>


<?php foreach ($posts as $post) { ?>

	<div class="container">
		<table class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th colspan="2"><center><h2>Profile Calon PBGF 2017</h2></center></th>
			</tr>
		</thead>
			<tr>
				<td width="20%"><strong>Nama</strong></td>
				<td><?php echo $post->nama; ?></td>
			</tr>
			<tr>
				<td><strong>Gender</strong></td>
				<td><?php echo $post->gender ?></td>
			</tr>
			<tr>
				<td><strong>Jurusan</strong></td>
				<td><?php echo $post->jurusan ?></td>
			</tr>
			<tr>
				<td><strong>Angkatan</strong></td>
				<td><?php echo $post->angkatan ?></td>
			</tr>
			<tr>
				<td><strong>No. HP</strong></td>
				<td><?php echo $post->nohp ?></td>
			</tr>
			<tr>
				<td><strong>Email</strong></td>
				<td><?php echo $post->email ?></td>
			</tr>
			<tr>
				<td><strong>Id LINE</strong></td>
				<td><?php echo $post->idline ?></td>
			</tr>
			<tr>
				<td><strong>Hobi</strong></td>
				<td><?php echo $post->hobi ?></td>
			</tr>
			<tr>
				<td><strong>Prestasi</strong></td>
				<td><?php echo $post->prestasi ?></td>
			</tr>
			<tr>
				<td><strong>Alamat</strong></td>
				<td><?php echo $post->alamat?> </td>
			</tr>
		</table>
		<a href="http://localhost/master/person/send_email?id=<?php echo  $post->id; ?> &nama=<?php echo $post->nama; ?> &email=<?php echo $post->email; ?> " class="btn btn-success btn-lg"><span class="glyphicon glyphicon-download-alt"></span>&nbsp Cetak</a>
		<a href="http://localhost/master/person/update_data_regis?id=<?php echo  $post->id; ?>" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-pencil"></span>&nbsp Edit</a>
		<a href="http://localhost/master/main/home_page" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-home"></span>&nbsp Halaman Utama</a>
		<?php } ?>
	</div>
</body>
</html>