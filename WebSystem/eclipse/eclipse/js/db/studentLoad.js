$(document).ready( function(){
    var formDatas = document.getElementById("studentInfo");
    var postDatas = new FormData(formDatas);

	var XHR = new XMLHttpRequest();
    
    // 生徒の検索(DB接続)を行うphpファイルを呼び出す        
    XHR.open("POST","./php/db/studentLoad.php",true);
    XHR.send(postDatas);

    // selectタグを取得する
 	var select = document.getElementById("select");
                        
    XHR.onreadystatechange = function(){
    	if(XHR.readyState == 4 && XHR.status == 200){
    		// jqGrid表示用のデータ配列を用意
    		let studentData =[];
    		// 検索結果のデータをJson形式から配列に変換
        	let studentDate = JSON.parse(XHR.responseText);

    		for(let i = 0; i < Object.keys(studentDate).length; i++){
    		// optionタグを作成する
 			var option = document.createElement("option");
       		// optionタグのテキストを4に設定する
        	option.text = studentDate[i+1] + " | " +studentDate[i];
        	// optionタグのvalueを4に設定する
        	option.value = studentDate[i+1] + " | " +studentDate[i];
        	// selectタグの子要素にoptionタグを追加する
        	select.appendChild(option);
        	i++;
        	}
    	};

	}

});
