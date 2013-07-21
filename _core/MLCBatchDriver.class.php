<?php
abstract class MLCBatchDriver{
	public static $strReport = null;
	public static $objThisJob = null;
	
	public static $intMode = null;
	public static $arrJobs = array();
	public static function Init(){ 
		//Load Last job from DB
		
		
		self::$objThisJob = new MLCBatch();
		self::$objThisJob->CreDate = MLCDateTime::Now();
		self::$objThisJob->Save();
		self::$intMode = MLCBatchMode::INITILIZED;
		
	}
	public static function AddJob($strKey, $objJob){
		if(self::$intMode == MLCBatchMode::INITILIZED){
			self::$arrJobs[$strKey] = $objJob;
		}else{
			throw new MLCBatchException("Jobs cannot be added at this time");
		}
	}
	
	public static function Exicute(){
		if(self::$intMode == MLCBatchMode::INITILIZED){
			self::$intMode = MLCBatchMode::RUNNING;
		}
		
		foreach(self::$arrJobs as $strKey=>$objJob){
			$objJob->_Exicute();
		}
		self::Finalize();
	}
	public static function Report(){
		if(self::$intMode == MLCBatchMode::FINISHED){
			self::$intMode = MLCBatchMode::REPORTING;
		}
		self::$strReport = "--------------Starting Report----------------\n\t";
		self::$strReport .= "Cre Date: " . self::$objThisJob->CreDate . "\n\t";
		self::$strReport .= "--------------JOBS----------------\n\t";
		foreach(self::$arrJobs as $strKey=>$objJob){
			self::$strReport .= $objJob->_Report();
		}
		self::$objThisJob->Report = self::$strReport;
		self::$objThisJob->Save();
		return self::$strReport;
	}
	public static function Finalize(){
		if(self::$intMode == MLCBatchMode::RUNNING){
			self::$intMode = MLCBatchMode::FINISHED;
		}
		//self::$objThisJob->EndDate = MLCDateTime::Now();
		
	}
	
	
	
}
abstract class MLCBatchMode{
	const INITILIZED = 1;
	const RUNNING = 2;
	const FINISHED = 3;
	const REPORTING = 4;
}
class MLCBatchException extends Exception{
	
}