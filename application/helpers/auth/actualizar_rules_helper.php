<?php
function getActualizarRules(){
	return array(
		array(
			'field' => 'nombre',
			'label' => 'nombre',
			'rules' => 'required|min_length[2]|max_length[500]|regex_match[/^[\p{L} ,.]*$/u]',
			'errors' => array(
				'required'=> 'El %s es obligatorio.',
				'min_length' => 'El %s tiene como minimo 2 caracteres',
				'regex_match' => 'El %s no es valido',
				'max_length' => 'El %s tiene como maximo 500 caracteres.'
			),
		),
		array(
			'field' => 'password',
			'label' => 'contraseña',
			'rules' => 'required|trim|max_length[50]|min_length[3]',
			'errors' => array(
				'required'=> 'La %s es obligatorio.',
				'max_length' => 'La %s tiene como maximo 50 caracteres.',
				'min_length' => 'La %s tiene como minimo 3 caracteres.'

			),
		),
	 );
} 
