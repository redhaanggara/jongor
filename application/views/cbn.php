<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
		<link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
		 <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

	<!-- animate.css -->
	<link rel="stylesheet" href="<?= base_url('assets/animate/animate.css') ?>" />
	<link rel="stylesheet">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewpost" content="width=device-width, initial-scale">
</head>
<body>
<br><br>
<br><br>

<br>
  <div class="container">
  <h3><a href="http://ibgf.azurewebsites.net/index.php/main/home_page"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp Home Page</a></h3>
  <br>
  <legend>Admin Login</legend>

<!-- Text input-->

    <form class="form-horizontal" action="http://ibgf.azurewebsites.net/index.php/person/signin" method="post">
    <fieldset>
    	<div class="form-gorup">
    		<label for="username" class="col-sm-2 control-label">User Name</label>
    		<div class="col-sm-10">
    			<input type="text" name="username" class="form-control" id="username" placeholder="username">
    		</div>
    	</div>
    	<div class="form-gorup">
    		<label for="password" class="col-sm-2 control-label">Password</label>
    		<div class="col-sm-10">
    			<input type="password" name="password" class="form-control" placeholder="password">
    		</div>
    	</div>
    	<div class="form-gorup">
    		<div class="col-sm-offset-2 col-sm-10">
    			<div class="checkbox"></div>
    			<label>
    				<input type="checkbox" name="cb">
    				Remember me
    			</label>
    		</div>
    	</div>
    	<div class="form-gorup">
    		<div class="col-sm-offset-2 col-sm-10">
    			<input type="submit" class="btn btn-default" name="btnsignin" value="Login">
    		</div>
    	</div>
    	</fieldset>
    </form>
    </div>
</body>
</html>
