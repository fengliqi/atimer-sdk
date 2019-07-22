<?php

namespace atimer\structure;

/**
 * Class Pattern
 * @package atimer\structure
 */
class Pattern
{
    /**
     * 循环类型。可选值如下：
     * daily：每天
     * weekly：每周
     * absoluteMonthly：每月指定日期，例如每月10号
     * relativeMonthly：每月相对日期，例如每月第二周星期三
     * absoluteYearly：每年指定日期，例如每年十月一号
     * relativeYearly：每年相对日期，例如每年6月第二个星期天
     *
     * @var string
     */
    public $Type;

    /**
     * 重复间隔(Interval=3，Type=daily：每3天发生一次)。
     * @var int
     */
    public $Interval;

    /**
     * 某月(按年重复)
     * @var int
     */
    public $Month;

    /**
     * 某日(按年/按月重复)
     * @var int
     */
    public $DayOfMonth;

    /**
     * 每周中的几日。枚举值：sunday, monday, tuesday, wednesday, thursday, friday, saturday
     * @var string[]
     */
    public $DaysOfWeek;

    /**
     * 每周开始于某一天。枚举同DaysOfWeek。如果Type是weekly，必填。默认值是sunday
     * @var string
     */
    public $FirstDayOfWeek;

    /**
     * 每月的第几周。枚举：first, second, third, fourth, last。默认值first
     * @var string
     */
    public $Index;
}
