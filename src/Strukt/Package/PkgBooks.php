<?php

namespace Strukt\Package;

use Strukt\Contract\Package as Pkg;

class PkgBooks implements Pkg{

	private $manifest;

	public function __construct(){

		$this->manifest = array(

			"package"=>"pkg-books",
			"files"=>array(

				"database/schema/Schema/Migration/VersionAccounts.php",
				"database/seeder/Seed/Journal20190105183156.php",
				"database/seeder/Seed/Period20190112004705.php",
				"database/seeder/Seed/Type20190110130300.php",
				"database/seeder/Seed/Coa20190103194937.php",
				"database/seeder/Seed/Trx20190110144418.php",
				"database/seeder/Seed/Entry20190110130252.php",
				"app/src/App/AccountsModule/_AccountsModule.sgf",
				"app/src/App/AccountsModule/Contract/Period.sgf",
				"app/src/App/AccountsModule/Controller/PeriodRange.sgf",
				"app/src/App/AccountsModule/Controller/Entry.sgf",
				"app/src/App/AccountsModule/Controller/EntryType.sgf",
				"app/src/App/AccountsModule/Controller/Trx.sgf",
				"app/src/App/AccountsModule/Controller/Period.sgf",
				"app/src/App/AccountsModule/Controller/Accountant.sgf",
				"app/src/App/AccountsModule/Controller/Coa.sgf",
				"app/src/App/AccountsModule/Controller/Journal.sgf",
				"app/src/App/AccountsModule/Command/BooksShell.sgf",
				"app/src/App/AccountsModule/Seeder/Accounts.sgf",
				"app/src/App/AccountsModule/Seeder/Trx.sgf",
				"app/src/App/AccountsModule/Seeder/Period.sgf",
				"app/src/App/AccountsModule/Tests/AccountantTest.sgf",
				"app/src/App/AccountsModule/Tests/PeriodTest.sgf",
				"data/entry_type.json",
				"data/coa.xls",
				"data/_entry.json",
				"data/journal.json",
				"lib/App/Contract/AbstractSeeder.php",
			),
			"modules"=>array(

				"AccountsModule"
			)
		);
	}

	public function getName(){

		return $this->manifest["package"];
	}

	public function getFiles(){

		return $this->manifest["files"];
	}

	public function getModules(){

		return $this->manifest["modules"];
	}

	public function isPublished(){

		return class_exists(\Schema\Migration\VersionAccounts::class);
	}
}