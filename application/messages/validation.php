<?php defined('SYSPATH') OR die('No direct script access.');

return array(

	'alpha'         => ':field must contain only letters',
	'alpha_dash'    => ':field must contain only numbers, letters and dashes',
	'alpha_numeric' => ':field must contain only letters and numbers',
	'captcha'       => 'Вы ввели неправильный ответ на контрольный вопрос',
	'color'         => 'Поле :field должно быть цветом',
	'credit_card'   => ':field must be a credit card number',
	'date'          => 'Поле :field должно быть датой',
	'decimal'       => ':field must be a decimal with :param2 places',
	'digit'         => ':field must be a digit',
	'email'         => 'Поле :field должно быть E-mail адресом',
	'email_domain'  => ':field must contain a valid email domain',
	'equals'        => ':field must equal :param2',
	'exact_length'  => ':field must be exactly :param2 characters long',
	'image'         => array(
		'Upload::size'   => 'Файл превышает максимально допустимый размер',
		'Upload::image'  => 'Файл не является изображением, либо имеет неправильные размеры'
	),
	'in_array'      => ':field must be one of the available options',
	'ip'            => 'Поле :field должно быть IP адресом',
	'is_date'       => 'Вы не ввели год, месяц или день',
	'matches'       => 'Поле :field должно быть таким же как поле :param3',
	'min_length'    => 'Поле :field должно содержаь не меньше :param2 символов',
	'max_length'    => 'Поле :field не должно превышать :param2 символов',
	'not_empty'     => 'Поле :field не должно быть пустым',
	'numeric'       => ':field must be numeric',
	'phone'         => 'Поле :field должно быть номером телефона',
	'range'         => ':field must be within the range of :param2 to :param3',
	'regex'         => 'Поле :field не соответствует требуемому формату',
	'url'           => 'Поле :field должно быть URL адресом',

);
