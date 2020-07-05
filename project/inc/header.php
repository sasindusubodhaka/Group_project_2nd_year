

	<style media="screen">
			*{
				padding: 0;
				margin: 0;
				text-decoration: none;
				list-style: none;
				box-sizing: border-box;
			}

			body{
				font-family: "Arial", Helvetica, sans-serif;
			}

			nav{
				padding-left: 20px;
				background: blue;
				height: 50px;
				width: 100%;
			}

			nav ul{
				float: right;
				margin-right: 0px;
			}

			nav ul li{
				display: inline-block;
				line-height: 50px;
				margin: 0 5px;
			}

			nav ul li a{
				color:black;
				font-size: 15px;
				padding: 17px 13px;
				text-transform: uppercase;
				font-weight: bold;
			}

			nav ul li a:hover{
				background: #3459e2;
				color:white;
				transition: 0.5s;
			}

			a.logo{
				line-height: 50px;
			}

			header::after{
				content: '';
				display:table;
				clear:both;
			}

		</style>
		<header>
		<nav>
				<a class="logo" href="Homee.php"><img src="img/logo.jpeg" width="220" height="45"></a>
			<ul>
				<li><a href="Homee.php">Home</a></li>
				<li><a href="#contact">Contact</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="sign_up.php">SignUp</a></li>
				<li><a href="login.php">LogIn</a></li>
			</ul>

		</nav>
		</header>
	
