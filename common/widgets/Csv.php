<?php
/**
 * from:原创-如有雷同纯属偶然
 * Created by DaiLinLin dailinlin@7477.com.
 * class: CSV操作类
 * Date: 2016/12/16
 * Time: 21:02
 * Url: http://www.yii-china.com/post/detail/474.html
 */

namespace common\widgets;


class Csv
{
    private $config = array(
        'startRow'              =>  0,      //开始读取数据的行数
        'startColumn'           =>  0,      //开始读取数据的列数
        'maxLine'               =>  500,    //允许读取数据的最大行数
        'keys'                  =>  array(), //返回以keys的下标数组
        'trim'                  =>  false,   //实现双引号保留素材
        'header'                =>  array()  //头部
    );

    private $error = ''; //错误信息
    private $php_low=false;//判断是否是5.3低版本


    /**
     * 构造方法，用于构造CSV操作实例
     * @param array $config
     */
    public function __construct($config = array()){
        /* 获取配置 */
        $this->config   =   array_merge($this->config, $config);
        if(version_compare(PHP_VERSION,'5.4.0','<')){
            $php_low = true;
        }
    }

    /**
     * 使用 $this->name 获取配置
     * @param  string $name 配置名称
     * @return multitype    配置值
     */
    public function __get($name) {
        return $this->config[$name];
    }

    public function __set($name,$value){
        if(isset($this->config[$name])) {
            $this->config[$name] = $value;
        }
    }

    public function __isset($name){
        return isset($this->config[$name]);
    }

    /**
     * 返回错误信息
     * @return string
     */
    public function getError(){
        return $this->error;
    }

    /**
     * 读取单文件文件csv内容
     * @param $file
     * @return array|bool
     */
    public function importCSVOne($file){
        return $this->importCSV(array($file));
    }

    /**
     * 读取上传文件csv内容
     * @param string $files
     * @return array|bool
     */
    public function importCSV($files=''){
        if('' === $files){
            $files  =   $_FILES;
        }

        if(empty($files)){
            $this->error = '没有上传的文件！';
            return false;
        }

        foreach($files as $item){
            $exp = explode('.',$item['name']);
            if($exp[1]!='csv'){
                $this->error = '文件格式错误！';
                return false;
            }
        }

        $count = array();
        foreach($files as $item){
            $handle = fopen($item['tmp_name'],"r");
            $count = array_merge($count,$this->readHandleCSV($handle));
        }

        return $count;

    }

    /**
     * 读取存在路径文件的csv内容
     * @param $path
     * @return array|bool
     */
    public function readCSV($path){
        if(!file_exists($path)){
            $this->error = '文件路径不存在';
            return false;
        }
        $handle = fopen($path,"r");
        return $this->readHandleCSV($handle);
    }

    /**
     * 读取文件句柄csv内容
     * @param $handle
     * @return array
     */
    public function readHandleCSV($handle) {
        $out = array ();
        $n = 0;
        while ($data =$this->_fgetcsv($handle, $this->maxLine)) {

            //开始读取的行数
            if($n<$this->startRow){
                $n ++;
                continue;
            }

            //存在返回key的以key数组长度为一行长度
            $num = empty($this->keys)?count($data):count($this->keys);
            for ($i = $this->startColumn; $i < $num; $i++) {

                //没有key设置的放回数字下标数组
                $key = empty($this->keys[$i])?$i:$this->keys[$i];
                $data[$i] = $this->trim?trim($data[$i],"'"):$data[$i];

                $fileType = mb_detect_encoding($data[$i] , array("ASCII",'UTF-8',"GB2312","GBK"));

                if($fileType == 'EUC-CN'){
                    $out[$n][$key] = iconv('GBK', 'utf-8', $data[$i]);
                }else{
                    $out[$n][$key] = $data[$i];
                }
            }
            $n++;
        }

        //关闭文件句柄
        @fclose($handle);
        return $out;
    }


    /**
     *  写csv文件
     * @param $path
     * @param $savename
     * @param $data
     */
    public function writeCSV($path,$savename,$data){

        if(!file_exists($path)){
            mkdir($path);
        }

        $file = fopen($path.'/'.$savename, 'w');
        if(!empty($this->header)){
            fputcsv($file,$this->header);
        }

        foreach($data as $value){
            fputcsv($file,$value);
        }
        fclose($file);
    }

    public function writeCSVDown($savename,$data){
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=".$savename);
        header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header('Expires:0');
        header('Pragma:public');
        $out = "";

        if(!empty($this->header)){
            $i = 0;
            foreach($this->header as $k => $value){
                $out .= $i?",".$value:$value;
                $i++;
            }
            $out .="\n";
        }

        foreach($data as $item){
            $i = 0;
            foreach($item as $k => $value){
                $out .= $i?",".$value:$value;
                $i++;
            }
            $out .="\n";
        }

      
        $fileType = mb_detect_encoding($out, array("ASCII",'UTF-8',"GB2312","GBK"));
        
        if($fileType != 'GBK'){
           $out = iconv($fileType, 'GBK//IGNORE', $out);
        }
        

        echo $out;
    }

    /**
     * 读取csv文件php5.3不兼容问题
     * @param $handle
     * @param null $length
     * @param string $d
     * @param string $e
     * @return bool
     */
    private function _fgetcsv(& $handle, $length = null, $d = ',', $e = '"') {
        if($this->php_low){
            $d = preg_quote($d);
            $e = preg_quote($e);
            $_line = "";
            $eof=false;
            while ($eof != true) {
                $_line .= (empty ($length) ? fgets($handle) : fgets($handle, $length));
                $itemcnt = preg_match_all('/' . $e . '/', $_line, $dummy);
                if ($itemcnt % 2 == 0)
                    $eof = true;
            }
            $_csv_line = preg_replace('/(?: |[ ])?$/', $d, trim($_line));
            $_csv_pattern = '/(' . $e . '[^' . $e . ']*(?:' . $e . $e . '[^' . $e . ']*)*' . $e . '|[^' . $d . ']*)' . $d . '/';
            preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
            $_csv_data = $_csv_matches[1];
            for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++) {
                $_csv_data[$_csv_i] = preg_replace('/^' . $e . '(.*)' . $e . '$/s', '$1' , $_csv_data[$_csv_i]);
                $_csv_data[$_csv_i] = str_replace($e . $e, $e, $_csv_data[$_csv_i]);
            }
            return empty ($_line) ? false : $_csv_data;
        }else{
            return fgetcsv($handle,$length);
        }
    }

}