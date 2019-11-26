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
    <script type="text/javascript" src="jqGrid/jquery-ui.js"></script>
<meta charset="UTF-8">
<title>Insert title here</title>
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
</body>
</html>
