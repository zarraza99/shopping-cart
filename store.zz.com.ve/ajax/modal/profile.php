<?php session_start();
?>

<div class="modal-body">
	<div class="row">
		<div class="col-sm-12">
			<div id="myCarousel" class="carousel fade profile-carousel">
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1" class=""></li>
					<li data-target="#myCarousel" data-slide-to="2" class=""></li>
				</ol>
			<div class="carousel-inner">
			<div class="item active">
				<img src="<?php echo $_SESSION["profile"]?>" alt="">
			</div>
			<div class="item">
				<img src="<?php echo $_SESSION["profile"]?>" alt="">
			</div>
			<div class="item">
				<img src="<?php echo $_SESSION["profile"]?>" alt="">
			</div>
		</div>
	</div>
</div>
<div class="col-sm-12">
	<div id="profilee" class="row">
		<div class="col-sm-3 profile-pic">
			<img src="<?php echo $_SESSION["profile"]?>">
			<div class="padding-10">
			</div>
		</div>
	<div class="col-sm-9">
		<h1 id="firstname"></h1>
		<ul class="list-unstyled">
			<li>
			<p >
				<i class="fa fa-user">
					<a  id="user"  data-value="" ></a>
					<b class="tooltip tooltip-top-left">
					User
					</b>
				</i>
			</p>
		</li>
		
	</ul>
	</div>
</div>
<style>
a {
	color: black;
}	
</style>
<script>
	pageSetUp();
	//COMIENZA AJAX DESPUES EN DONE EL CODIGO}

	$.ajax({
		url:'php/user/datos.php',
		type:"POST",
		data:{id: "<?php echo $_SESSION['id'] ;?>" }
	}).done(function(resp){
		let datos = JSON.parse(resp);
		console.log(datos);
		for ( dato of  datos){
			$('#firstname').text(dato.firstname);
			$('#user').text(dato.user);
		}
	
		
	});//ESTA CIERRA EL AJAX
	loadScript("js/plugin/x-editable/moment.min.js", function(){
		loadScript("js/plugin/x-editable/jquery.mockjax.min.js", function(){
			loadScript("js/plugin/x-editable/x-editable.min.js", function(){
				loadScript("js/plugin/typeahead/typeahead.min.js", pagefunction);
			});
		});
	});	
</script>

