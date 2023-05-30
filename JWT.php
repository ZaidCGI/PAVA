<?php
$header=[
    'typ'=>'JWT',
    'alg' => 'HS256'
];

$payload =[
    'user_id' => 123, 
    'rules' => [
        'ROLE_ADMIN',
        'ROLE_USER'
    ]
    ];

$base64Header= base64_encode(json_encode($header));




?>