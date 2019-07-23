<?php

namespace atimer\structure;

/**
 * 事件
 * Class Event
 * @package atimer\structure
 */
class Event
{
    /**
     * 日历ID。(创建事件无主题日历时，不用传或者传空字符串)
     * @var string
     */
    public $CalendarId;

    /**
     * 事件ID。修改时必填
     * @var string
     */
    public $EventId;

    /**
     * 事件标题
     * @var string
     */
    public $Summary;

    /**
     * 事件内容
     * @var string
     */
    public $Description;

    /**
     * 是否全天事件。默认false
     * @var bool
     */
    public $IsAllDay;

    /**
     * 开始时间
     * @var Time
     */
    public $Start;

    /**
     * 事件结束时间
     * @var Time
     */
    public $End;

    /**
     * 事件循环周期。如果是循环类型的事件必填，非重复事件则为null
     * @var Recurrence
     */
    public $Recurrence;

    /**
     * 事件所在地点
     * @var Location
     */
    public $Location;

    /**
     * 提醒。可设置提前多时段提醒
     * @var Reminder[]
     */
    public $Reminders;

    /**
     * 事件类别
     * @var string[]
     */
    public $Categories;

    /**
     * 事件链接
     * @var string
     */
    public $WebLink;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->Start = new Time();
        $this->End = new Time();
        $this->Recurrence = new Recurrence();
        $this->Location = new Location();
    }
}
