<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 25/07/2017
 * Time: 13:56
 */

namespace DevAPI;


use DevAPI\event\callEvent;
use DevAPI\event\inventory\InventoryClickEvent;
use DevAPI\inventory\WindowInventory;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\inventory\BaseTransaction;
use pocketmine\inventory\ContainerInventory;
use pocketmine\inventory\PlayerInventory;
use pocketmine\inventory\SimpleTransactionQueue;
use pocketmine\network\protocol\ContainerSetSlotPacket;

use pocketmine\inventory\Inventory;
use pocketmine\network\protocol\Info;
use pocketmine\Server;

class EventLoader implements Listener
{

    public function onTransaction(InventoryTransactionEvent $ev){
        $failed = [];
        foreach(Server::getInstance()->getOnlinePlayers() as $player) {
            while (!$ev->getQueue()->getTransactions()->isEmpty()) {
                $transaction = $ev->getQueue()->getTransactions()->dequeue();
                // $this->getLogger()->info("clickEvent");
                if ($transaction->getInventory() instanceof ContainerInventory || $transaction->getInventory() instanceof PlayerInventory) {
                    $player->getServer()->getPluginManager()->callEvent($event = new InventoryClickEvent($transaction->getInventory(), $player, $transaction->getSlot(), $transaction->getInventory()->getItem($transaction->getSlot())));
                    if ($event->isCancelled()) {
                        $ev->setCancelled(true);
                    }
                    if ($ev->isCancelled()) {
                        $transaction->sendSlotUpdate($player);
                        continue;
                    } elseif (!$transaction->execute($player)) {
                        $transaction->addFailure();
                        if ($transaction->getFailures() >= SimpleTransactionQueue::DEFAULT_ALLOWED_RETRIES) {
                            $failed[] = $transaction;
                        } else {
                            $transaction->sendSlotUpdate($player);
                            $ev->getQueue()->getTransactions()->enqueue($transaction);
                        }
                        continue;
                    }

                    $transaction->setSuccess();
                    $transaction->sendSlotUpdate($player);
                    foreach ($failed as $f) {
                        $f->sendSlotUpdate($player);
                    }
                }
            }
        }
    }

}