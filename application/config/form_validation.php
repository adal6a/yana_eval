<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config = [
    'user_store' => [
        [
            'field' => 'email',
            'rules' => 'trim|required|valid_email|is_unique[users.email]'
        ],
        [
            'field' => 'password',
            'rules' => 'required|min_length[8]'
        ],
    ]
];
