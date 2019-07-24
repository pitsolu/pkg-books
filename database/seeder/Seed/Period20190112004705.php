<?php

namespace Seed;

use Doctrine\DBAL\Connection;

class Period20190112004705{

	/**
	* @param Connection $conn
	*/
	public function up(Connection $conn){

		$row = $conn->fetchArray("SELECT * FROM period WHERE status = 'Open'");

		if(!empty($row))
			throw new \Exception("Period already exists!");

		$conn->insert("period", array(

			"start"=>(new \DateTime("-30 days"))->format("Y-m-d H:i:s"),
			"end"=>(new \DateTime("+30 days"))->format("Y-m-d H:i:s"),
			"status"=>"Open"
		));
	}

	/**
	* @param Connection $conn
	*/
	public function down(Connection $conn){

		$conn->exec("DELETE FROM period;");
	}
}