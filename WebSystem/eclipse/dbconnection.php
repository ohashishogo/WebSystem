<?php
$text = $_POST['a'];
$if = 1;
$oraid = 'web';
$orapw = 'oic';
$oraConnString = '192.168.56.101:1521/Attendance.srv.oic';
$oraLang = 'AL32UTF8';
$oraConn = oci_connect($oraid, $orapw, $oraConnString, $oraLang);
if (!$oraConn) {
 $e = oci_error();
 trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$sqlString = 'SELECT * FROM m_employeeclassification';
$statementId = oci_parse($oraConn, $sqlString);
oci_execute($statementId);
$array = array();
while ($row = oci_fetch_array($statementId, OCI_ASSOC+OCI_RETURN_NULLS)) {
 foreach ($row as $item) {
     $array = array_merge($array, array($item));
 }
}

// リソースの開放
oci_free_statement($statementId);

// db接続終了    
oci_close($oraConn);
$json = json_encode($array, JSON_UNESCAPED_UNICODE);
echo $json;
?>