<?php

namespace __APP__\AccountsModule\Seeder;

class Accounts extends \App\Contract\AbstractSeeder{

	public function up(){

		$paths = array(

			"data/coa.xls",
			"data/entry_type.json",
			"data/journal.json"
		);

		foreach($paths as $path){

			$pathinfo = pathinfo($path);

			if($pathinfo["extension"] == "json")
				\App\Service\Seeder\Json::load($path);
			else if($pathinfo["extension"] == "xls")
				\App\Service\Seeder\Xls::load($path);
		}

		$conn = $this->core()->get("app.em")->getConnection();

		$entry = new \Seed\Entry20190131150252();
		$entry->up($conn);
	}

	public function down(){

		$conn = $this->core()->get("app.em")->getConnection();

		$conn->getConnection()->exec("DELETE FROM trx;
												DELETE FROM entry;
												DELETE FROM coa; 
												DELETE FROM entry_type;
												DELETE FROM journal;");
	}
}