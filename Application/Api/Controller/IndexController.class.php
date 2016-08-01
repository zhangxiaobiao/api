<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function createJson()
    {
        $personArr = array(
            'name' => 'tom',
            'age'  => '18',
            'job'  => 'php',
        );
        $personJson = json_encode($personArr);
        echo $personJson;
    }
    //json字符串转化为对象或者数据
    public function jsonToArrayOrObj()
    {
        $personJson = '{"name":"tom","age":"18","job":"php"}';
        $personObj = json_decode($personJson);
        dump($personObj);
        $personArr = json_decode($personJson, true);
        dump($personArr);
    }
    public function testUrl()
    {
        $url = 'http://www.baidu.com';
        $content = $this->request($url);
        file_put_contents('./baidu.html', $content);
    }
    public function weather()
    {
        $city = '焦作';
        $url = "http://api.map.baidu.com/telematics/v3/weather?location={$city}&output=XML&ak=FK9mkfdQsloEngodbFl4FeY3";
        $content = request($url, false);
        $contentobj = simplexml_load_string($content);
        //dump($contentobj);
        $todayobj = $contentobj->results->weather_data->date;
        $picobj = $contentobj->results->weather_data->dayPictureUrl;
        $weatherobj = $contentobj->results->weather_data->weather;
        $windobj = $contentobj->results->weather_data->wind;
        $temperatureobj = $contentobj->results->weather_data->temperature;
        $indexobj = $contentobj->results->index;
        $contentStr = "{$city}\n{$todayobj}\n<img src='{$picobj}'>\n{$weatherobj}\n{$windobj}\n{$temperatureobj}";
        echo $contentStr;
        foreach ($indexobj as $key => $value) {
            foreach ($value as $key1 => $value1) {
                echo $value1 . "\n";

            }
        }
    }
    public function index()
    {
        $this->display();
    }
    public function phoneAddr()
    {
        $num = I('get.num');
        $url = "http://cx.shouji.360.cn/phonearea.php?number=".$num;
        $content = request($url, false);
        $content = json_decode($content);
        $str = '省份:' . $content->data->province . '<br />';
        $str .= '城市:' . $content->data->city . '<br />';
        $str .= '运营商:' . $content->data->sp . '<br />';
        echo json_encode($str);
    }
}