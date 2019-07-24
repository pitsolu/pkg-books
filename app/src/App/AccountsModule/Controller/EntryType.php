<?php

namespace __APP__\AccountsModule\Controller;

class EntryType extends \Strukt\Contract\Controller{

	public function ls(){

	    $query = $this->da()->query("SELECT e.id, e.name FROM ~EntryType e");

	    $types = $query->getResult();

	    return $types;
	}

	public function all(){

	    $types = $this->da()->repo("EntryType")->findAll();

	    return $types;
	}

	public function getById($id){

    	$type = $this->da()->find("EntryType", $id);

    	return $type;
	}

	public function findByName($name){

		$type = $this->da()->repo('EntryType')->findOneBy(array(

			"name"=>$name
		));

	    return $type;
	}

	public function add($name){

		try{

			$type = $this->get("EntryType");
			$type->setName($name);
			$type->save();

			return $type->getId();
		}
		catch(\Exception $e){

			$this->core()->get("app.logger")->error($e->getMessage());

			return null;
		}
	}

	public function update($id, $name){

		try{

			$type = self::getById($id);
			$type->setName($name);
			$type->save();

			return true;
		}
		catch(\Exception $e){

			$this->core()->get("app.logger")->error($e->getMessage());

			return false;
		}
	}
}