<?php

namespace __APP__\AccountsModule\Command;

class Trx extends \App\Contract\AbstractSeeder{

	public function up(){

		$this->down();

		$conn = $this->core()->get("app.em")->getConnection();

		$periodSeeder = new \Seed\Trx20190110144418();
		$periodSeeder->up($conn);
	}

	public function down(){

		$conn = $this->core()->get("app.em")->getConnection();

		$conn->exec("DELETE FROM trx");
	}
}