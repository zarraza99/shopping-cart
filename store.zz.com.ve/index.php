
<?php
session_start();
if(!$_SESSION){ 
	header("Location: login.php");
	die();
}

 ?>
<!DOCTYPE html>
<html lang="en-us">	
<head>


		<meta charset="utf-8">
		<title>STORE</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		




		<!--link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"-->
		<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
		<!--link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css"-->


		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-rtl.min.css"> 
		<link rel="stylesheet" type="text/css" media="screen" href="css/demo.min.css">
		<link rel="shortcut icon" href="img/iso.png" type="image/x-icon">
		<link rel="icon" href="img/iso.png" type="image/x-icon">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

		
	</head>
	<body class="smart-style-2" >


		


        <header id="header" style="position: fixed;width: 100%; ">
			<div id="logo-group">
                <span id="logo"> <img src="img/logo.png"  style="width:30px;" alt="Store"> </span>
			</div>
			<div class="pull-right">
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				    <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
					    <li class="">
						    <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
							    <img src="<?php echo $_SESSION["profile"]?>" alt="" class="online" >  
						    </a>
						        <ul class="dropdown-menu pull-right">

							        <li class="divider"></li>
                                    <li>
								        <a href="#ajax/profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                                    </li>
							        <li class="divider"></li>
							        <li>
								        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
							        </li>
							        <li class="divider"></li>
                                    <li>
								        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
							        </li>
							        <li class="divider"></li>
                                    <li>
                                        <a href="login.php" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                                    </li>
						        </ul>
					    </li>
				    </ul>

				<!-- logout button -->
                    <div id="logout" class="btn-header transparent pull-right">
                        <span> <a  href="login.php"  title="Cerrar sesion" data-action="userLogout" data-logout-msg=" Esta apunt ode cerrar sesion"><i class="fa fa-sign-out"></i></a> </span>
                    </div>
				<!-- end logout button -->
                    <div id="fullscreen" class="btn-header transparent pull-right">
                        <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
                    </div>
				<!-- end fullscreen button -->
			</div>
			<!-- end pulled right: nav area -->
		</header>
		<aside id="left-panel" style="position: fixed;">
			<div class="login-info">
				<!-- Imagen de profile y nombre -->
				<span> 	
					<a href="ajax/modal/profile.php" data-toggle="modal" data-target="#profile">	
						<img style="border-radius: 50%" id="miniprofile" src="<?php echo $_SESSION["profile"] ?>" alt="me" class="online" /> 
						<span>
							<?php echo $_SESSION["firstname"] ?>
						</span>
						<i id="wallet-user" style="font-size:10px;background:#333;color:#fff;border-radius:50%;padding:5px 10px" ><?php echo $_SESSION["wallet"]?> $</i>
					</a> 
				</span>	
				<!-- FIN profile -->
			</div>
			<nav>
				<!-- Constructor del Menu CUIDADO -->
				<ul>
					<?php
					foreach($_SESSION["menu"] as $indice => $valor){
						echo "<li class=''>";
							echo "<a href='".$valor["link"]."' title='".$valor["name"]."'><i class='".$valor["icon"]."'></i> <span class='menu-item-parent'>".$valor["name"].' '.$valor["father"]."</span></a>";
							
						echo "</li>";
					};
					?>
					
				</ul>
				<!-- Fin Menu -->
			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
		</aside>
		<div id="main" role="main" style="min-height: 92.6vh; ">
			<div id="ribbon" style="margin-bottom:3%;">
				<ol class="breadcrumb">
				</ol>
			</div>
			<!-- Contenedor modulos -->
			<div id="content" style="overflow-x:hidden">
			</div>
			<!-- Fin contenedor -->
		</div>
		<div class="page-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<span class="txt-color-white">STORE<span class="hidden-xs"> </span></span>
				</div>
			</div>
			<!-- Modal del profile -->
			<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">  
				<div class="modal-dialog">  
					<div class="modal-content">
					
					</div>
				</div>
			</div>
			<!-- Fin del modal -->
		</div>

		
		<!-- Librerias Jquery -->
		<script src="js/libs/jquery-3.2.1.min.js"></script>
		<script src="js/libs/jquery-ui.min.js"></script>
		<!-- Librerias Principales -->
		<script src="js/app.config.js"></script>
		<!-- para controlar los Drags -->
		<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 
		<!-- Lo principal del booptrap -->
		<script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
		<!-- Controla las notificacions y los WIDGETS NO QUITAR NUNCA-->
		<script src="js/notification/SmartNotification.min.js"></script>
		<script src="js/smartwidgets/jarvis.widget.min.js"></script>
		<!-- Maneja validaciones -->
		<script src="js/plugin/jquery-validate/jquery.validate.min.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<!-- Por si quieres usar unos selects muy chulos -->
		<script src="js/plugin/select2/select2.min.js"></script>
		<!-- para detectar navegadores y reemplaza unas cosas actiguas de JQUERY -->
		<script src="js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
		<!-- Mas cosas del SMART -->
		<script src="js/app.min.js"></script>
		<script src="js/plugin/masked-input/jquery.maskedinput.min.js"></script>
		<!-- JS para los chats -->
		<script src="js/smart-chat-ui/smart.chat.ui.min.js"></script>
		<script src="js/smart-chat-ui/smart.chat.manager.min.js"></script>
		<!-- Herramientas -->
		<script src="js/utilidades.js"></script>
		<script src="js/chat.js"></script>
		<!-- Charts -->
		<script src="js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
		<script src="js/plugin/sparkline/jquery.sparkline.min.js"></script>
		<script>
			$('#addtocart').text(<?php echo $_SESSION['addtocart'] ?>)
			var noti = {};
			$(document).ready(function(){
				Hnotif();
				window.setInterval(function(){mensajes();bandeja();notif();}, 4000);
				
			});

			$('#login-form').submit(function(e){
				e.preventDefault();
				$.ajax({
					url:'php/user/logout.php',
					type:'post',
					success:function(resp){
						if(resp == "ok"){
							location.href = "index.php#ajax/start.php";
						}
						console.log(resp)
					}
				});
			});
		</script>
		

		
		

	</body>
</html>
