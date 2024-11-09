<!DOCTYPE html>
<html>
<head>
	<title>404 Not Found</title>
	<link href="<?php echo assets('css/bootstrap4/bootstrap.min.css')?>" rel="stylesheet" id="bootstrap-css">
	<style type="text/css">
		body {
		    background: #dedede;
		}
		.page-wrap {
		    min-height: 100vh;
		}
	</style>
</head>
<body>
	<div class="page-wrap d-flex flex-row align-items-center">
	    <div class="container">
	        <div class="row justify-content-center">
	            <div class="col-md-12 text-center">
	                <span class="display-1 d-block">404</span>
	                <div class="mb-4 lead">The page you are looking for was not found.</div>
	                <input action="action" onclick="window.history.go(-1); return false;" type="button" value="Go Back" class="btn btn-link" />
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>
