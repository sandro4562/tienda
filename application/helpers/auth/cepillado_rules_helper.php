<?php
function getCepilladoRules(){
	return array(
		array(
			'field' => 'costo',
			'label' => 'costo',
			'rules' => 'required|trim|numeric|greater_than[0]',
			'errors' => array(
				'required'=> 'El %s es obligatorio.',
				'numeric'=> 'El %s tiene que ser numerico.',
				'greater_than'=> 'El costo es invalido.'
			),
		),
	 );
} 
