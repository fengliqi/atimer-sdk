<?php

namespace atimer;

class AtimerSDK
{
    //沙箱环境地址
    const Base = 'atimer.cn/v1/allinone/';


    //--------------------------------接口路径---------------------
    //创建、更新日历
    const PutCalendar = 'putcalendar';
    //创建、更新事件
    const PutEvent = 'putevent';
    //删除事件
    const DeleteEvent = 'deleteevent';
    //暂停授权
    const Invoke = 'invoke';
    //取消授权
    const Unbind = 'unbind';
    // =================================end==================


    protected $userCode = null;
    protected $clientKey = null;
    protected $secret = null;
    protected $host = null;
    protected $isLog = false;

    protected $now;

    public function __construct()
    {
        $this->now = time();
    }

    public function setConfig($property, $value)
    {
        if (property_exists(self::class, $property)) {
            $this->$property = $value;
        }
    }

    /**
     * curl 请求
     *
     * 注意：根据自己的需求来增加选项
     * @param $url
     * @param $requestDate
     * @param string $type
     * @return bool|string
     */
    protected function curl($url, $requestDate, $type = 'post')
    {
        //初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置为 1 是检查服务器SSL证书中是否存在一个公用名(common name)。译者注：公用名(Common Name)一般来讲就是填写你将要申请SSL证书的域名 (domain)或子域名(sub domain)。 设置成 2，会检查公用名是否存在，并且是否与提供的主机名匹配。 0 为不检查名称。 在生产环境中，这个值应该是 2（默认值
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
        //禁止 cURL 验证对等证书（peer's certificate）。要验证的交换证书可以在 CURLOPT_CAINFO 选项中设置
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');

        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        if ($type == 'post') {
            //设置post方式提交
            curl_setopt($curl, CURLOPT_POST, 1);
            //设置post数据
            curl_setopt($curl, CURLOPT_POSTFIELDS, $requestDate);
        }
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }


    /**
     * 签名
     * */
    protected function sign()
    {
        $res = array(
            'key' => $this->clientKey,
            'secret' => $this->secret,
            'timestamp' => $this->now,
        );
        return md5(http_build_query($res));
    }

    /**
     * 生成Client信息
     *
     * */
    protected function makeClient()
    {
        return array(
            'ClientKey' => $this->clientKey,
            'Timestamp' => $this->now,
            'UserCode' => $this->userCode,
            'Sign' => $this->sign()
        );
    }

    protected function logWrite($url, $request, $response)
    {
        try {
            //写入log中
            $dirPath = __DIR__ . "/logs";
            if (!is_dir($dirPath)) {
                mkdir($dirPath);
            }
            //创建文件夹
            $logDirPath = $dirPath . '/' . date('Ym');
            if (!is_dir($logDirPath)) {
                mkdir($logDirPath);
            }
            $logfilePath = $logDirPath . '/' . date('d') . '.txt';

            $now = date('Y-m-d H:i:s', $this->now);
            $fileStr = "
            
================={$now}start====================
url:{$url}

请求:{$request}

响应：{$response}
=================    end    ====================

        ";
            file_put_contents($logfilePath, $fileStr, FILE_APPEND);
        } catch (\Exception $exception) {

        }
    }

    /**
     * 接口请求
     * @param string $url 请求地址
     * @param array 需要请求除了 Client 其他的参数
     * @return mixed 服务器返回信息
     * */
    protected function uopRequest($url, $param)
    {
        try {
            $url = "https://{$this->host}." . self::Base . $url;
            //组装参数
            $param['Client'] = $this->makeClient();
            $param = json_encode($param);
            //请求
            $result = $this->curl($url, $param);
            //写入日志
            if ($this->isLog) {
                $this->logWrite($url, $param, $result);
            }
            //输出
            try {
                $result = json_decode($result, true);
            } catch (\Exception $exception) {

            }
            return $result;
        } catch (\Exception $exception) {

        }

    }

    /**
     * 创建日历
     * @param array $calendar
     * @return mixed
     */
    public function putCalendar($calendar = array())
    {
        $param = [
            'Calendar' => $calendar
        ];
        //过滤空值参数
        return $this->uopRequest(self::PutCalendar, $param);
    }

    /**
     * 创建日程
     * @param $event
     * @return mixed
     */
    public function putEvent($event)
    {
        $param = [
            'Event' => $event
        ];
        return $this->uopRequest(self::PutEvent, $param);
    }

    /**
     * 删除事件
     * @param $calendarId
     * @param $eventId
     * @return mixed
     */
    public function deleteEvent($calendarId, $eventId)
    {
        $param = [
            'CalendarId' => $calendarId,
            'EventId' => $eventId
        ];
        return $this->uopRequest(self::DeleteEvent, $param);
    }

    /**
     * 暂停授权第三方账号
     * @param $profileId
     * @return mixed
     */
    public function invoke($profileId)
    {
        $param = [
            'User' => [
                'ProfileId' => $profileId,
            ]
        ];
        return $this->uopRequest(self::Invoke, $param);
    }

    /**
     * 查询账号状态
     * @return bool|mixed|string
     */
    public function guest()
    {
        $url = "https://{$this->host}.atimer.cn/channel/guest?clientKey={$this->clientKey}&userCode={$this->userCode}";
        $result = $this->curl($url, '', 'get');
        if ($this->isLog) {
            $this->logWrite($url, '', $result);
        }
        //输出
        try {
            $result = json_decode($result, true);
        } catch (\Exception $exception) {

        }
        return $result;
    }

    /**
     * 解绑第三方账号
     * @param $profileId
     * @param $channelId
     * @return mixed
     */
    public function unbind($profileId, $channelId)
    {
        $param = [
            'User' => [
                'ProfileId' => $profileId,
                'ChannelId' => $channelId
            ]
        ];
        return $this->uopRequest(self::Unbind, $param);
    }
}



