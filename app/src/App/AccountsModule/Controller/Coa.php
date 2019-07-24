<?php

namespace __APP__\AccountsModule\Controller;

class Coa extends \Strukt\Contract\Controller{

	public function pager(Array $filter = [], $start_from, $page_size){

		$qb = $this->da()->repo("Coa")->createQueryBuilder("c");

		$qb->addSelect("c.id, c.name");

		if(array_key_exists("name", $filter)){

			$qb->orWhere("c.name LIKE :name");
			$qb->setParameter("name", '%'.$filter["name"].'%');
		}

		$qb->orderBy("c.id", "ASC");

		$pager = $this->da()->paginate($qb, $start_from, $page_size);

		return $pager;
	}

	public function ls(){

	    $query = $this->da()->query("SELECT c.id, c.alias, c.code, c.name FROM ~Coa c");

	    $coas = $query->getResult();

	    return $coas;
	}

	public function all(){

	    $coas = $this->da()->repo("Coa")->findAll();

	    return $coas;
	}

	public function getById($id){

    	$coa = $this->da()->find("Coa", $id);

    	return $coa;
	}

	public function findByAlias($alias){

		$coa = $this->da()->repo('Coa')->findOneBy(array(

			"alias"=>$alias
		));

	    return $coa;
	}

	public function findByCode($code){

		$coa = $this->da()->repo('Coa')->findOneBy(array(

			"code"=>$code
		));

	    return $coa;
	}

	public function findByName($name){

		$dql = "SELECT c.id, c.alias, c.code, c.name 
				FROM ~Coa c 
				WHERE c.name LIKE :name";

		$query = $this->da()->query($dql);

		$query->setParameters(array(

			"name"=>"%".$name."%"
		));

		return $query->getResult();
	}

	public function add($code, $name, $descr){

		try{

			$coa = new Coa();
			$coa->setCode($code);
			$coa->setName($name);
			$coa->setDescr($descr);
			$coa->save();

			return $coa->getId();
		}
		catch(\Exception $e){

			$this->core()->get("app.logger")->error($e->getMessage());

			return null;
		}
	}

	public function update($id, $code, $name, $descr){

		try{

			$coa = $this->getById($id);
			$coa->setCode($code);
			$coa->setName($name);
			$coa->setDescr($descr);

			$em = self::get("em");
			$em->persist($coa);
			$em->flush();

			return true;
		}
		catch(\Exception $e){

			$this->core()->get("app.logger")->error($e->getMessage());

			return false;
		}
	}
}