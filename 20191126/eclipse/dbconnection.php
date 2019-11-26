<!DOCTYPE html>

<html>
<head>
    <link type="text/css" media="screen" href="jqGrid/jquery-ui.min.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="jqGrid/jquery-ui.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="jqGrid/css/ui.jqgrid.css" rel="stylesheet" />
    <script type="text/javascript" src="jqGrid/jquery-3.4.1.min.js" ></script>
    <script type="text/javascript" src="jqGrid/js/jquery.jqGrid.min.js" ></script>
    <script type="text/javascript" src="jqGrid/js/i18n/grid.locale-ja.js" ></script>
    <script type="text/javascript" src="jqGrid/jquery-ui/jquery-ui.js"></script>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<?php
$if = 0;
$oraid = 'web';
$orapw = 'oic';
$oraConnString = '172.24.39.108:1521/Attendances.srv.oic';
$oraLang = 'AL32UTF8';
$oraConn = oci_connect($oraid, $orapw, $oraConnString, $oraLang);
if (!$oraConn) {
 $e = oci_error();
 trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$sqlString = 'SELECT m_cr.m_classroom_id, m_cr.m_classroomform_id, m_crf.m_classroom_name FROM m_classroom m_cr JOIN m_classroomform m_crf ON m_cr.m_classroomform_id = m_crf.m_classroomform_id';
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

?>

<script type="text/javascript">
jQuery(document).ready(function()
    {
 var roomdate = [
     // dbから取得したデータをセット
    <?php
    foreach ($array as $in) {
	    switch($if % 3){
    case 0:
	echo '{m_classroom_id:"'.$in.'",';
	break;
    case 1:
	echo 'm_classroomform_id:"'.$in. '",';
	break;
    case 2:
	echo 'm_classroom_name:"'.$in. '"},';
    	break;
    }
    $if++;
 }
?>
			        ];
     			        jQuery("#list").jqGrid({
			                        data: roomdate,
			            datatype: "local", //localなのは
			            colNames:['教室番号', '教室形態番号','教室形態名称'],
			            colModel:[
			                {name:'m_classroom_id'},
			                {name:'m_classroomform_id'},
					{name:'m_classroom_name'},
			            ],
			            rowNum : 10,
					rowList : [1, 5, 10],
			            caption: '教室一覧',
					pager : 'pager1'
			        });
			    });
    </script>
<table id="list">
  </table>
     <div id ="pager1"></div>

</body>
</html>
