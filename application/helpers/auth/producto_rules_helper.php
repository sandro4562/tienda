<?php
function getProductoRules(){
	return array(
		array(
			'field' => 'nombre',
			'label' => 'nombre',
			'rules' => 'required|trim',
			'errors' => array(
				'required'=> 'El %s es obligatorio.'
			),
		),
	 );
} 
