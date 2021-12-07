<?php 


	if($res==="0"){
?>
	<input type="text" class="form-control" id="peso_bruto" name="peso_bruto" required value="" >
<?php

	}elseif($res==="Sin_acceso"){
?>	
	<input type="text" class="form-control" id="peso_bruto" name="peso_bruto" readonly required value=<?php echo $res ?> >
<?php
	}else{
		?>
	<input type="text" class="form-control" id="peso_bruto" name="peso_bruto" readonly required value=<?php echo $res ?> >
<?php

}
?>