<?php

namespace atimer\structure;

/**
 * Class Calendar
 * @package atimer\structure
 */
class Calendar
{
    /**
     * 日历ID。修改时必填，新建时该字段由有空日程云或第三方渠道自动生成。
     * @var string
     */
    public $CalendarId;

    /**
     * 日历名称，在有空日程云平台又称为主题名称
     * @var string
     */
    public $CalendarName;

    /**
     * 日历所属平台标识ID。
     *   要获取到该参数：1、绑定第三方渠道帐户；2、guest接口返回
     * @var string
     */
    public $ProfileId;

    /**
     * 日历是否只读
     * @var bool
     */
    public $CalendarReadonly;

    /**
     * 是否是主日历
     * @var bool
     */
    public $CalendarPrimary;

    /**
     * 是否公开
     * @var bool
     */
    public $IsPublic;

    /**
     * 标签
     * @var string
     */
    public $Tags;

    /**
     * 日历图标
     * @var string
     */
    public $CalendarIcon;

    /**
     * 日历颜色
     * @var string
     */
    public $CalendarColor;
}
