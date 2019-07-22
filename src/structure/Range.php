<?php

namespace atimer\structure;

/**
 * 事件循环周期的时间范围
 * Class Range
 * @package atimer\structure
 */
class Range
{
    /**
     * 重复范围类型。必填。可选值：
     * endDate: 结束日期,
     * noEnd: 无结束日期,
     * numbered: 从时间开始日期重复计数。
     *
     * @var string
     */
    public $Type;

    /**
     * 事件频率模式执行UTC开始日期。yyyy-MM-dd ,必填。事件第一次执行的日期可能是这个日期，也可能晚于这个日期
     * @var string
     */
    public $StartDate;

    /**
     * 事件频率执模式行UTC结束日期。yyyy-MM-dd ,Type等于endDate时必填
     * @var string
     */
    public $EndDate;

    /**
     * 时区ID
     * @var string
     */
    public $RecurrenceTimeZone;

    /**
     * 事件重复的次数。Type等于numbered时必填
     * @var int
     */
    public $NumberOfOccurrences;
}
