<?php
function getLoginRules(){
	return array(
		array(
			'field' => 'form-username',
			'label' => 'correo electronico',
			'rules' => 'required|trim|valid_email',
			'errors' => array(
				'required'=> 'El %s es requerido.',
				'valid_email'=> 'El %s no es valido.'
			),
		),
		array(
			'field' => 'form-password',
			'label' => 'contraseña',
			'rules' => 'required|trim',
			'errors' => array(
				'required'=> 'La %s es requerida.',
			),
		),
	 );
} 
