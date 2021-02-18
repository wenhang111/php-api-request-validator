<?php

/*
本demo只演示Validator工具类的使用方式，具体请求参数处理以及结果返回格式请根据使用框架结构灵活调整
*/

require_once(dirname(__DIR__)."/src/Validator.php");

//easyswoole框架中的参数获取方法
$requests = $this->request()->getRequestParam();
$validator = new Validator();
$validatorCols = [
	"order_id" => "int|required",
	"member_code" => "string|notEmpty",
	"type" => "int|in:-1,1,2",
	"status" => "int|min:1|max:12",
];
$validator->validate($requests, $validatorCols);
if ($validator->hasError()) {
	//框架封装的带链路追踪的json格式数据返回方法
	return $this->pigJson($validator->errorList(), Status::getReasonPhrase(Status::CODE_BAD_REQUEST), Status::CODE_BAD_REQUEST);
}
//请求成功使用pigJson方法默认参数返回
//protected function pigJson(array $data = [], string $msg = "success", int $code = 200, int $status = 200)
return $this->pigJson();

