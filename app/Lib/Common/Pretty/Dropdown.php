<?php namespace Trihtm\Pretty;

class Dropdown
{
    public static function buildYear($formName = '', $selected = '', $extra = '')
    {
        $years      = range(date("Y"),1900);
        $year_list  = array();
        $year_list[0] = 'Năm';

        foreach($years as $year)
        {
            $year_list[$year] = $year;
        }

        return $year_list;
    }

    /*
     * buildMonth
     *
     * @access public
     * @param  string
     * @param  string
     * @return string
     */
    public static function buildMonth($formName = '', $selected = '', $extra = '')
    {
        $months      = range(1,12);
        $month_list  = array();
        $month_list[0] = 'Tháng';

        foreach($months as $month)
        {
            $month_list[$month] = $month;
        }

        return $month_list;
    }

    /*
     * buildDay
     *
     * @access public
     * @param  string
     * @param  string
     * @return string
     */
    public static function buildDay($formName = '', $selected = '', $extra = '')
    {
        $days      = range(1,31);
        $day_list  = array();
        $day_list[0] = 'Ngày';

        foreach($days as $day)
        {
            $day_list[$day] = $day;
        }

        return $day_list;
    }
}