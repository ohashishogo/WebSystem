<!DOCTYPE html>

<html>
<head>

    // scriptの読み込み
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
    
?>
    
<script type="text/javascript">
jQuery(document).ready(function()
    {
 var mydata = [
     // dbから取得したデータをセット
    <?php 
    foreach ($array as $in) {
    if($if % 2){
         echo '{comp_code:"'.$in.'",';
     }else {
         echo 'comp_name:"'.$in. '"},';
     }
    $if++;
 }

?>
			        ];
    var colModelSettings = [	
    {name:'comp_code'},
    {name:'comp_name'},
    ]
    
jQuery("#list").jqGrid({
    data: mydata,
    datatype: "local", //localなのは 
    colNames:['コード', '会社名'],
    colModel:colModelSettings,
    rowNum : 10,
    rowList : [1, 5, 10],
    caption : "例一覧",
    height : 200,
    width : 700,
    pager : 'pager1'
 });
    
    jQuery("#list").jqGrid('navGrid','#pager1');
    $("#list").filterToolbar({
        defaultSearch:'in'
    });
    
});
    window.addEventListener("load",function(){
        document.getElementById("send_userinfo").addEventListener("click",function(){
            var formDatas = document.getElementById("userinfo");
            var postDatas = new FormData(formDatas);
            
            var XHR = new XMLHttpRequest();
            
            XHR.open("POST","dbconnection.php",true);
            
            XHR.send(postDatas);
            
            XHR.onreadystatechange = function(){
			if(XHR.readyState == 4 && XHR.status == 200){
                var sampleStr = JSON.parse('<?php echo $php_json; ?>');
                 console.log(sampleStr);
				// POST送信した結果を表示する
                XHR.responseText;
			}
		};
        })
    })
    </script>
            <script type="text/javascript">
</script>
    <form id="userinfo">
        <input type="text" class="text" name="a">
        <button type="button" id="send_userinfo">送信</button>
    </form>
    <div id="result"></div>
<table id="list">
  </table>
    <div id ="pager1"></div>
<div id="statusbar"></div>
</body>
</html>