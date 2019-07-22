<?php
namespace atimer\structure;

/**
 * 事件循环周期。如果是循环类型的事件必填，非重复事件则为null
 * Class Recurrence
 * @package atimer\structure
 */
class Recurrence
{
    /**
     * 事件频率
     * @var Pattern
     */
    public $Pattern;

    /**
     * 事件循环周期的时间范围
     * @var Range
     */
    public $Range;
}
