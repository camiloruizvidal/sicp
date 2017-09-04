
<?php

class ayudante 
{
	public function identificar_limite_i($datos_variables_tarjeta_familiar)
	{
		for ($i=0; $i <count($datos_variables_tarjeta_familiar) ; $i++) { 
 $descripcion=$datos_variables_tarjeta_familiar[$i]['descripcion'];
 			if($descripcion=="Iluminación adecuada")
			{
               $limite=$i-1;
               $i=count($datos_variables_tarjeta_familiar);
			}
			
			
		                                                              }

    return $limite;   

	}

	public function identificar_limite_ii($datos_variables_tarjeta_familiar)
	{
		for ($i=0; $i <count($datos_variables_tarjeta_familiar) ; $i++) { 
 $descripcion=$datos_variables_tarjeta_familiar[$i]['descripcion'];
 			if($descripcion=="Con letrina pero alguien no la usa")
			   {
               $limite=array("exite"=>true,"valor"=>$i-1);
               $i=count($datos_variables_tarjeta_familiar);
			   }
			   else
			   {
			   	$limite=array("exite"=>false,"valor"=>count($datos_variables_tarjeta_familiar)-1);
			   }
			
			
		                                                              }

    return $limite;   

	}

	

}

?>