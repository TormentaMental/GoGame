<?php

use PHPUnit\Framework\TestCase;
use GoGame\Game;

final class GameTest extends TestCase
{

	public function testEverythingIsAllRight(): void
	{
		new Game();
	}


}
