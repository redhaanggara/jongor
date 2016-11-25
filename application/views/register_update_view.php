<!DOCTYPE html>
<html>
<head>
	<title>Updating...</title>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
	<script src="<?= base_url('assets/jquery.js') ?>"></script>
	<!-- animate.css -->
	<link rel="stylesheet" href="<?= base_url('assets/animate/animate.css') ?>" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewpost" content="width=device-width, initial-scale">
</head>
<body>
<br><br>
<center><h2>Update</h2></center>

<?php foreach ($post as $key) { ?>

  <div class="container">
  	<div class="row">
			<div class="control-group" id="fields">
				<div class="controls">
					<form role="form" autocomplete="off" action="http://ibgf.azurewebsites.net/index.php/person/update_insert_data?id=<?php echo  $key->id; ?>" method="post">
						<div class="form-group">
							<label for="inputnama">Nama Lengkap</label>
							<input type="text" name="nama" placeholder="Nama Legkap" class="form-control" value="<?php echo $key->nama; ?>">
						</div>
						<div class="form-group">
							<label for="gender">Gender</label>
							<select class="form-control" name="gender">
							  <option value="<?php echo $key->gender; ?>"><?php echo $key->gender; ?></option>
							  <option value="bujang">Bujang</option>
							  <option value="gadis">Gadis</option>
							</select>
						</div>
						<div class="form-group">
							<label for="jurusan">Jurusan</label>
				            <select class="form-control" name="jurusan">
				            	<option value="<?php echo $key->jurusan; ?>"><?php echo $key->jurusan; ?></option>
							  <optgroup label="Teknik Informatika">
								    <option value="ti reg">Teknik Informatika Reguler</option>
								    <option value="tibil">Teknik Informatika Bilingual</option>
							  </optgroup>
							  <optgroup label="Sistem Informasi">
								    <option value="si reg">Sistem Informasi Reguler</option>
								    <option value="si bil">Sistem Informasi Bilingual</option>
							  </optgroup>
							  <optgroup label="Sistem Komputer">
								    <option value="sk reg">Sistem Komputer Reguler</option>
								    <option value="sk unggulan">Sistem Komputer Unggulan</option>
							  </optgroup>
							  <optgroup label="Diploma Komputer">
								    <option value="mi">Management Informatika</option>
								    <option value="ka">Komputerisasi Akutansi</option>
								    <option value="tk">Teknik Komputer</option>
								    <option value="tkj">Teknik Komputer jaringan</option>
							  </optgroup>
							</select>
						</div>
						<div class="form-group">
							<label for="angkatan">Angkatan</label>
							<select class="form-control" name="angkatan">
							  <option value="<?php echo $key->angkatan; ?>"><?php echo $key->angkatan; ?></option>
							  <option value="2014">2014</option>
							  <option value="2015">2015</option>
							  <option value="2016">2016</option>
							</select>
						</div>
						<div class="form-group">
							<label for="nohp">No. Handphone</label>
							<input type="text" name="nohp" placeholder="No. Handphone" class="form-control" value="<?php echo $key->nohp; ?>">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $key->email; ?>">
						</div>
						<div class="form-group">
							<label for="idline">Id LINE</label>
							<input type="text" name="idline" placeholder="Id LINE" class="form-control" value="<?php echo $key->idline; ?>">
						</div>
						<div class="form-group" id="myForm">
							<label for="Hobi">Hobi</label>
							<div class="entry input-group">
								<input type="text" name="hobi" class="form-control" value="<?php echo $key->hobi; ?>" placeholder="Hobi">
						</div>
						<div class="form-group">
							<label for="prestasi">Prestasi Yang Pernah di Raih</label>
							<input type="text" name="prestasi" class="form-control" value="<?php echo $key->prestasi; ?>" placeholder="Prestasi">
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<textarea class="form-control" rows="3" name="alamat" placeholder="Alamat Tempat tinggal saat ini"> <?php echo $key->alamat; ?> </textarea>
						</div>
						<br>
						 <button type="submit" class="btn btn-primary btn-block"" name="btnsave">Save</button>
					</form>
				</div>
			</div>
	</div>
	<?php } ?>
	<br><br>
</body>
</html>
