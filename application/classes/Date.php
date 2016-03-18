<?php defined('SYSPATH') OR die('No direct script access.');

class Date extends Kohana_Date {

    /**
     * Replace the english name of the month to the russian.
     *
     * @param   string  $date  date string
     * @return  mixed
     */
//    public static function russian_months($date)
//    {
//        $eng_months = Date::months(Date::MONTHS_LONG);
//
//        $rus_months = array(
//            1 => 'января',
//            2 => 'февраля',
//            3 => 'марта',
//            4 => 'апреля',
//            5 => 'мая',
//            6 => 'июня',
//            7 => 'июля',
//            8 => 'августа',
//            9 => 'сентября',
//            10 => 'октября',
//            11 => 'ноября',
//            12 => 'декабря',
//        );
//
//        $date = str_replace($eng_months, $rus_months, $date);
//
//        return $date;
//    }

    public static function rus_date_format($date)
    {
        $str_date = strftime('%H:%M, %d %B %Y', strtotime($date));

        $eng_months = Date::months(Date::MONTHS_LONG);

        $rus_months = array(
            1 => 'января',
            2 => 'февраля',
            3 => 'марта',
            4 => 'апреля',
            5 => 'мая',
            6 => 'июня',
            7 => 'июля',
            8 => 'августа',
            9 => 'сентября',
            10 => 'октября',
            11 => 'ноября',
            12 => 'декабря',
        );

        $str_date = str_replace($eng_months, $rus_months, $str_date);

        return $str_date;
    }

    /**
     * Return an array of the Russian names of the months.
     *
     * @return  array
     */
    public static function rus_months()
    {
        return array(
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        );
    }
}
