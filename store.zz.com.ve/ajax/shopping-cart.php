<?php session_start();?>
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
        <?php include "../php/table/table.php" ?>
    </tbody>
   
</table>

<span  onclick="buy()" id="btn1" style='margin-top: 10px;margin-left:25px; background:#17C533;border-radius:0px 2px 0px 0px;color:#fff' class='btn'>Next</span>

<span href='ajax/modal/next.php'  id="nexto" data-toggle='modal' data-target='#next' style='display:none;width:100%;background:#17C533;border-radius:0px 0px 0px 0px;color:#fff' class='btn'>Open</span>

<div class='modal fade' id='next' tabindex='-1' role='dialog' aria-labelledby='remoteModalLabel' aria-hidden='true'>  
    <div class='modal-dialog modal-lg'>  
        <div class='modal-content'></div>  
    </div>  
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
<script>

    $('#examp tr').change(function()
    {
        
        let num1= $( this ).find('.quantity').val();
        let num2 = $( this ).find('td:nth-child(3)').text();
        let result;

        result = num1*num2;
        $( this ).find('td:nth-child(5)').text(result);

        if($( this ).find('.quantity').val() == 0)
        {
            alerta('error','Into one Unit')
            return;
		}
			let obj = {};
			let objeto = {};
				obj.quantity = $( this ).find('.quantity').val();
				obj.total = $( this ).find('td:nth-child(5)').text();
				obj.id = $( this ).find('td:nth-child(1)').text();
				objeto = {'data':obj};
			$.ajax({
				url: "../../php/addtocart.php",
				data: objeto,
				type:'post',
				success: function(result){
					result = JSON.parse(result);
					//console.log(result);
                    
					$('#addtocart').text(result)
					alerta('success','Success add to cart')
                    
				}
			});

    });
    function current()
    {
        
        return new Promise((resolve, reject) => {
            $.ajax({
				url: "../../php/update.php",
				type:'post',
				success: function(result){

                    if(!result){
                        result =0;
                    }
                    else
                     {
                        result = JSON.parse(result);
                        //console.log(result);
                    }
				    
                    resolve(result);
 
				}
			}).fail( function( jqXHR, textStatus, errorThrown ) {
                reject( 'errorThrown' );
            });
        });
        
           
            
                        
    };
    $('#addtocart').change(function()
    {
        value();
    });
   function value()
   {
    let aa = $('#addtocart').text();
        if(aa == 0)
        {
            $('#btn1').css('display','none');
            
            
        }
        else
        {
            $('#btn1').css('display','');
           
        }
   };
   value();

    async function buy()
    {
    
        let r = await current(); 
        let wall = <?php echo $_SESSION['wallet']; ?>;
        let aa = $('#addtocart').text();
         
        
        //console.log(wall);
        //console.log(aa);
        //console.log(r);
        
        if(!r)
        {
            alerta('error','empty table ');
          return; 
        }
        
            if(aa == 0)
            {
                alerta('error','empty table ');
                return;  
            }
            else
            {
                if((wall == 0) || (r > wall))
                {
                    alerta('error','The amount of the purchase exceeds your wallet');
                    return;  
                }
                else
                {
                    $('#nexto').click();
                }
            }
        

       
        
    };

    function deleteun(e)
    {
        
        let obj = {};
			let objeto = {};
                obj.quantity = $(e).parents().eq(1).find('.quantity').val();
				obj.id = $(e).parents().eq(1).find('td:nth-child(1)').text();
				objeto = {'data':obj};
			$.ajax({
				url: "../php/CRUD/delete.php",
				data: objeto,
				type:'post',
				success: function(result){
					result = JSON.parse(result);
					//console.log(result);
                    $('#addtocart').text(result);
                    
					alerta('error',"product removed from your cart");
                    $(e).parents('tr').eq(0).remove();

                    
				}
			});
      

    };
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