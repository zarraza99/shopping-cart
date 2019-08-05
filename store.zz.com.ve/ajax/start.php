<?php 
	error_reporting(E_ALL);
    ini_set('display_errors', '1');
    include "../php/API/query.php";
    $query = new query();
    session_start();
    $temp = (array) $query->select(array("*"),"product");

    echo "
    <div class='row'>
	<div class='col-md-12'>";
            foreach($temp as $index => $value)
            {
              $clasf = $query->avg($value['id']);
            
                echo "<div class='col-md-6 '><div class='card' style=' border: 2px solid #17C533; width: 50rem;margin:auto;margin-bottom:5rem;'>
                <img class='card-img-top' src='../{$value['img']}' alt='Card image cap' style='width:100%'>
                <div class='card-body' style='border-top:2px solid #17C533'>
                  <h4 style='font-weight:bold;text-align:center' class='card-title'>".$value['name']."</h4>
                  <p style='padding:0px 10px;text-align:justify' class='card-text'>".$value['description']."</p>
                  <p class='card-text'><span style='margin-left:10px;color:#000;padding:2px;border-radius:0px 2px 2px 0px'>Price ".$value['price']." $</span>   <i id='clasf' style='font-size:10px;background:#333;color:#fff;border-radius:50%;padding:5px 10px' > ".$clasf[0]['AVG (classify)']. " <i class='icon-prepend fa fa-star'></i></i></p>
                  <span href='ajax/modal/items.php?id={$value['id']}' data-toggle='modal' data-target='#items' style='width:100%;background:#17C533;border-radius:0px 0px 0px 0px;color:#fff' class='btn'>Open</span>
                </div>
              </div></div>";
            }
    echo "	</div>
    </div>";
    
?>
<div class='modal fade' id='items' tabindex='-1' role='dialog' aria-labelledby='remoteModalLabel' aria-hidden='true'>  
    <div class='modal-dialog modal-lg'>  
        <div class='modal-content'></div>  
    </div>  
</div>


<script>
  

  $('link[href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"]').remove()
  $('link[href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css"]').remove()
  $('script[src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"]').remove()
  $('script[src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"]').remove()
  $('script[src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"]').remove()
</script>

