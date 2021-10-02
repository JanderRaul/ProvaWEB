<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADS Shows</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=New+Rocker&display=swap" rel="stylesheet">
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');
		.botao{
			color: #000 !important;
			background-color: #fff;
		}
		.brand-text{
			color: #fff !important
		}
		form{
			margin: 20px auto;
			padding: 20px;
		}
		.fundo{
			background-color: #fff;
		}
		.container2{
			padding: 20px 10%;
		}
		.wrapper{
			background: #fff;
			border-radius: 16px;
			margin: 0;
		}
		.form{
			padding: 25px 30px;
		}
		.form header{
			font-size: 25px;
			font-weight: 600;
			border-bottom: 1px solid #e6e6e6;
			margin-bottom: 20px;
		}
		.form form{
			margin: 0;
		}
		.form form .field{
			display: flex;
			position: relative;
			flex-direction: column;
			margin-bottom: 10px;
		}
		.form form .field label{
			margin-bottom: 2px;
		}
		.form form .input input{
			outline: none;
		}
		.form form .input input{
			height: 40px;
			width: 97.5%;
			font-size: 16px;
			padding: 0 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		.form form .button input{
			margin-top: 13px;
			height: 45px;
			border: none;
			font-size: 17px;
			font-weight: 400;
			background: #333;
			color: #fff;
			border-radius: 5px;
			cursor: pointer;
		}
		.shows{
			border-radius: 20px; 
			background: #000;
		}
		.shows h4{
			font-family: 'New Rocker', cursive; font-size: 20px; 
			margin-left: 10px; color: #fff; 
			padding: 5px; 
			margin-top: 0; 
			padding: 10px 0 0 5px;
		}
		.bandas{
			border-radius: 20px 20px 0 0; 
			background: #fff;
		}
		.bandas h4{
			font-family: 'New Rocker', cursive; font-size: 20px; 
			margin-left: 10px; 
			color: #000; 
			padding: 5px; 
			margin-top: 10px; 
			padding: 10px 0 0 5px;
		}
		.fundo{
			height: 600px;
			background: #fff;
			margin: -20px 0;			
		}
		.contatos{
			height: 600px;
			align-items: center;			
			margin: 0px;
			padding: 0;
			background: #000;
			border-radius: 20px;
			box-sizing: border-box;
			font-family: 'Poppins', sans-serif;
			padding: 50px;
			text-align: center;
			display: flex;
		}
		.cont{
			height: 250px;
			width: 250px;
			overflow: hidden;
			margin: 0 auto;
			border-radius: 50%;
			transition: all 0.3s ease-in-out;
			box-shadow: 0px 1px 5px 0px rgba(0, 0, 0, 0.3);
			background: linear-gradient(45deg, #010111, #010f1f);
		}
		.cont:hover{
			height: 470px;
			width: 350px;
			border-radius: 5px;
			box-shadow: 0px 1px 35px 0px rgba(0, 0, 0, 0.3);
		}
		.cont .cover img{
			position: relative;
			z-index: 20;
			border-radius: 50%;
			display: block;
			height: 200px;
			width: 200px;
			border: 5px solid #fff;
			object-fit: cover;
			margin: 20px auto;
			transition: all 0.3s ease;
		}
		.cont:hover .cover img.active{
			height: 470px;
			width: 350px;
			margin: 0px auto;
			border: none;
			border-radius: 5px;
		}
		.cover .titulo{
			color: #fff;
			font-size: 30px;
			font-weight: 500;
			padding: 10px;
			line-height: 25px;
		}
		.cover .lugar{
			color: #fff;
			font-size: 17px;
			line-height: 0px;
			margin: 10px 0;
		}
		.content2{
			color: #fff;
			font-size: 17px;
			margin-top: 10px;
			padding: 1px 20px 10px 20px !important;
		}
		.content2 .buttons2{
			display: flex;
		}
		.buttons2 .btn2{
			height: 40px;
			width: 150px;
			margin: 0 5px;
		}
		.buttons2 .btn2 button{
			height: 100%;
			width: 100%;
			background: #fff;
			border: none;
			outline: none;
			cursor: pointer;
			font-size: 17px;
			font-weight: 500;
			border-radius: 5px;
			transition: all 0.3s;
		}
		.btn2 button:hover{
			transform: scale(0.95);
		}
		.titulo-inf{
			display: flex;
			align-items: center;
			justify-content: space-between;
			width: 100%;
		}
		.titulo-inf form{
			margin: 20px;
		}
	</style>
</head>
<body style="background-color: #000;">
	<nav class="z-depht-0" style="background-color: #010f1f;">	
		<ul class="left hide-on-med-and-down">
			<li><a href="index.php" style="font-size: 28px;">ADS Shows</a></li>
			<li><a href="#sh">Shows</a></li>
			<li><a href="#bd">Bandas</a></li>
			<li><a href="#ct">Contatos</a></li>
		</ul>
		<ul id="nav-mobile" class="right hide-on-small-and-down">
			<li><a href="adicionarBND.php" class="btn botao z-depht-0">Adicionar Banda</a></li> 
			<li><a href="adicionar.php" class="btn botao z-depht-0">Adicionar Show</a></li> 
		</ul>
	</nav>
