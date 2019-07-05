<?php
function getRegisterRules(){
	return array(
		array(
			'field' => 'nombre',
			'label' => 'nombre',
			'rules' => 'required|min_length[2]|max_length[500]|regex_match[/^[\p{L} ,.]*$/u]',
			'errors' => array(
				'required'=> 'El %s es obligatorio.',
				'valid_email'=> 'El %s no es valido.',
				'min_length' => 'El %s tiene como minimo 2 caracteres',
				'regex_match' => 'El %s no es valido',
				'max_length' => 'El %s tiene como maximo 500 caracteres.'
			),
		),
		array(
			'field' => 'correo',
			'label' => 'correo',
			'rules' => 'required|trim|valid_email|is_unique[user.correo]',
			'errors' => array(
				'required'=> 'El %s es obligatorio.',
				'valid_email' => 'El %s no es valido',
				'is_unique' => 'El %s ya existe'

			),
		),
		array(
			'field' => 'password',
			'label' => 'contraseña',
			'rules' => 'required|trim|max_length[50]|min_length[3]',
			'errors' => array(
				'required'=> 'La %s es obligatoria.',
				'max_length' => 'La %s tiene como maximo 50 caracteres.',
				'min_length' => 'La %s tiene como minimo 3 caracteres.'

			),
		),
		
	 );
} 
