<!DOCTYPE html>
<html>
<head>
	<title>Success</title>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
	<script src="<?= base_url('assets/jquery.js') ?>"></script>
	<!-- animate.css -->
	<link rel="stylesheet" href="<?= base_url('assets/animate/animate.css') ?>" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewpost" content="width=device-width, initial-scale">
</head>
<body>
<br><br><br>
	<center>
		<div class="container">
		    <div class="alert alert-success fade in">
		        <a href="#" class="close" data-dismiss="alert">&times;</a>
		        <strong>Success!</strong> Your PDF file has been sent successfully to your email <italic><?php echo $email; ?></italic> check and download in your inbox <br><br>.
		        <a href="http://ibgf.azurewebsites.net" class="btn btn-primary" data-dismiss="alert">&nbsp <span class="glyphicon glyphicon-home"></span>&nbsp back to home</a>
		    </div>
		</div>
	</center>
</body>
</html>
