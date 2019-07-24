<?php

namespace Seed;

use Doctrine\DBAL\Connection;

class Entry20190110130252{

	/**
	* @param Connection $conn
	*/
	public function up(Connection $conn){

		$coas = $conn->fetchAll("select * from coa");

		foreach($coas as $coa)
			$acc[$coa["alias"]] = $coa["id"];

		$entry = json_decode(\Strukt\Fs::cat("data/_entry.json"),1);

		$conn->beginTransaction();

		try{

			foreach($entry["data"] as $couple){

				list($from, $to) = explode(":", $couple);

				$conn->insert("entry", array(

					"credit"=>$acc[$from],
					"debit"=>$acc[$to],
					"note"=>$couple,
					"status"=>"Active",
					"created_at"=>(new \DateTime)->format("Y-m-d H:i:s")
				));
			}

			$conn->commit();
		}
		catch(\Exception $e){

			$conn->rollBack();

			throw new \Exception(sprintf("Unable to load Entry list! \n\n%s", $e->getMessage()));
		}
	}

	/**
	* @param Connection $conn
	*/
	public function down(Connection $conn){

		$conn->exec("DELETE FROM entry;");
	}
}