<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 25/07/2017
 * Time: 13:22
 */

namespace DevAPI\inventory;


use pocketmine\item\Item;
use pocketmine\Player;

class InventoryAPI
{
    const TYPE_CHEST = 27;
    const TYPE_HOPPER = 5;
    const TYPE_ENCHANTTABLE = 2;

    /**
     * @param Player $player
     * @param int $type
     * @param string $name
     * @return bool|WindowInventory
     */
    public static function createInventory(Player $player, int $type = 27, $name = ""){
        if($player == null) return false;
        if($type != self::TYPE_CHEST || $type != self::TYPE_HOPPER || $type != self::TYPE_ENCHANTTABLE) return false;
        return new WindowInventory($player, $type, $name);
    }

    public static function addItemInventory(WindowInventory $inventory, $item){
        if($inventory == null || $item == null) return;
        if($item instanceof Item){
            $inventory->addItem($item);
        }
    }

}