<?php

namespace atimer\structure;

use atimer\Helper;

/**
 * 时间构造
 * Class Time
 * @package atimer\structure
 */
class Time
{
    /**
     * 日期(全天事件中必填)，yyyy-MM-dd
     * @var null|string
     */
    public $Date;

    /**
     * UTC时间(非全天事件必填),2018-01-22T09:12:43.083Z
     * @var string|null
     */
    public $Time;

    /**
     * 时区ID
     * @var string
     */
    public $Tzid;

    /**
     * Time constructor.
     * @param $dateTime
     * @param $isAllDay
     * @param bool $isEnd 全天日程中，如果是end，将要加一天。
     * @param string $tzid
     */
    public function __construct($dateTime = null, $isAllDay = false, $isEnd = false, $tzid = 'UTC')
    {
        if (!empty($dateTime)) {
            if ($isAllDay) {
                if ($isEnd) {
                    $this->Date = Helper::toUtcDate($dateTime, 1);
                } else {
                    $this->Date = Helper::toUtcDate($dateTime);
                }
            } else {
                $this->Time = Helper::toUtcTime($dateTime);
            }
            $this->Tzid = $tzid;
        }
    }
}
