<html>
<head>
	<title>Unmarketd</title>
	<style type="text/css">
		body{
			background: #e3e3e3;
		    margin: 0 auto;
		    width: 60%;
		}
		.action{
		    height: 100px;
		    line-height: 100px;
		    background: #0eba8b;
		    color: white;			
		}
		.action h1{
			padding-left: 20px;
		}
		.body{
		    padding-top: 50px;
		    padding-bottom: 30px;
		    font-size: 16px;			
		}
		.button {
			margin-bottom: 40px;
		}
		.button a{
		    background: red;
		    color: white;
		    padding: 20px;
		    font-size: 28px;
		    text-decoration: none;			
		}
		.thank{
			font-size: 16px;
			
		}
	</style>
</head>
<body>
<div class="container">

	<div class="row">
		<div class="action">
			<h1>Please Verify Your Email Address</h1>

		</div>
		<div class="body">
			
				<p>We notice that you have signed up with us, to log in your account you need to verify your email address. To do simply click the button below, you will asked to login to your account. We are simply verifying ownership of this email address</p>
			
		</div>
		<div class="button">
			 <a href="<?php echo url('register/verify/').'/'.$token?>">Verify Your Email Address</a> 
		</div>

		<div class="thank">
			<p>Thanks for being a freelancer of Unmarketd</p>
			<p>Sincerely</p>
			<p>Unmarketd</p>
		</div>
	</div>
	<div class="row" style="margin-top:100px;">
		<center>&copy; All rights and reserved | Unmarketd</center>
	</div>
</div>
</body>
</html>