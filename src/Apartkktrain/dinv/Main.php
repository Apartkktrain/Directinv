<?php
namespace Apartkktrain\dinv;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\event\block\BlockBreakEvent;
class Main extends PluginBase implements Listener
{
      public function onEnable()
	  {
		  $this->getServer()->getPluginManager()->registerEvents($this, $this);
	  }

	/**
	 * @priority MONITOR
	 * @ignoreCancelled true
	 * @param BlockBreakEvent $event
	 */
	  public function BlockBreakEvent(BlockBreakEvent $event)
	  {
	  	$player = $event->getPlayer();
	  	$blocks = $event->getDrops();
		  foreach ($blocks as $key => $item)
		  {
			  if($player->getInventory()->canAddItem($item))
			  {
				  $event->setDrops([]);
				  $player->getInventory()->addItem($item);
			  }else{
			  	$event->setCancelled();
			  	$player->sendTip("§eインベントリが満タンです!");
			  }
	  	}
	  }
}