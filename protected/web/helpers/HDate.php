<?php

/**
 * Helper для дат
 *
 * @package helpers
 * @author Dmitriy Neshin
 */
class HDate
{
    /**
     * Получение русскоязычного месяца из числа
     *
     * @author Dmitriy Neshin
     */
    public static function ruMonth($n)
    {
        $months = array(
            1 => "Январь",
            2 => "Февраль",
            3 => "Март",
            4 => "Апрель",
            5 => "Май",
            6 => "Июнь",
            7 => "Июль",
            8 => "Август",
            9 => "Сентябрь",
            10 => "Октябрь",
            11 => "Ноябрь",
            12 => "Декабрь",
        );

        return $months[$n];
    }

    public static function ruNumToDay($n, $short=true, $usFormat=false) {
        if ($short == true) {
            $days = array(
                1 => 'Пн',
                2 => 'Вт',
                3 => 'Ср',
                4 => 'Чт',
                5 => 'Пт',
                6 => 'Сб',
                7 => 'Вс',
            );
        } else {
            $days = array(
                1 => 'Понедельник',
                2 => 'Вторник',
                3 => 'Среда',
                4 => 'Четверг',
                5 => 'Пятница',
                6 => 'Суббота',
                7 => 'Воскресенье',
            );
        }

        if ($usFormat == true) {
            $n = $n-1;
            if ($n == 0) {
                $n = 7;
            }
        }

        return $days[$n];
    }

    public static function InitDeliveryTime(){
        $time = date('G.i', strtotime("+60 minutes"));
        //round it
        $time[strlen($time)-1] = '0';

        return $time;
    }

    public static function GetStatDates($start_date = null, $end_date = null)
    {
        $end_date = trim($end_date);
        if (isset($start_date)) {
            $startTime = strtotime($start_date);
            if ($startTime < strtotime(date('Y-m-d'))) {
                if (isset($end_date) && !empty($end_date))
                    $endTime = strtotime($end_date);
                else
                    $endTime = strtotime(date('Y-m-d'));

                if ($endTime > strtotime(date('Y-m-d'))) {
                    $endTime = strtotime(date('Y-m-d'));
                }

                if ($endTime >= $startTime) {
                    return array($startTime, $endTime);
                }
            }
        }
        $endTime = strtotime(date('Y-m-d'));
        $startTime = strtotime('-29 days', $endTime);

        return array($startTime, $endTime);
    }
}
