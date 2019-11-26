<!DOCTYPE html>
<html>
<head>
<link type="text/css" media="screen" href="jqGrid/jquery-ui.min.css" rel="stylesheet" />
<link type="text/css" media="screen" href="jqGrid/jquery-ui.css" rel="stylesheet" />
<link type="text/css" media="screen" href="jqGrid/css/ui.jqgrid.css" rel="stylesheet" />
<script type="text/javascript" src="jqGrid/jquery-3.4.1.min.js" ></script>
<script type="text/javascript" src="jqGrid/js/jquery.jqGrid.min.js" ></script>
<script type="text/javascript" src="jqGrid/js/i18n/grid.locale-ja.js" ></script>
<script type="text/javascript" src="jqGrid/jquery-ui.js"></script>
<meta charset="utf-8" />
<link rel="stylesheet" href="stylesheet2.css">
<title>テーブルサンプル</title>
</head>
<body>
	<script type="text/javascript">
        window.addEventListener("load",function(){
        document.getElementById("send_userinfo").addEventListener("click",function(){
            var formDatas = document.getElementById("userinfo");
            var postDatas = new FormData(formDatas);

            var XHR = new XMLHttpRequest();

            XHR.open("POST","dbconnection(ローカル).php",true);

            XHR.send(postDatas);

            XHR.onreadystatechange = function(){
			if(XHR.readyState == 4 && XHR.status == 200){
				// POST送信した結果を表示する
		var a = XHR.responseText;
                a = JSON.parse(a);
                var ifd = 1;
                     // dbから取得したデータをセット
                var myNewData =[];
                for (var i=0,l=a.length; i<l; i++) {
                myNewData.push({comp_code:a[i],comp_name:a[i+1]});
                i++;//次のデータへいく
}
                //jqGridの設定
                jQuery(document).ready(function()
    {
    myNewData;
 })
    var colModelSettings = [
    {name:'comp_code'},
    {name:'comp_name'},
    ]

jQuery("#list").jqGrid({
    data: myNewData,
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

};

			}
		});
        })



    </script>


	<?php
		 include 'Layout.html'
	 ?>
	 <form id="userinfo">
        <input type="text" class="text" name="a">
        <button type="button" id="send_userinfo">送信</button>
    </form>
    <div id="result"></div>
<table id="list">
  </table>
    <div id ="pager1"></div>
<div id="statusbar"></div>
<div id="result"></div>
<div id="userinfo_response"></div>
 </div>
</body>
</html>
