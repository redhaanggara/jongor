<!DOCTYPE html>
<html>
	<head>
		 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftar Data</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
	<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>

	</head>
<body>

<div class="navbar-wrapper">
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="top-nav">
		<div class="container">
		<div class="navbar-header">
			<a href="#" class="navbar-brand">Hi Admin,<?php echo $this->session->userdata('admin');?></a>

			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
	        </button>
	        </div>

			<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Pendaftar</a></li>
				<li ><a href="http://ibgf.azurewebsites.net/index.php/person">Anggota</a></li>
			</ul>

			<div class="nav navbar-nav navbar-right">
				<li><a href="http://ibgf.azurewebsites.net/index.php/person/logout">Logout</a></li>
			</div>
		</div>
	 </nav>
</div>

    <br><br><br>

    <div class="container">
	    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
	    <br>
	    <caption><h2>Data Pendaftar</h2></caption>
	    <thead>
	    	<tr>
	    		<th>Id</th>
	    		<th>Waktu</th>
	    		<th>Nama</th>
	    		<th>Gender</th>
	    		<th>Jurusan</th>
	    		<th>Angkatan</th>
	    		<th>No HP</th>
	    		<th>Email</th>
	    		<th>Id Line</th>
	    		<th>Hobi</th>
	    		<th>Prestasi</th>
	    		<th>Alamat</th>
	    		<th>Keterangan</th>
	    		<th style="width:250px;">Aksi</th>
	    	</tr>
	    </thead>
	    	<?php
	    		foreach ($posts as $row) {
	    	?>
	    	<tbody>
	    	<tr>
	    		<td><?php echo $row->id ?></td>
	    		<td><?php echo $row->waktu?></td>
	    		<td><?php echo $row->nama?></td>
	    		<td><?php echo $row->gender ?></td>
	    		<td><?php echo $row->jurusan?></td>
	    		<td><?php echo $row->angkatan?></td>
	    		<td><?php echo $row->nohp?></td>
	    		<td><?php echo $row->email?></td>
	    		<td><?php echo $row->idline?></td>
	    		<td><?php echo $row->hobi?></td>
	    		<td><?php echo $row->prestasi?></td>
	    		<td><?php echo $row->alamat?></td>
	    		<td><?php echo $row->status?></td>
	    		<td><a href="http://ibgf.azurewebsites.net/index.php/person/admin_update_pendaftar?id=<?php echo  $row->id; ?>" class="btn btn-primary" class="btn btn-primary">Update</a> <a href="http://ibgf.azurewebsites.net/index.php/person/admin_delete_pendaftar?id=<?php echo  $row->id; ?>" class="btn btn-danger">Delete</a></td>
	    	
	    	</tr>
	    </tbody>
	    	<?php
	    }
	    	?>
	    </table>
	</div>
	
</body>
</html>
