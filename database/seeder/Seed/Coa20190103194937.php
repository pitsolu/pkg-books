<?php

namespace Seed;

use Doctrine\DBAL\Connection;

class Coa20190103194937 extends \App\Contract\AbstractSeeder{

	/**
	* @param Connection $conn
	*/
	public function up(Connection $conn){

		$this->loadByXls("data/coa.xls");
	}

	/**
	* @param Connection $conn
	*/
	public function down(Connection $conn){

		$conn->exec("DELETE FROM coa;");
	}
}