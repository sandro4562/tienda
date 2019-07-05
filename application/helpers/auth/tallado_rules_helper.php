<?php
function getTalladoRules(){
	return array(
		array(
			'field' => 'costo',
			'label' => 'costo',
			'rules' => 'trim|required|numeric|greater_than[0]',
			'errors' => array(
				'required'=> 'El %s es requerido.',
				'numeric'=> 'El %s es numerico.',
				'greater_than'=> 'El costo es invalido.'
			),
		),
	);
} 
