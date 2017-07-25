<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 25/07/2017
 * Time: 13:55
 */

namespace DevAPI;


use pocketmine\plugin\PluginBase;

class LoaderAPI extends PluginBase
{

    public function onEnable()
    {
        self::initialize();
    }

    public function initialize(){
        $this->getServer()->getPluginManager()->registerEvents(new EventLoader($this), $this);
    }

}