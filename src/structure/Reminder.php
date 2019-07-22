<?php

namespace atimer\structure;

/**
 * 提醒
 * Class Reminder
 * @package atimer\structure
 */
class Reminder
{

    /**
     * 提醒方法。可选值：email 电子邮件；sms 短信；popup 应用界面提醒
     * @var string
     */
    public $Method;

    /**
     * 提前分钟数，最大值40320
     * @var string
     */
    public $Minutes;

    /**
     * 日历的默认提醒是否适用于该事件
     * @var bool
     */
    public $UseDefault;


    /**
     * Reminder constructor.
     * @param string $method
     * @param string $minutes
     * @param bool $useDefault
     */
    public function __construct($method, $minutes, $useDefault = false)
    {
        $this->Method = $method;
        $this->Minutes = $minutes;
        $this->UseDefault = $useDefault;
    }
}
