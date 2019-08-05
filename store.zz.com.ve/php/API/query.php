<?php
	class query
	{
		private $temp = "";
		
		public function select($campos = [] ,$tablas,$where = "")
		{
			include "connection.php";
			$Fcampos = "";
			foreach($campos as $indice=>$valor)
			{
				$Fcampos .= $valor.",";
			}
			$Fcampos = substr($Fcampos, 0, -1);
		    //return "select ".$Fcampos." from ".$tablas." ".$where;
			$stmt = $mysqli->prepare("select ".$Fcampos." from ".$tablas." ".$where);
			$stmt->execute();
			
			$result = $stmt->get_result();
			$resultado = array();
			while($data = $result->fetch_assoc())
			{
				if(!is_object($data))
				{
					$resultado[] = (array)$data;
				}
			}
			$stmt->close();
			return $resultado;
		}

	


		
		public function insert($camp,$tabla)
		{
			include "connection.php";
			$columnas = "";
			$Fcampos = "";
			foreach($camp as $indice => $valor)
			{
				if(!is_object($valor))
				{
					$columnas .= "".$indice.",";
					if(is_string($valor))
					{
						$Fcampos .= "'".$valor."',";
					}
					else
					{
						$Fcampos .= "".$valor.",";
					}
				}
			}
			$columnas = substr($columnas, 0, -1);
			$Fcampos = substr($Fcampos, 0, -1);
			// return"insert into ".$tabla."(".$columnas.") values (".$Fcampos.")";
			$stmt = $mysqli->prepare("insert into ".$tabla."(".$columnas.") values (".$Fcampos.")");
			if($stmt->execute())
			{
				return true;
			}
			else
			{
				if(!empty($stmt->error)){
					echo $stmt->error;
				}
			};
			$mysqli->close();
		}




		public function update($data = [],$tabla,$id)
		{
			include "connection.php";
			$datos = "";
			$last = end($data);
			
			foreach($data as $indice => $valor)
			{
				$dato = "";
				if(is_numeric($valor))
				{
					$dato = "".$valor."";
				}
				else
				{
					$dato = "'".$valor."'";
				}
				$datos .= "".$indice." = ".$dato;
				
					$datos .= ",";
				
			}
			$datos = substr($datos, 0, -1);
			// echo($datos);
			 echo "update ".$tabla." set ".$datos." where DID = ".$id;
			$stmt = $mysqli->prepare("update ".$tabla." set ".$datos." ".$id);
			if($stmt->execute())
			{
				return true;
			}
			else
			{
				return $mysqli->error();
			};
			$mysqli->close();
		}



		//////////////////////////////////////////////////////////////////////////
		
		public function elim($id,$tabla)
		{
			include "connection.php";
			$stmt = $mysqli->prepare("delete from ".$tabla." where ID = ".$id);
			if($stmt->execute())
			{
				return true;
			}
			else
			{
				return $mysqli->error;
			};
			$mysqli->close();
		}
		
		public function if_exist($dato,$tabla)
		{
			include "connection.php";
			$eval = "";
			foreach($dato as $indice => $valor)
			{
				if(!is_object($valor))
				{
					if(is_numeric($valor))
					{
						$eval .= $indice." = ".$valor." AND ";
					}
					else
					{
						$eval .= $indice." = '".$valor."' AND ";
					}
				}
			}
			
			$eval= preg_replace('/\W\w+\s*(\W*)$/', '$1', $eval);
			//echo "select * from ".$tabla." where ".$eval;
			$stmt = $mysqli->prepare("select * from ".$tabla." where ".$eval);
			if($stmt->execute())
			{
				$cont = 0;
				while($stmt->fetch())
				{
					$cont++;
				}
				$mysqli->close();
				if($cont > 0){
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return $mysqli->error;
			};	
		}
	

		public function avg ($id)
		{
			
			include "connection.php";

			$stmt = $mysqli->prepare("select AVG (classify) from category WHERE product=".$id);
			$stmt->execute();

			$result = $stmt->get_result();
			$resultado ;
			while($data = $result->fetch_assoc())
			{
				if(!is_object($data))
				{
					$resultado[] = (array)$data;
				}
			}
			$stmt->close();
			return $resultado;
		}






	};
?>
