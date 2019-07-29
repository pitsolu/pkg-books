<?php

namespace Seed;

use Doctrine\DBAL\Connection;

class Type20190110130300 extends \App\Contract\AbstractSeeder{

	/**
	* @param Connection $conn
	*/
	public function up(Connection $conn){

		$this->loadByJson("data/entry_type.json");
	}

	/**
	* @param Connection $conn
	*/
	public function down(Connection $conn){

		$conn->exec("DELETE FROM entry_type;");
	}
}