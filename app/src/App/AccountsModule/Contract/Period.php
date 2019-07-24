<?php

namespace __APP__\AccountsModule\Controller;

interface Period{

	public function getDaily($day);
	public function getOpenDays();
	public function closeDayRange(\DateTime $start, \DateTime $end);
	public function findByCreatedAt(\DateTime $date, \DateTime $to);
	public function isDayClosed($day);
	public function closeDay($map, $day, $descr);
}