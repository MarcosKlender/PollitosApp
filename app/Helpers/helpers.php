<?php

function truncar_peso($peso, $digitos){

	$truncar = 10**$digitos;
	return intval(trim($peso) * $truncar) / $truncar;

}