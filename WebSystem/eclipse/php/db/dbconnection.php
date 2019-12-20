<?php

function return_oraid(){
	return "web";
}

function return_orapw(){
	return "oic";
}

function return_oraConnString(){
	return "172.24.39.108:1521/Attendances.srv.oic";
}

function return_oraLang(){
	return "AL32UTF8";
}

function SelectDbConnection($sqlString){

	// dbconnection.phpからdb情報を取得
	$oraid = return_oraid();
	$orapw = return_orapw();
	$oraConnString = return_oraConnString();
	$oraLang = return_oraLang();

	// DB情報を設定
	$oraConn = oci_connect($oraid, $orapw, $oraConnString, $oraLang);

	// DBと接続できない時のエラー処理
	if (!$oraConn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

		// エラーメッセージを返す
	 	return $ERROR;
	}

	// DBへのSQL文の設定
	$sql = $sqlString;

	// DBへの命令設定
	$statementId = oci_parse($oraConn, $sql);

	// バインド「:edit_id」に文字列の設定
	oci_bind_by_name($statementId, ":edit_id",$edit_id);

	// 命令の実行
	oci_execute($statementId);

	// array型の配列$arrayを宣言
	$array = array();

	// 取得したDBデータを$arrayに格納していく
	while ($row = oci_fetch_array($statementId, OCI_ASSOC+OCI_RETURN_NULLS)) {
		foreach ($row as $item) {
			$array = array_merge($array, array($item));
		}
	}

	// リソースの開放
	oci_free_statement($statementId);

	// db接続終了
	oci_close($oraConn);

	// DBデータが格納された配列$arrayをjson形式へ変換
	$json = json_encode($array, JSON_UNESCAPED_UNICODE);

	// student.jsに返却
	return $json;

}

?>
