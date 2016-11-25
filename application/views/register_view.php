<!DOCTYPE html>
<html>
<head>

	<title>Register PBGF 2017</title>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
	<script src="<?= base_url('assets/jquery.js') ?>"></script>
	<!-- animate.css -->
	<link rel="stylesheet" href="<?= base_url('assets/animate/animate.css') ?>" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewpost" content="width=device-width, initial-scale">

	<script type="text/javascript">
		$(document).ready(function(){
			var maxField = 10; //Input fields increment limitation
			var addButton = $('#add_button'); //Add button selector
			var wrapper = $('.field_wrapper'); //Input field wrapper
			var fieldHTML = '<div><input type="text" name="hobi[]" class="form-control"> <a href="javascript:void(0);" id="remove_button" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span></a></div>'; //New input field html 
			var x = 1; //Initial field counter is 1

			$(addButton).click(function(){ //Once add button is clicked
				if(x < maxField){ //Check maximum number of input fields
					x++; //Increment field counter
					$(wrapper).append(fieldHTML); // Add field html
				}
			});
			$(wrapper).on('click', '#remove_button', function(e){ //Once remove button is clicked
				e.preventDefault();
				$(this).parent('div').remove(); //Remove field html
				x--; //Decrement field counter
			});

			//prestasi
			 var maxField2=10;
			 var addButton2= $('#add_buttonPrestasi');
			 var wrapper2= $('.field_wrapper2');
			 var fieldHTML2= '<div><input type="text" name="prestasi[]" class="form-control"><a href="javascript:void(1);" id="remove_button2" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span></a></div>';
			 var x2=1;

			 $(addButton2).click(function(){ //Once add button is clicked
				if(x < maxField2){ //Check maximum number of input fields
					x++; //Increment field counter
					$(wrapper2).append(fieldHTML2); // Add field html
				}
			});
			$(wrapper2).on('click', '#remove_button2', function(e){ //Once remove button is clicked
				e.preventDefault();
				$(this).parent('div').remove(); //Remove field html
				x2--; //Decrement field counter
			});

		});
	</script>

</head>
<body>
<br><br>

	<div class="container">
	<h3><a href="http://ibgf.azurewebsites.net/index.php/main/home_page"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp Home Page</a></h3>
	<center><h2>Registrasi PBGF 2017</h2></center>
		<div class="row">
			<div class="control-group" id="fields">
				<div class="controls">
					<form role="form" autocomplete="off" action="http://ibgf.azurewebsites.net/index.php/person/insert_regis" method="post">
						<div class="form-group">
							<label for="inputnama">Nama Lengkap</label>
							<input type="text" name="nama" placeholder="Nama Legkap" class="form-control">
						</div>
						<div class="form-group">
							<label for="gender">Gender</label>
							<select class="form-control" name="gender">
							  <option value="">Jenis Kelamin</option>
							  <option value="bujang">Bujang</option>
							  <option value="gadis">Gadis</option>
							</select>
						</div>
						<div class="form-group">
							<label for="jurusan">Jurusan</label>
				            <select class="form-control" name="jurusan">
				            	<option value="">Jurusan</option>
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
							  <option value="">Angkatan</option>
							  <option value="2014">2014</option>
							  <option value="2015">2015</option>
							  <option value="2016">2016</option>
							</select>
						</div>
						<div class="form-group">
							<label for="nohp">No. Handphone</label>
							<input type="text" name="nohp" placeholder="No. Handphone" class="form-control">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" placeholder="Email" class="form-control">
						</div>
						<div class="form-group">
							<label for="idline">Id LINE</label>
							<input type="text" name="idline" placeholder="Id LINE" class="form-control">
						</div>
						<div class="form-group" id="myForm">
							<label for="Hobi">Hobi</label>
							<div class="entry input-group">
								<div class="field_wrapper">
									<div class="input-group">
								    	<input type="text" name="hobi[]" placeholder="Hobi" class="form-control">
								    	  <span class="input-group-btn">
											    <a href="javascript:void(0);" id="add_button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
									     </span>
								    </div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="prestasi">Prestasi Yang Pernah di Raih</label>
							<div class="entry input-group">
								<div class="field_wrapper2">
									<div class="input-group">
										<input type="text" name="prestasi[]" placeholder="Prestasi" class="form-control">
										<span class="input-group-btn">
											<a href="javascript:void(1);" id="add_buttonPrestasi" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></a>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="alamat">Alamat</label>
							<textarea class="form-control" rows="3" name="alamat"></textarea>
						</div>
						<br><br>
						 <button type="submit" class="btn btn-primary btn-block"" name="btnregister">Register</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<br><br>
</body>
</html>

