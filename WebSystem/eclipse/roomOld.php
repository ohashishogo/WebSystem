<!DOCTYPE html>
<html>
<head>
<link type="text/css" media="screen" href="jqGrid/jquery-ui.min.css" rel="stylesheet" />
<link type="text/css" media="screen" href="jqGrid/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" href="stylesheet.css">
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
									myNewData.push({m_classroom_id:a[i],m_classroomform_id:a[i+1],m_classroom_name:a[i+2]});
									i += 2;//次のデータへいく
}
                //jqGridの設定
                jQuery(document).ready(function()
    {
    myNewData;
 })
    var colModelSettings = [
			{name:'m_classroom_id'},
      {name:'m_classroomform_id'},
{name:'m_classroom_name'},
    ]

jQuery("#list").jqGrid({
    data: myNewData,
    datatype: "local", //localなのは
    colNames:['教室番号', '教室形態番号','教室形態名称'],
    colModel:colModelSettings,
    rowNum : 10,
    rowList : [1, 5, 10],
    caption : "教室一覧",
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
	 <!-- 生徒管理の文字列を少し右に寄せる -->
		 <div class="titlebar">教室管理
			 <div class="buttonWrapper">
				 <button class="graduate_b" type="button" name="graduate">
					 <input class="graduate_b_img" type="image" src="image/graduate.png" alt="卒業処理"/>
					 卒業処理
				 </button>
				 <button class="registration_b" type="button" name="registration">
					 <input class="registration_b_img" type="image" src="image/registration.png" alt="登録" />
					 登録
				 </button>
			 </div>
		 </div>
			 <div class="searchbox">
				 <form id="userinfo">
			        <input type="text" class="text" name="a">
			        <button type="button" id="send_userinfo">検索</button>
			    </form>
 </div>
 <table id="list">
	 </table>
		 <div id ="pager1"></div>
		 <div id="statusbar"></div>
 </div>

</main>
</body>
</html>
