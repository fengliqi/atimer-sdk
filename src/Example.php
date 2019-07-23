<?php
/**
 * 2019/06/28
 * 更多详情请访问官网文档 https://atimer.cn
 */

namespace atimer;

use atimer\structure\Calendar;
use atimer\structure\Event;
use atimer\structure\Reminder;
use atimer\structure\Time;

/**
 * SDK示例
 * Class Example
 * @package atimer
 */
class Example
{
    /**
     * AtimerSDK 的实例
     * @var AtimerSDK
     */
    protected $atimer = null;

    /**
     * Example constructor.
     * @param array $config
     */
    public function __construct($config)
    {
        $this->atimer = AtimerSDK::getInstance();
        //生成日志log
        $this->atimer->setIsLog(true);
        //设置userCode
        $this->atimer->setUserCode($config['userCode']);
        //设置secret
        $this->atimer->setSecret($config['secret']);
        //设置clientKey
        $this->atimer->setClientKey($config['clientKey']);
        //设置环境
        $this->atimer->setHost($config['host']);
    }

    /**
     * 添加日程
     */
    public function addEvent()
    {
        $eventObj = new Event();
        $eventObj->CalendarId = 'cdf9428df4664b13b6cd1351c9520b3f';
        $eventObj->Summary = '日程标题';
        $eventObj->IsAllDay = true;
        $eventObj->Start = new Time('2019-06-28', true, false);
        $eventObj->End = new Time('2019-06-28', true, true);
        $eventObj->Location->DisplayName = '地址';
        $eventObj->Reminders = [
            new Reminder('popup','480'), new Reminder('popup','720')
        ];

        var_dump($this->atimer->putEvent($eventObj));
    }

    /**
     * 添加日历
     */
    public function putCalendar()
    {
        $calendar = new Calendar();
        $calendar->CalendarName = '示范日历';
        var_dump($this->atimer->putCalendar($calendar));
    }
}
