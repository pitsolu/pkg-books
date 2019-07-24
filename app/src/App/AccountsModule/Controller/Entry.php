<?php

namespace __APP__\AccountsModule\Controller;

class Entry extends \Strukt\Contract\Controller{

	public function ls(){

	    $query = $this->da()->query("SELECT e.id, e.note, e.status  FROM ~Entry e");

	    $entries = $query->getResult();

	    return $entries;
	}

	public function all(){

	    $entries = $this->da()->repo("Entry")->findAll();

	    return $entries;
	}

	public function getById($id){

    	$entry = $this->da()->find("Entry", $id);

    	return $entry;
	}

	public function findByNote($note){

		$entry = $this->da()->repo('Entry')->findOneBy(array(

			"note"=>$note
		));

	    return $entry;
	}

	public function add($credit, $debit, $note, $status="Active"){

		try{

			$entry = $this->get("Entry");
			$entry->setCredit($credit);
			$entry->setDebit($debit);
			$entry->setNote($note);
			$entry->setStatus($status);
			$entry->setCreatedAt(new \DateTime());
			$entry->save();

			return $entry->getId();
		}
		catch(\Exception $e){

			$this->core()->get("app.logger")->error($e->getMessage());

			return null;
		}
	}

	public function update($id, $credit, $debit, $note, $status){

		try{

			$entry = self::getById($id);
			$entry->setCredit($credit);
			$entry->setDebit($debit);
			$entry->setNote($note);
			$entry->setStatus($status);
			$entry->save();

			return true;
		}
		catch(\Exception $e){

			$this->core()->get("app.logger")->error($e->getMessage());

			return false;
		}
	}
}