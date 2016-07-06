<?php

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'import'=>array(
		'application.models.*',
		'application.components.*',
	),
    'defaultController'=>'site',
	'components'=>array(
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'game/guess/<g:\w>'=>'game/guess',
			),
		),
        'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=tag',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
			'tablePrefix' => 'hel_',
		),
	),
);