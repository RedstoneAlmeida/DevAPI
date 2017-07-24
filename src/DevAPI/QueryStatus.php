<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DevAPI;

/**
 * Description of QueryStatus
 *
 * @author ASUS
 */
class QueryStatus {
    
    public static $online = true;
    
    public $type;

    public $webtype;

    // $query = new QueryStatus("pe.lbsg.net:19132");
    // Server::getInstance()->getLogger()->info($query->getServerInformation());
    public function __construct($ip, $website = "https://mcapi.ca/query/") {
        if($ip == null){
            $ip = "pe.lbsg.net:19132";
        }
        $this->type = "mcpe";
        $this->webtype = self::getURL($website . $ip . "/" . $type);
    }
    
    public function getSoftware(){
        if($this->type != "mcpe") return;
        $software = json_decode($this->webtype, true);
        return $software["software"];
    }
    
    public function getVersion(){
        if($this->type != "mcpe") return;
        $version = json_decode($this->webtype, true);
        return $version["version"];
    }

    public function getOnlinePlayers(){
        if($this->type != "mcpe") return;
        $players = json_decode($this->webtype, true);
        return $players["players"]["online"];
    }
    
    public function getMaxPlayers(){
        if($this->type != "mcpe") return;
        $players = json_decode($this->webtype, true);
        return $players["players"]["max"];
    }
    
    public function getServerInformation(){
        if($this->type != "mcpe") return;
        return "{$this->getSoftware()} - {$this->getVersion()} | Online: {$this->getOnlinePlayers()} - Max: {$this->getMaxPlayers()}";
    }

    public static function getURL($page, $timeout = 10, array $extraHeaders = []){
	if(self::$online === false){
            return false;
	}
        $ch = curl_init($page);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge(["User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:12.0) Gecko/20100101 Firefox/12.0 PocketMine-MP"], $extraHeaders));
	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, (int) $timeout);
	curl_setopt($ch, CURLOPT_TIMEOUT, (int) $timeout);
	$ret = curl_exec($ch);
	curl_close($ch);

	return $ret;
    }
    
}
