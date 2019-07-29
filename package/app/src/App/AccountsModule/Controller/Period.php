<?php

namespace __APP__\AccountsModule\Controller;

use Strukt\Util\DateTime;

class Period extends \Strukt\Contract\Controller{

	public function ls(){

	    $query = $this->da()->query("SELECT p.start, p.end, p.status FROM ~Period p");

	    $period = $query->getResult();

	    return $period;
	}

	public function all(){

     	$period = $this->da()->repo('Period')->findAll();

     	return $period;
	}

	public function isOpen(){

		$period = $this->getByStatus("Open");

		if(!is_null($period)){

			$now = new \DateTime();
			$end = 	new DateTime($period->getEnd());

			return $end->gte($now);
		}
		
		return false;
	}

	public function getByStatus($status){

		$period = $this->da()->repo('Period')->findOneBy(array(

			"status"=>$status
		));

	    return $period;
	}

	public function extend(\DateTime $end){

		return $this->update('Open', $end);
	}

	public function close(){

		return $this->update('Closed', new \DateTime);
	}

	public function update($status, DateTime $end){

		$period = $this->getByStatus("Open");

		if(!is_null($period) && $end->gt($period->getStart())){

			try{


				$period->setEnd($end);
				$period->setStatus($status);
				$period->save();

				return true;
			}
			catch(\Exception $e){

				$this->core()->get("app.logger")->error($e->getMessage());

				return false;
			}
		}

		return false;
	}

	public function add(\DateTime $start, \DateTime $end, $status){

		try{

	        $start = new DateTime($start);
	        $end = new DateTime($end);

	        if(!($start->gte(new \DateTime) && $end->gt($start)))
	        	throw new \Exception("Start Date must be later or equal to Present Date and ".
	        							"End Date must be later than Start Date!");

        	$period = $this->get("core")->getNew('Period');

	        $period->setStart($start);
	        $period->setEnd($end);
	        $period->setStatus($status);

	        if(!is_null($this->getByStatus($status)))
	        	throw new \Exception(sprintf("Status [%s] already exists!", $status));

			$period->save();

			return $period->getId();
		}
		catch(\Exception $e){

			$this->core()->get("app.logger")->error($e->getMessage());

			return null;
		}
	}
}