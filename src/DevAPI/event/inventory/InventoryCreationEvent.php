<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 25/07/2017
 * Time: 13:39
 */

namespace DevAPI\event\inventory;


use pocketmine\event\Cancellable;
use pocketmine\event\inventory\InventoryEvent;
use pocketmine\inventory\Inventory;
use pocketmine\Player;

class InventoryCreationEvent extends InventoryEvent implements Cancellable
{

    public static $handlerList = null;

    /** @var Player */
    private $who;

    /**
     * @var Inventory
     */
    private $inventory;

    /**
     * @var int
     */
    private $type;

    /**
     * @param Inventory $inventory
     * @param Player    $who
     */
    public function __construct(Inventory $inventory, Player $who, int $type){
        $this->who = $who;
        $this->inventory = $inventory;
        $this->type = $type;
        parent::__construct($inventory);
    }

    public function setInventory($inventory){
        $this->inventory = $inventory;
    }

    public function setType(int $type){
        $this->type = $type;
    }

    public function getInventory()
    {
        return $this->inventory;
    }

    public function getPlayer()
    {
        return $this->who;
    }

    public function getType(){
        return $this->type;
    }

}