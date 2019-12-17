    // idが"search_studentInfo"のbuttonをclick時イベント
    window.addEventListener("load",function(){
        document.getElementById("search_studentInfo").addEventListener("click",function(){
            var formDatas = document.getElementById("studentInfo");
            var postDatas = new FormData(formDatas);

            var XHR = new XMLHttpRequest();

            // 生徒の検索(DB接続)を行うphpファイルを呼び出す
            XHR.open("POST","./php/db/dbconnection.php",true);

            XHR.send(postDatas);

            XHR.onreadystatechange = function(){
        	   if(XHR.readyState == 4 && XHR.status == 200){
                    // jqGrid表示用のデータ配列を用意
                    let studentData =[];
                    // フィールドの列数を設定
                    let fieldCount = 2;

        	        // 検索結果のデータをJson形式から配列に変換
                    let studentDate = JSON.parse(XHR.responseText);


                    // dbから取得したデータを格納していく
                    for (let i=0,l=studentDate.length; i<l; i++) {
                        studentData.push({comp_code:studentDate[i],comp_name:studentDate[i+1]});
                        i++;//次のデータへいく

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
            setData;
        })

        // テーブルの列名
        var colModelSettings = [
            {name:'comp_code'},
            {name:'comp_name'},
            {name:'edit', align: 'center', sortable: false, width: 40, formatter: function(){ return "<button type='button' name='button' value='button'><font size='2' color='#333399'>edit</font></button>";}}
        ]

        jQuery("#list").jqGrid({
            data: setData,
            datatype: "local", //localなのは
            colNames:['id', 'Text', 'edit'],
            colModel:colModelSettings,
            rowNum : 10,
            rowList : [1, 5, 10],
            caption : "例一覧",
            height : 200,
            width : 700,
            pager : 'pager1',
            beforeSelectRow: function (rowid, e) {
                var $self = $(this),
                $td = $(e.target).closest("td"),
                rowid = $td.closest("tr.jqgrow").attr("id"),
                iCol = $.jgrid.getCellIndex($td[0]),
                cm = $self.jqGrid("getGridParam", "colModel");
            if (cm[iCol].name === "edit") {
            alert('Edit id: ' + rowid);
            return false; // don't select the row on click
        }
        return true;
    }
        });

        jQuery("#list").jqGrid('navGrid','#pager1');

         $("#list").filterToolbar({
            defaultSearch:'in'
        });
    }
