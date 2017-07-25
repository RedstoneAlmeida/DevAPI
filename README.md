# DevAPI
Continuation from StarterAPI in rewritted mode

## QueryStatus
```php
use DevAPI\QueryStatus;

$query = new QueryStatus("pe.lbsg.net:19132");
Server::getInstance()->getLogger()->info($query->getServerInformation());
```
## InventoryAPI
```php
use DevAPI\inventory\InventoryAPI;

$inventoryApi = InventoryAPI::createInventory($player, 27, "inventory");
InventoryAPI::addItemInventory($inventoryApi, new Item(276,0,1)); // 276 is Sword
```
## CallEvent
```php
use DevAPI\event\callEvent;

$callEvent = new callEvent();
$callEvent->callEvent($ev = new MyCustomEvent($args));
```
## LoaderAPI
```
use DevAPI\LoaderAPI;

class MyClassName extends LoaderAPI{
      public function onEnable(){ echo 'hi'; }
}
```
