<?php
return [
    //api
    array('api/users/role', 'pattern' => 'api/users/role/<id:\d+>', 'verb' => 'POST'),
    array('api/messages/deleted', 'pattern' => 'api/messages/deleted/<id:\w+>', 'verb' => 'GET'),
    //def
    '/'=>'users/index',
    'places'=>'content',
    'users/message/<id:\w+>'=>'users/message',
    'messages/<id:\w+>'=>'messages/view',
	'settings/<id:\w+>'=>'settings/view',
	'categories/<id:\w+>'=>'categories/view',
	'shop/<id:\w+>'=>'shop/view',
	'payments/<id:\w+>'=>'payments/view',
    '<controller:\w+>/<id:\d+>'=>'<controller>/view',
    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
  ];
