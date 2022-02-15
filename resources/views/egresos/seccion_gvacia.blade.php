<?php 


	if($res==="0"){
?>
	<input type="text" class="form-control" id="peso_gavetas_vacias" name="peso_gavetas_vacias" required value="" >
<?php

	}elseif($res==="Sin_acceso"){
?>	
	<input type="text" class="form-control" id="peso_gavetas_vacias" name="peso_gavetas_vacias" readonly required value=<?php echo $res ?> >
<?php
	}else{
		?>
	<input type="text" class="form-control" id="peso_gavetas_vacias" name="peso_gavetas_vacias" readonly required value=<?php echo $res ?> >
<?php

}
?>