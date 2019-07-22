<?php

namespace atimer\structure;


/**
 * 事件所在地点
 * Class Location
 * @package atimer\structure
 */
class Location
{
    /**
     * 显示名称
     * @var string
     */
    public $DisplayName;

    /**
     * 地址
     * @var string
     */
    public $Address;

    /**
     * 城市
     * @var string
     */
    public $City;

    /**
     * 国家地区
     * @var string
     */
    public $CountryOrRegion;

    /**
     * 邮政编码
     * @var string
     */
    public $PostalCode;

    /**
     * 省、州
     * @var string
     */
    public $State;

    /**
     * 街道
     * @var string
     */
    public $Street;

    /**
     * 邮件地址
     * @var string
     */
    public $LocationEmailAddress;

    /**
     * 经度
     * @var float
     */
    public $Longitude;

    /**
     * 维度
     * @var float
     */
    public $Latitude;
}
