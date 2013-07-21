<?php
class MLCBatchJob{
	public $arrSilentExecptions = array();
	public $exeGen = null;
	public $exeMLC = null;
	public $blnSuccess = false;
	public final function _Exicute(){
		try{
			$this->Exicute();
		}catch(MLCBatchJobException $exeMLC){
			$this->exeMLC = $exeMLC;
			return false;
		}catch(Exception $exeGen){
			$this->exeGen = $exeGen;
			return false;
		}
		
	}
	public function Exicute(){ }
	public final function _Report(){
		$strReport = "--------------------" . get_class($this) . "-----------------------\n\t";
		try{
			$strReport .= $this->Report();
		}catch(MLCBatchJobException $exeMLC){
			
		}catch(Exception $exeGen){
			
		}
		
		if(!is_null($this->exeGen)){
			$strReport .= "-------------------GENERAL EXCEPTION---------------\n\t";
			$strReport .= $this->exeGen->__toString() . "\n";
		}
		if(!is_null($this->exeMLC)){
			$strReport .= "-------------------MLCBatch EXCEPTION---------------\n\t";
			$strReport .= $this->exeMLC->__toString() . "\n";
		}
		foreach($this->arrSilentExecptions as $exeSilent){
			$strReport .= "-------------------SILENT EXCEPTION---------------\n\t";
			$strReport .= $exeSilent->__toString() . "\n";
		}
		return $strReport;
	}
	public function Report(){ return ''; }
	
	
	public function AddSilentException($exeSilent){
		$this->arrSilentExecptions[] = $exeSilent;
	}
}