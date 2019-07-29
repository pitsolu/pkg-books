<?php

namespace Seed;

use Doctrine\DBAL\Connection;

class Trx20190110144418{

	/**
	* @param Connection $conn
	*/
	public function up(Connection $conn){

		$trxs = array(

			array(

				"id"=>1,
				"transfer"=>"CASHPETTY:CASHOP",
				"journal"=>"Sales",
				"entry_type"=>"Transaction",
				"amount"=> 1000,
				"descr"=> "Move float to cash"
			),
			array(

				"id"=>2,
				"transfer"=>"REVSALES:CASHOP",
				"journal"=>"Sales",
				"entry_type"=>"Transaction",
				"amount"=> 1200,
				"descr"=>"Sales @ EOB"
			),
			array(

				"id"=>3,
				"transfer"=>"CASHOP:LTD",
				"journal"=>"Sales",
				"entry_type"=> "Transaction",
				"amount"=> 100,
				"descr"=> "Lent Joseph"
			),
			array(

				"id"=>4,
				"transfer"=>"REVSALES:AR",
				"journal"=>"Sales",
				"entry_type"=> "Transaction",
				"amount"=> 200,
				"descr"=> "Credit Sales"
			)
		);

		$recons = array(

			// array(

			// 	"id"=>4,
			// 	"transfer"=>"CASHOP:CASHPETTY",
			// 	"journal"=> "Sales",
			// 	"entry_type"=> "Reconciliation",
			// 	"amount"=> 2100,
			// 	"descr"=> "Close Day Reconciliation"
			// ),
			// array(

			// 	"id"=>4,
			// 	"transfer"=>"LTD:CASHPETTY",
			// 	"journal"=> "Sales",
			// 	"entry_type"=> "Reconciliation",
			// 	"amount"=> 100,
			// 	"descr"=> "Close Day Reconciliation"
			// ),
			// array(

			// 	"id"=>4,
			// 	"transfer"=>"CASHPETTY:REVSALES",
			// 	"journal"=> "Sales",
			// 	"entry_type"=> "Reconciliation",
			// 	"amount"=> 1200,
			// 	"descr"=> "Close Day Reconciliation"
			// ),
			// array(

			// 	"id"=>4,
			// 	"transfer"=>"AR:REVSALES",
			// 	"journal"=> "Sales",
			// 	"entry_type"=> "Reconciliation",
			// 	"amount"=>200,
			// 	"descr"=> "Close Day Reconciliation"
			// )
		);

		$entries = $conn->fetchAll("select * from entry");

		foreach($entries as $entry)
			$entryList[$entry["note"]] = $entry["id"];

		$journals = $conn->fetchAll("select * from journal");

		foreach($journals as $journal)
			$journalList[$journal["name"]] = $journal["id"];

		$entry_types = $conn->fetchAll("select * from entry_type");

		foreach($entry_types as $type)
			$typeList[$type["name"]] = $type["id"];

		$conn->beginTransaction();

		try{

			$created_at = (new \DateTime)->format("Y-m-d H:i:s");
			$map = sha1($created_at);

			foreach(array_merge($trxs,$recons) as $trx){

				$conn->insert("trx", array(

					"entry_id"=>$entryList[$trx["transfer"]],
					"entry_type_id"=>$typeList[$trx["entry_type"]],
					"journal_id"=>$journalList[$trx["journal"]],
					"amount"=>$trx["amount"],
					"descr"=>sprintf("%s %s", $trx["descr"], substr(sha1(rand()), 0, 8)),
					"created_at"=>$created_at
				));
			}

			$conn->commit();
		}
		catch(\Exception $e){

			$conn->rollBack();

			throw new \Exception(sprintf("Unable to load Trx list! \n\n%s", $e->getMessage()));
		}
	}

	/**
	* @param Connection $conn
	*/
	public function down(Connection $conn){

		$conn->exec("DELETE FROM trx;");
	}
}