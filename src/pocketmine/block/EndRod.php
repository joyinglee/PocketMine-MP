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

namespace pocketmine\block;

use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Facing;
use pocketmine\math\Vector3;
use pocketmine\Player;

class EndRod extends Flowable{

	protected $id = Block::END_ROD;

	public function __construct(int $meta = 0){
		$this->setDamage($meta);
	}

	public function getName() : string{
		return "End Rod";
	}

	public function place(Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, Player $player = null) : bool{
		if(Facing::axis($face) === Facing::AXIS_Y){
			$this->meta = $face;
		}else{
			$this->meta = $face ^ 0x01;
		}
		if($blockClicked instanceof EndRod and $blockClicked->getDamage() === $this->meta){
			$this->meta ^= 0x01;
		}

		return parent::place($item, $blockReplace, $blockClicked, $face, $clickVector, $player);
	}

	public function isSolid() : bool{
		return true;
	}

	public function getLightLevel() : int{
		return 14;
	}

	protected function recalculateBoundingBox() : ?AxisAlignedBB{
		$m = $this->meta >> 1; //everything except up/down are inverted, but we can still use this for axis
		$width = 0.375;

		switch($m){
			case Facing::AXIS_Y:
				return new AxisAlignedBB(
					$width,
					0,
					$width,
					1 - $width,
					1,
					1 - $width
				);
			case Facing::AXIS_Z:
				return new AxisAlignedBB(
					0,
					$width,
					$width,
					1,
					1 - $width,
					1 - $width
				);
			case Facing::AXIS_X:
				return new AxisAlignedBB(
					$width,
					$width,
					0,
					1 - $width,
					1 - $width,
					1
				);
		}

		return null;
	}

	public function getVariantBitmask() : int{
		return 0;
	}
}
