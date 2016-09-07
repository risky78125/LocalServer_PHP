<?php 
	
	include './upfile.php';
	include "./util.php";

	const DEF_INFO = "%E7%A6%8F%E5%88%A9";
	const DEF_COUNT = "20";
	const DEF_PAGE = "1";

	const DEF_AUTH_FAILURE = "验证失败,默认值为:username=dla160504&password=12345678";

	// 获取POST请求的数据,[]里面是key

	// echo $_FILES["file"]["error"];

	
	$info  = getGetValue("info");
	$count = getGetValue("count");
	$page  = getGetValue("page");
	if ($info == "") {
		$info = DEF_INFO;
	}
	if ($count == "") {
		$count = DEF_COUNT;
	}
	if ($page == "") {
		$page = DEF_PAGE;
	}

	# code...
	$username = getPostValue("username");
	$password = getPostValue("password");
	if ($username != "" && $password != "") {
		if ($username == "dla160504" && $password == "12345678") {
			$url = "http://gank.io/api/data/$info/$count/$page";
			$result= file_get_contents($url);
			$response = json_decode($result);
			// var_dump($response);
			$json = array("responseCode" => 1,"datas" => $response,"update" => getUploadFile());
			echo json_encode($json);
		}else{
			echo_error();
		}
	}elseif (array_key_exists("file", $_FILES)) {
		echo_error();
	}else{
		echo_error();
	}

	function echo_error(){
		$array = array(
			"responseCode" => 0,
			"datas" => array("error" => true,"results" => array(array("type" => DEF_AUTH_FAILURE))),
			"update" => getUploadFile()
			);
			echo json_encode($array);
	}
	

	// function getPostValue($key){
	// 	if (array_key_exists($key, $_POST)) {
	// 		return $_POST[$key];
	// 	}
	// 	return "";
	// }
	// function getGetValue($key){
	// 	if (array_key_exists($key, $_GET)) {
	// 		return $_GET[$key];
	// 	}
	// 	return "";
	// }
	
 ?>
