<?php defined('SYSPATH') OR die('No direct script access.');

class Captcha {

    /**
     * Generate the arithmetic task
     *
     * @param   int    $min  minimum value
     * @param   int    $max  maximum value
     * @return  array
     */
    public static function arithmetic_task($min = 1, $max = 15)
    {
        $operators = array('+', '-');

        $operator = $operators[array_rand($operators)];
        $number_1 = rand($min, $max);
        $number_2 = rand($min, $max);

        $result = array(
            'task'   => '',
            'answer' => '',
        );

        $task = $number_1 . ' ' . $operator . ' ' . $number_2;

        $result['task'] = $task . ' =';
        $result['answer'] = eval('return ' . $task . ';');

        $session = Session::instance();
        $session->set('answer', $result['answer']);

        return $result['task'];
    }
}
