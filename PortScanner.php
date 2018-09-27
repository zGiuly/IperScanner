<?php
/** Scanner class */

class PortScanner
{
    private $ip;
    /** @inheritdoc Constructor */
    public function __construct($ip)
    {
        $this->ip = $ip;
        unlink("open.txt");
        unlink("closed.txt");
    }
    /** @inheritdoc Scan function */
    public function Scan($min_range, $max_range, $type){
        if(!is_numeric($max_range) or !is_numeric($min_range)){
            return "Empty error";
        }else{
            while($min_range <= $max_range) {
                $socket = @fsockopen($this->ip, $min_range,$errno, $errstr, 2);
                if(is_resource($socket)){
                    file_put_contents("open.txt", "\n $min_range ".getservbyport($min_range, $type), FILE_APPEND);
                }else{
                    file_put_contents("closed.txt", "\n $min_range ".getservbyport($min_range, $type), FILE_APPEND);
                }
                $min_range++;
            }
        }
    }
    /** @inheritdoc Logger */
    public function Logger($text) {
        if(!empty($text)){
            file_put_contents("portscanner.log", $text);
        }
    }
    /** @inheritdoc Json file save */
    public function Json_save($data = []){
        if(!empty($data)){
            file_put_contents("data.json", $data);
        }
    }
}