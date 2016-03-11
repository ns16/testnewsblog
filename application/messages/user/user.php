<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
    'username' => array(
        'unique' => 'Такое Имя пользователя уже существует',
    ),
    'email'    => array(
        'unique' => 'Такой E-mail уже существует',
    ),
);
