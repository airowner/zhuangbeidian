<?php
require "../RequestCheckUtil.php";
require "../TopClient.php";
/**
 * TOP API: taobao.topats.result.get request
 * 
 * @author auto create
 * @since 1.0, 2012-08-07 16:31:26
 */
class TopatsResultGetRequest
{
	/** 
	 * 任务id号，创建任务时返回的task_id
	 **/
	private $taskId;
	
	private $apiParas = array();
	
	public function setTaskId($taskId)
	{
		$this->taskId = $taskId;
		$this->apiParas["task_id"] = $taskId;
	}

	public function getTaskId()
	{
		return $this->taskId;
	}

	public function getApiMethodName()
	{
		return "taobao.topats.result.get";
	}
	
	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function check()
	{
		
		RequestCheckUtil::checkNotNull($this->taskId,"taskId");
	}
}
$request = new TopatsResultGetRequest;
$request->setTaskId(3488232);
$tc = new TopClient();
$result = json_decode(json_encode($tc->execute($request)), true);

var_export($result);
echo "\n";
