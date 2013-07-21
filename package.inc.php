<?php
define('__MLC_BATCH__', dirname(__FILE__));
define('__MLC_BATCH_CORE__', __MLC_BATCH__ . '/_core');
define('__MLC_BATCH_DATA_LAYER__', __MLC_BATCH_CORE__ . '/data_layer');
MLCApplicationBase::$arrClassFiles['MLCBatchDriver'] = __MLC_BATCH_CORE__ . '/MLCBatchDriver.class.php';
MLCApplicationBase::$arrClassFiles['MLCBatchJob'] = __MLC_BATCH_CORE__ . '/MLCBatchJob.class.php';
MLCApplicationBase::$arrClassFiles['MLCBatchReport'] = __MLC_BATCH_CORE__ . '/MLCBatchReport.class.php';

//Data Layer
MLCApplicationBase::$arrClassFiles['MLCBatch'] = __MLC_BATCH_DATA_LAYER__ . '/MLCBatch.class.php';
?>