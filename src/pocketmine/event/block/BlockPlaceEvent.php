<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\event\block;

use pocketmine\block\Block;
use pocketmine\event\Cancellable;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\Player;

/**
 * Called when a player places a block
 */
class BlockPlaceEvent extends BlockEvent implements Cancellable{

	/** @var Vector3 */
	protected $blockAgainst;

	/** @var Player */
	protected $player;

	/** @var Item */
	protected $item;

	/** @var Block */
	protected $blockState;

	public function __construct(Level $level, Vector3 $blockReplace, Vector3 $blockAgainst, Player $player, Item $item, Block $blockState){
		parent::__construct($level, $blockReplace);
		$this->blockAgainst = $blockAgainst;
		$this->player = $player;
		$this->item = $item;
		$this->blockState = $blockState;
	}

	/**
	 * Returns the player who is placing the block.
	 * @return Player
	 */
	public function getPlayer() : Player{
		return $this->player;
	}

	/**
	 * Gets the item in hand
	 * @return Item
	 */
	public function getItem() : Item{
		return $this->item;
	}

	/**
	 * @return Vector3
	 */
	public function getAgainstPos() : Vector3{
		return $this->blockAgainst;
	}

	/**
	 * Returns the state of the newly-placed block.
	 *
	 * @return Block
	 */
	public function getBlock() : Block{
		return $this->blockState;
	}
}
