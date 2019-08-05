<?php session_start();?>
<div class="modal-body no-padding">  
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12">
				<section id="widget-grid" class="">
					<div class="row">
						<article class="col-sm-12 col-md-12 col-lg-12" style="padding:0">
                            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" style="margin-bottom:0" data-widget-editbutton="false" data-widget-custombutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
									<h2>Billing  </h2>				
                                </header>
                                
								<div class="content">
									<div class="jarviswidget-editbox">	
								</div>
									<div class="widget-body no-padding">
										<form action="" id="checkout-form" class="smart-form" novalidate="novalidate">

                                                <header></header>
                                                <fieldset >
                                               
                                                    <section class="col col-6">
                                                        <label class="input" >
                                                            <select  class="col col-12 input-sm"  style="width: 100%;text-align-last: center;" name="transport" id="transport" placeholder="Transport">
                                                                
                                                            </select>
                                                                
                                                                <b class="tooltip tooltip-top-left">
                                                                    Transport
                                                                </b>
                                                                <i class="icon-prepend fa fa-bus"></i> 		
                                                        </label>
                                                    </section>
                                                    <section class="col col-6">
                                                        <label class="input"> <i class="icon-prepend fa fa-money"></i>
															<input readonly type="text" id="price" name="price"  placeholder="price">
															<b class="tooltip tooltip-top-left">
                                                                Price
															</b>
														</label>
                                                    </section>
												</fieldset>
													<section class="table-responsive">
														<table id="example" class="ui celled table table-condensed table-striped table-bordered table-hover" style="width:95%;margin:auto">
															<thead>			                
																<tr>
																	<th class="center" style=" text-align:center; border: 1px solid; width:5%">ID</th>
																	<th class="center" style=" text-align:center; border: 1px solid; width:20%">PRODUCT</th>
																	<th class="center"style=" text-align:center; border: 1px solid; width:20%">PRICE</th>
																	<th class="center" style=" text-align:center; border: 1px solid; width:20%">CUANTITY</th>
																	<th class="center" style=" text-align:center; border: 1px solid; width:20%">SUBTOTAL</th>
																	<th data-hide="expand" class="center vertical-center sorting" tabindex="0" aria-controls="dt_basic" rowspan="1" colspan="1" style="width: 15%; text-align:center; border: 1px solid;" aria-label=": activate to sort column ascending"> <i rel="tooltip" data-placement="top" data-original-title="Delete" class="fa fa-trash-o" ></i> </th>
																</tr>
															</thead>
															<tbody id=examp>
																<?php include "../../php/table/table.php" ?>
															</tbody>
														
														</table>
													</section>
												<fieldset>												
													<section class="col col-6">
															<label class="input"> <i class="icon-prepend fa fa-dollar"></i>
																<input readonly type="text" id="total"  name="total" placeholder="total">
																<b class="tooltip tooltip-top-left">
																	total
																</b>
															</label>
													</section>
                                                </fieldset>
                                                <footer>
                                                    <span type="button" data-dismiss="modal" class="btn btn-danger cerrar">Close</span>
                                                    <span  onclick="tobuy()" style="margin-top: 10px;margin-left:25px; background:#17C533;border-radius:0px 2px 0px 0px;color:#fff" type="button" id="bt" disabled="disabled" class="btn btn-success send">To Buy</span>
												</footer>
												
								
										</form>
									</div>
								</div>
							</div>
						</article>
					</div>
				</section>
			</div>
		</div>
	</div>        
</div>



<script>
$( document ).ready(function() 
{


	$('#next .quantity' ).attr('disabled','disabled');
	$('#next [name="delete"]' ).attr('disabled','disabled');   

function tran()
{



	 $.ajax(
	{
		type:"POST",
		
		url:'/php/table/transport.php',
		
	}).done(function(resp)
	{

		//console.log(resp);

		let trans = JSON.parse(resp);
		let num =`<option style="text-align: center;" value="">  Transport</option>` ;

		for (items of trans) {
			//console.log(items);
			num +=`<option style="text-align: center;" value="${items.id}"  >${items.description} </option>`;
			

		}
		
		$('#transport').empty().append(num);

		
		
				

			
	});
	

}
tran();


$('#transport').change(function()
{
	$('#price').val('');
	let Transport = "";

	transport = $('#transport').val();

	

	let _objeto = {'dato':transport};

	 $.ajax({
		type:"POST",
		data: _objeto,
		url:'/php/table/price.php',
		
	}).done(function(resp)
	{

		//console.log(resp);

		let pre = JSON.parse(resp);
		let l;
		
		for (item of pre) 
		{
			
			$('#price').empty().val(item.price);
		
		}
		
		let total=0;
		$('#next #examp > tr > td:nth-child(5)').each( function( index ) {
		total +=  parseFloat($( this ).text());
		});
			
		total += parseFloat($('#price').val() || 0) ;
		$('#total').val(total);
				
		});
	
});
});

function bill()
{
	let pric = [];

	$( "#examp  tr" ).each(function( index ) 
	{
		let id_product = $( this ).find('td:nth-child(1)').text();
		let name_product = $( this ).find('td:nth-child(2) ').text();
		let price_product = $( this ).find('td:nth-child(3) ').text();
		let quantity = $( this ).find('.quantity' ).val();
        let subtotal=$( this ).find('td:nth-child(5)').text();
		
		let purchases = {
			id_product: id_product,
			name_product: name_product,
			only_price: price_product,
			quantity: quantity,
            total_price: subtotal,

			

		};

		pric.push(purchases);
		//console.log(pric);
	});

	//console.log(prec);


	return pric;

	
	
}

function tobuy()
{
	let valor = true;
        if(!$('#transport').val()) valor = false;
        if(!valor) {
			alerta('error','select transport');
			return;
		};
		let value = <?php echo $sum  +0; ?>+parseFloat($('#price').val());
	let obj = {};
        let objeto = {};
            obj.buyed = value;
            objeto = {'data':obj};
			//console.log(value)
	$.ajax({
            url: "../php/wallet-user.php",
            data: objeto,
            type:'post',
            success: function(result){
                result = JSON.parse(result);
                if(result == 'vacio'){
                        alerta('error','Empty table');
                    }else{
                        if(result == 'no'){
                        alerta('error','The amount exceeds your wallet');
                    }else{
                        $('#wallet-user').text(result+' $')
                        $('#addtocart').text(0)
                        alerta('success','Procesado');
						submit();

                    }
                }
            }
        });
	

}

function submit()
{
	let id =<?php echo($_SESSION['id']);?>; 
	let price = bill();
	let data = {};
	data.pricetransport = $('#price').val();
	data.totalbill = $('#total').val();

	let _data = {'data':data, 'price':price ,'id':id};
	$.ajax(
	{
		type:"POST",
		data: _data,
		url:'../../php/CRUD/buy.php',
		beforeSend: function(guardando){
			alerta("envio","Creando Lista");
		},
		success: function(guardado){
			alerta("success","Lista Creada Correctamente");
		},
		error: function(error){
			alerta('error',"Error, The server does not respond " + error);
		},
	}).done(function (result)
	{
	//console.log(result);
	});	
	$('#nexto').click();
	$("#example").dataTable().fnClearTable();
	$('#example_length,#example_filter,#example_info,#example_paginate').remove();
			
}
$('#examp tr').change(function()
    {
        let num1= $( this ).find('.quantity').val();
        let num2 = $( this ).find('td:nth-child(3)').text();
        let result;

        result = num1*num2;
        $( this ).find('td:nth-child(5)').text(result);

    });
</script>