<?php
/**
 * 2019/06/28
 * 更多详情请访问官网文档 https://atimer.cn
 */

namespace atimer;

class Example
{
    protected $atimer = null;

    public function __construct()
    {
        $this->atimer = new AtimerSDK();
        //生成日志log
        $this->atimer->setConfig('isLog', true);
        //设置userCode
        $this->atimer->setConfig('userCode', 'test');
        //设置secret
        $this->atimer->setConfig('secret', '*******');
        //设置clientKey
        $this->atimer->setConfig('clientKey', '***********');
        //设置环境
        $this->atimer->setConfig('host', 'open');
    }

    public function addEvent()
    {
        $eventParam = [
            'CalendarId' => '日历id',
            'Summary' => '日程标题',
            'IsAllDay' => true, //是否是全天事件
            //当IsAllDay 为true,start 和 end 只需要传递Date参数，并且End的Date要加一天。如果IsAllDay为false，Start和End
            //参数需要传递Time参数，并且转为UTC时间。
            'Start' => [
                'Date' => Helper::toDate('2019-06-28'),
                //'Time' => Helper::toUtcTime('2019-06-28 12:00:00'),
                'Tzid' => 'UTC'
            ],
            'End' => [
                'Date' => Helper::toDate('2019-06-28', 1),
                //'Time' => Helper::toUtcTime('2019-06-28 13:00:00'),
                'Tzid' => 'UTC'
            ],
            //地址
            'Location' => [
                'DisplayName' => '地址'
            ],
            //提醒
            'Reminders' => [
                [
                    'Method' => 'popup',
                    'Minutes' => '480',
                    'UseDefault' => false,
                ]
            ]
        ];

        var_dump($this->atimer->putEvent($eventParam));
    }

    public function putCalendar()
    {
        $calendarParam = [
            'CalendarName' => '日历名称',
        ];
        var_dump($this->atimer->putCalendar($calendarParam));
    }


}