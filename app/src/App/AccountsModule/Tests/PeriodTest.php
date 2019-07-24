<?php

use Strukt\Util\DateTime;

class PeriodTest extends App\Contract\AbstractTestCase{

	public function testIsOpen(){

		$periodCtr = $this->get("ac.ctr.Period");

		$period = $periodCtr->getByStatus("Open");

		$this->assertNotNull($period);
		$this->assertEquals($period->getStatus(), "Open");
	}

	public function testExtendPeriod(){

		$periodCtr = $this->get("ac.ctr.Period");

		$period = $periodCtr->getByStatus("Open");

		$strEnd = $period->getEnd()->format("Y-m-d H:i:s");

		$newEnd = new DateTime(new DateTime("+60 days"));
		$newEnd->beginDay();

		$periodCtr->extend($newEnd);

		$oldEnd = new DateTime($strEnd);

		$currEnd = new DateTime($period->getEnd()->format("Y-m-d H:i:s"));

		$this->assertGreaterThanOrEqual($currEnd->diff($oldEnd)->format("%a"), 30);
	}
}