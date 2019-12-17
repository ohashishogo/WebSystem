// idが"search_studentInfo"のbuttonをclick時イベント
window.addEventListener("load",function(){
    document.getElementById("search_roomInfo").addEventListener("click",function(){
        var formDatas = document.getElementById("roomInfo");
        var postDatas = new FormData(formDatas);

        var XHR = new XMLHttpRequest();

        // 生徒の検索(DB接続)を行うphpファイルを呼び出す
        XHR.open("POST","./php/db/room.php",true);

        XHR.send(postDatas);

        XHR.onreadystatechange = function(){
         if(XHR.readyState == 4 && XHR.status == 200){
                // jqGrid表示用のデータ配列を用意
                let studentData =[];
                // フィールドの列数を設定
                let fieldCount = 2;

                console.log(XHR.responseText);
              // 検索結果のデータをJson形式から配列に変換
                let studentDate = JSON.parse(XHR.responseText);


                // dbから取得したデータを格納していく
                for (let i=0,l=studentDate.length; i<l; i+=6) {
                    studentData.push({m_student_id:studentDate[i],m_student_lastname:studentDate[i+1],m_student_firstname:studentDate[i+2],m_subject_name:studentDate[i+3],m_course_name:studentDate[i+4],m_student_status:studentDate[i+5]});

                }
                // データ配列をjqGrid用配列に格納
                setData = studentData;

                jqGridDataSet();

            };

      }
});
})

function jqGridDataSet() {
    jQuery(document).ready(function() {

        //$("input:submit, a, button", ".toolbar").button();

        // テーブルの列名
        var colModelSettings = [
            {name:'m_student_id', align: 'center', width: 100},
            {name:'m_student_lastname', align: 'center', width: 200, editable:true, editoptions:{maxlength:50}},
            {name:'m_student_firstname', align: 'center', width: 200, editable:true, editoptions:{maxlength:50}},
            {name:'m_subject_name', align: 'center', width: 150},
            {name:'m_course_name', align: 'center', width: 150},
            {name:'m_student_status', align: 'center', width: 50},
            {name:'edit', align: 'center', sortable: false, width: 40, formatter: function(){ return "<button type='button' name='button' value='button'><font size='2' color='#333399'>edit</font></button>";}}
        ]

        var savedCol = null;
        var savedRow = null;

        jQuery("#list").jqGrid({
            data: setData, // 表示するデータ配列
            datatype: "local",  // データの取得方法
            colNames:['学籍番号', '姓', '名', '学科名称', 'コース名称', '生徒状態', '詳細'], // レコード名
            colModel:colModelSettings, // レコードの設定
            pager : '#pager1',
            rowNum : 10, // 行数
            rowList : [1, 5, 10], // 行数の指定種類
            regional: 'ja',
            caption : "生徒一覧", // 表のタイトル
            height : 475, // 表の高さ
            width : 1655, // 表の幅
            cellEdit: true,  // セルの直接編集
            beforeEditCell: function (rowid, cellname, value, iRow, iCol) {
                // クリックされたセルを記録
                savedRow = iRow;
                savedCol = iCol;
            },
                            rownumber:true,    // 行番号を表示
            viewrecords: true,    // フッターに行数を表示する
            cellsubmit: 'clientArray',
            // scroll : true,
            sortname : 'm_student_id',
            sortorder : "ASC",
            autoencode : true,
            multiselect: true,
            // 1行ごとに色を付ける
            loadComplete: function () {
                var rowIDs = jQuery("#list").getDataIDs();
                $.each(rowIDs, function (i, item) {
                    if (i % 2 == 0) {
                        $('#'+item).removeClass('ui-widget-content');
                        $('#'+item).addClass('testcss');
                    }
                });
            },
            //fixed: true,
            //autoWidth: false,
            //shrinkToFit: false,
            // 表内クリック時イベント
            beforeSelectRow: function (rowid, e) {
                var $self = $(this),
                $td = $(e.target).closest("td"),
                rowid = $td.closest("tr.jqgrow").attr("id"),
                iCol = $.jgrid.getCellIndex($td[0]),
                cm = $self.jqGrid("getGridParam", "colModel");

                // 列がeditかつボタンまたはボタンの文字をクリックしたときのイベント
                // 生徒の詳細画面を出す
                if (cm[iCol].name === "edit" && (e.target.tagName.toUpperCase() === "BUTTON" || e.target.tagName.toUpperCase() === "FONT")) {
                    var post_student_id = $('#list').getRowData(rowid).m_student_id;  //2行目のデータを取得
                    // 新規画面表示用jsを読み込む
                    $.getScript("editWindow.js");
                    // editボタンを押下データのidを渡して画面を表示させる
                    editWindow(post_student_id, 'php/student-edit.php', 500, 600);
                    return false; // don't select the row on click
                }
            return true;
            }
        });

        //$("#sendGrid").click(function() {
        // 未保存のセルを送信前に強制保存してしまう。

        //})


        jQuery("#list").jqGrid('navGrid','#pager1',{ add:false, edit:false, del:false, search:false, refresh:false })

        // データの編集用ボタン
        .navButtonAdd("#pager1",{
            caption:"",
            buttonicon :'ui-icon-plus',
            onClickButton:function() {
                if (savedRow && savedCol) {
                    jQuery("#list").jqGrid('saveCell', savedRow, savedCol);
                }

                // グリッド内の選択されているデータを配列に取り込む
                var rowIds = $("#list").getGridParam('selarrrow');

                if (rowIds.length == 0) {
                    alert("データを選択してください。");
                    return false;
                }

                var ret = confirm("選択した内容をサーバー保存します。よろしいですか？");

                if (!ret) {
                    return false;
                }

                var values = new Array();

                for (var i = 0; i < rowIds.length; i++) {
                    var row = $('#list').getRowData(rowIds[i]);
                    values[i] = new Array(row.m_student_lastname, row.m_student_firstname);
                }

                $.ajax({
                    type: "POST",
                    url: "js/db/jqgrid_postdata.php",
                    async: false,
                    data: {
                        num:values.length,
                        dat:values
                    },
                    success: function(data, dataType) {
                        confirm("サーバーへ送信しました。送信された内容を表示しますか？");
                        alert(data);
                    },
                    error: function(res, textStatus, xhr) {
                        alert("サーバーとの通信に失敗しました。");
                    },
                    dataType: "text"
                });

                return true;

            }
        })

        $("#list").filterToolbar({
            defaultSearch:'in'
        });
    })
}
