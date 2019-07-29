<?php

namespace Seed;

use Doctrine\DBAL\Connection;

class Journal20190105183156 extends \App\Contract\AbstractSeeder{

	/**
	* @param Connection $conn
	*/
	public function up(Connection $conn){

		$this->loadByJson("data/journal.json");
	}

	/**
	* @param Connection $conn
	*/
	public function down(Connection $conn){

		$conn->exec("DELETE FROM journal;");
	}
}