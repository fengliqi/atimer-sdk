<?php
/**
 * 自定义的助手类
 * User: liqi.f@qq.com
 * Date: 2019/1/31
 * Time: 16:40
 */

namespace atimer;

class Helper
{
    /**
     * 将本地时间转为utc格式的时间，2018-01-22T09:12:43.083Z,
     * 仅仅改变时间的显示样式，不改变时间数字
     * @param string $time
     * @return string|null
     * */
    static function toUtcFormat($time)
    {
        $time = trim($time);
        return date('Y-m-d\TH:i:s.0000\Z', strtotime($time));
    }

    /**
     * 将当地时间改为utc 时间，改变时间数字
     * @param string $time
     * @param string $format 显示格式, normal 格式为 Y-m-d H:i:s；format格式为 utc格式
     * @return string|null
     * */
    static function toUtcTime($time, $format = 'normal')
    {
        if ($format == 'format') {
            $format = 'Y-m-d\TH:i:s.0000\Z';
        } else {
            $format = 'Y-m-d H:i:s';
        }
        $timeStamp = strtotime($time);
        $dateZone = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $utcTime = date($format, $timeStamp);
        date_default_timezone_set($dateZone);
        return $utcTime;
    }

    /**
     * 生成UTC时间，时间格式是 Y-m-d
     * @param string $time
     * @param int $addDay
     * @return false|string
     */
    static function toUtcDate($time, $addDay = 0)
    {
        $format = 'Y-m-d';
        $timeStamp = strtotime($time) + $addDay * 86400;
        $dateZone = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $utcTime = date($format, $timeStamp);
        date_default_timezone_set($dateZone);
        return $utcTime ? $utcTime : null;
    }

    /**
     * 生成Y-m-d 的时间格式
     * @param $time
     * @param int $addDay
     * @param string $timeZone
     * @return false|string|null
     */
    static function toDate($time, $addDay = 0, $timeZone = '')
    {
        $format = 'Y-m-d';
        if (empty($timeZone)) {
            $timeStamp = strtotime($time) + $addDay * 86400;
            $utcTime = date($format, $timeStamp);
        } else {
            $timeStamp = strtotime($time) + $addDay * 86400;
            $dateZone = date_default_timezone_get();
            date_default_timezone_set($timeZone);
            $utcTime = date($format, $timeStamp);
            date_default_timezone_set($dateZone);
        }
        return $utcTime ? $utcTime : null;
    }
}



