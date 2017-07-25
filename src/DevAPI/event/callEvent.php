<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DevAPI\event;

use pocketmine\event\Event;
use pocketmine\Server;

class callEvent {
    /**
     * Calls an event
     *
     * @param Event $event
     */
    public function callEvent(Event $event){
        return Server::getInstance()->getPluginManager()->callEvent($event);
    }

}
