<input type="number" class="form-control" id="peso_bruto" name="peso_bruto" value=<?php
	$res=json_decode(file_get_contents('http://192.168.0.103/ws.php?opcion=get'),true);
	echo $res;
	?> >