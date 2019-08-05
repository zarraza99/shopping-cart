<?php 
	include "../../php/API/query.php";
	session_start();
	$query = new query();
	$temp = $query->select(array("*"),"product","where id = '".$_GET['id']."'")[0];
	

?>
    <div class='row'>
		<div class='col-md-12'>
			<form action="" id="checkout-form" class="smart-form" novalidate="novalidate">
				<fieldset >
					<section class="col col-6">
						<img class='card-img-top' src='../<?php echo $temp['img'] ?>' alt='Card image cap' style='border: 2px solid #17C533;height:350px;float:left;'>
					</section>
					<section class="col col-6" style="float:right;border: 2px solid #17C533;">
					
						<h2 style='font-weight:bold;text-align:center' class='card-title'><?php echo $temp['name'] ?></h2>
						<p style='padding:0px 10px;text-align:justify' class='card-text'><?php echo $temp['description'] ?></p>
						
						<p style='padding:0px 10px;' class='card-text'>
						<p class='card-text'><span style='font-size:25px;color:#000'>Price <?php echo $temp['price'] ?> $</span></p>
						</p>
					</section>
					<section class="col col-12">
						<p class='card-text'><span style='color:#000;padding:2px;'>Quantity</span></p>
						<label class="input"> <i class="icon-prepend fa fa-cart-plus"></i>
							<input  style="width: 100%;text-align-last: center;" onkeypress="return sonum(event)" onpaste="return false"  onchange="calculo()" id="quantity" placeholder='Quantity' value="<?php echo $_SESSION['buy'][$_GET['id']]['quantity'] ?>" type="number" min="1">
							<b class="tooltip tooltip-top-left">
								Quantity
							</b>
						</label>
					</section>
					<section class="col col-12">
						<p class='card-text'><span style='color:#000;padding:2px;'>Total</span></p>
						<label class="input"> <i class="icon-prepend fa fa-dollar"></i>
							<input style="width: 100%;text-align-last: center;" value="<?php echo $_SESSION['buy'][$_GET['id']]['total'] ?>" id="total" readonly placeholder='Total' type="number">
							<b class="tooltip tooltip-top-left">
								Total
							</b>
						</label>
					</section>
					<section class="col col-6">
						<label class="input" >
							<select  class="col col-12 input-sm"   style="width: 60%;text-align-last: center;" name="classify" id="classify" placeholder="classify">
								<option value="">Classif</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>	
							</select>
								
								<b class="tooltip tooltip-top-left">
									Classify
								</b>
								<i class="icon-prepend fa fa-star"></i> 		
						</label>
					</section>
				</fieldset>
					<footer>
						<span type="button" data-dismiss="modal" class="btn btn-danger cerrar">Close</span>
						<span id="submit" onclick="submit()" style="margin-top: 10px;margin-left:25px; background:#17C533;border-radius:0px 2px 0px 0px;color:#fff" type="button" id="bt"  class="btn btn-success send">Add to Cart</span>
					</footer>
			</form>
		</div>
	</div>
	
	<script>
		
		function calculo()
		{
			$('#total').val($('#quantity').val()*<?php echo $temp['price'] ?>)
		}
		function submit()
		{
			
			if($('#quantity').val() == 0)
			{
				alerta('error','Into one Unit');
				return;
			}

			let obj = {};
			let objeto = {};
				obj.quantity = $('#quantity').val();
				obj.classify = $('#classify').val();
				obj.total = $('#total').val();
				obj.id = <?php echo $_GET['id'] ?>;
				objeto = {'data':obj};
				console.log(objeto);
			$.ajax({
				url: "../../php/addtocart.php",
				data: objeto,
				type:'post',
				success: function(result){
					result = JSON.parse(result);
					console.log(result);
					$('#addtocart').text(result)
					alerta('success','Success add to cart')
					$('#items').click()
				}
			});
			
		};
		
		
		function classif()
		{
			let data={};
			let _data={};
			data.product = <?php echo $_GET['id']; ?>;
			data.user = <?php echo $_SESSION["id"]; ?>;
				
			_data = {'data':data};
			console.log(_data);
			$.ajax({
			url: "../../php/classify.php",
			data: _data,
			type:'post',
			success: function(result)
				{
					
				let resp = JSON.parse(result);
				if(!resp.length)
				{
					let resp =0;
				}
				else
				{
					

					for (items of resp) 
					{
						//console.log(items);
						$(`#classify  option:contains(${items.classify})`).attr('selected', 'selected');
					}
					
					$('#classify').attr('disabled','disabled');
					
				}
				/* console.log(resp); */
					
				}
			});
		}
		classif();

		$('#classify').change(function()
		{
			let obj = {};
			let objeto = {};
				obj.user = <?php echo $_SESSION["id"]; ?>;
				obj.classify = $('#classify').val();
				obj.product = <?php echo $_GET['id'] ?>;
				objeto = {'data':obj};
				console.log(objeto);
			$.ajax({
				url: "../../php/CRUD/addclassify.php",
				data: objeto,
				type:'post',
				success: function(result)
				{
					if(result == 'si')
					{
						$('#classify').attr('disabled','disabled');						
					}
						
				}
			});

		});
		
		function sonum(e)
		{
			key =e.keyCode || e.which;

			teclado=String.fromCharCode(key);
			numero="0123456789";
			especiales="8-37-38-46";
			teclado_especial=false;

			for(var i in especiales){
				if(key==especiales[i]){
					teclado_especial=true;
				}
			}
			if(numero.indexOf(teclado)==-1 && !teclado_especial){
				return false;
			}
		}
			

	</script>
	
	