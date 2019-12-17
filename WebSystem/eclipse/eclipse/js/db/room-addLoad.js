// 画面表示時に処理される。
$(document).ready( function(){
    var formDatas = document.getElementById("roomInfo");
    var postDatas = new FormData(formDatas);

	var XHR = new XMLHttpRequest();

    // 生徒の検索(DB接続)を行うphpファイルを呼び出す
    XHR.open("POST","./php/db/room-addLoad.php",true);
    XHR.send(postDatas);

    // selectタグを取得する
 	  var select = document.getElementById("m_classroomform");

    XHR.onreadystatechange = function(){
    	if(XHR.readyState == 4 && XHR.status == 200){
    		// postデータ格納用配列を用意
    		let studentData =[];
    		// 検索結果のデータをJson形式から配列に変換
        let studentDate = JSON.parse(XHR.responseText);

            // 取得データの数だけ、リストボックスに格納していく
    		for(let i = 0; i < Object.keys(studentDate).length; i+=2){
    		// optionタグを作成する
 			    var option = document.createElement("option");
       		// optionタグのテキストを「コース|学科名称」に設定する
        	option.text = studentDate[i+1] + " | " +studentDate[i];
        	// optionタグのvalueを「コース|学科名称」に設定する
        	option.value = studentDate[i+1] + " | " +studentDate[i];
        	// selectタグの子要素にoptionタグを追加する
        	select.appendChild(option);
        	}
    	};

	}

});
