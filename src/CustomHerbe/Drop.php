<?php

namespace CustomHerbe;

use pocketmine\event\Listener;
use pocketmine\{Server, Player};
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Drop extends PluginBase implements Listener{
 
 public $config;
 
 public function onEnable(){
  $this->getServer()->getPluginManager()->registerEvents($this, $this);
 $this->getLogger()->info("Plugin by Refaltor");
 @mkdir($this->getDataFolder());
 
 if(!file_exists($this->getDataFolder()."config.yml")){
  
 $this->saveResource('config.yml');
 
  }
  
 $this->config = new Config($this->getDataFolder().'config.yml', Config::YAML);
 
 if($this->getConfig()->get("herbe") === true){
  $this->getLogger()->notice("herbe activé");
 }else{
  $this->getLogger()->notice("herbe désactivé");
 }
  
 
 }
 
 public function onDisable(){
 $this->getLogger()->info("Plugin off !");
 }
 
 
 public function onBreak(BlockBreakEvent $event) {
  
 $block = $event->getBlock();
 $item = $event->getItem();
 if($this->getConfig()->get("version") === 1.0){
 
if($this->config->get("herbe") === true){
 if($block->getId() == Block::TALLGRASS && $block->getDamage() == 1){

$normal = $this->getConfig()->get("normal");
$rare = $this->getConfig()->get("rare");
$chance = $this->getConfig()->get("chance");
$drop = mt_rand(1, $chance);

if($chance >= 2){
$amount = $this->getConfig()->get("Montant");
$amount1 = $this->getConfig()->get("montant");
if($drop >= 2){
$event->setDrops([Item::get($rare, 0, $amount)]);
}else{
$event->setDrops([Item::get($normal, 0, $amount1)]);
}
 }
}
}
  }
  }
}
