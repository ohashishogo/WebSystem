<?php
$classroom_id = isset($_POST['classroom_id']) ? $_POST['classroom_id'] : null;
$classroomform_id = 'RF02';

// dbconnection.phpからdb情報を取得
require "dbconnection.php";

$oraid = return_oraid();
$orapw = return_orapw();
$oraConnString = return_oraConnString();
$oraLang = return_oraLang();

$conn = oci_connect($oraid, $orapw, $oraConnString, $oraLang);

// 接続ができない時にエラー表示
if (!$conn) {
 $e = oci_error();
 trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$sqlString = 'INSERT INTO m_classroom(m_classroom_id, m_classroom_qrdate, m_classroomform_id) ' ;
$sqlString .= 'VALUES (';
$sqlString .= ':classroom_id,';
$sqlString .= "0, ";
$sqlString .=':classroomform_id)';

// 一つ目のsqlStringの実行
$statementId = oci_parse($conn, $sqlString);

// バインド「:edit_id」に文字列の設定
oci_bind_by_name($statementId, ":classroom_id", $classroom_id);
oci_bind_by_name($statementId, ":classroomform_id", $classroomform_id);

$r = oci_execute($statementId, OCI_NO_AUTO_COMMIT);

// SQL文がおかしい時
if(!$r){
    $e = oci_error($statementId);
    trigger_error(htmlentities($e['message']), E_USER_ERROR);
}

$r = oci_commit($conn);
if(!$r) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message']), E_USER_ERROR);
}

// リソースの開放
oci_free_statement($statementId);
//oci_free_statement($statementId2);

// db接続終了
oci_close($conn);

?>
