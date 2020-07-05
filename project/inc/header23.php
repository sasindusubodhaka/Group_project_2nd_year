<style media="screen">
			*{
				padding: 0;
				margin: 0;
				text-decoration: none;
				list-style: none;
				box-sizing: border-box;
			}

			nav{
				padding-left: 20px;
				background:white;
				height: 40px;
				width: 100%;
				position: fixed;
			}

			nav ul{
				float: right;
				margin-right: 20px;
			}

			nav ul li{
				display: inline-block;
				line-height: 40px;
				margin: 0 5px;
			}

			nav ul li a{
				color:black;
				font-size: 15px;
				padding: 12px 13px;
				text-transform: uppercase;
				font-weight: bold;
			}

			nav ul li a:hover{
				background: #9c9595;
				color:white;
				transition: 0.5s;
			}

			header::after{
				content: ' ';
				display: table;
				clear: both;
			}

			a.logo{
				line-height: 40px;
			}

		</style>
		<header>
		<nav>
				<a class="logo" href="Homee.php"><img src="img/logo3.png" width="205" height="40"></a>
			<ul>
				<li><a href="Homee.php" id="homee">Home</a></li>
				<li><a href="#contact">Contact</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#Homee.php">SignUp</a></li>
				<li><a href="login.php">LogIn</a></li>
			</ul>
		</nav>
		</header>
