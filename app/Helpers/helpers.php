<?php

function truncar_peso($peso, $digitos){

	$truncar = 10**$digitos;
	return intval($peso * $truncar) / $truncar;

}