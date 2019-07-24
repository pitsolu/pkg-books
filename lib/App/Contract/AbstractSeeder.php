<?php

namespace App\Contract;

abstract class AbstractSeeder{

	use CoreTraits;

	protected function loadByXls($xls_path){

		\App\Service\Seeder\Xls::load($xls_path);
	}

	protected function loadByJson($json_path){

		\App\Service\Seeder\Json::load($json_path);
	}
}