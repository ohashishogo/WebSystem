window.addEventListener("load",function(){
    document.getElementById("add-roomInfo",).addEventListener("click",function(){
        var XHR = new XMLHttpRequest();
        var m_classroom_id =  document.getElementById('m_classroom_id').value;
        var m_classroomform_id =  document.getElementById('m_classroomform_id').value;
        var m_classroom_name =  document.getElementById('m_classroom_name').value;

        var postData = new FormData();

        postData.append('m_classroom_id', m_classroom_id);
        postData.append('m_classroomform_id', m_classroomform_id);
        postData.append('m_classroom_name', m_classroom_name);



        // 生徒の検索(DB接続)を行うphpファイルを呼び出す
        XHR.open("POST","./php/db/room-add.php",true);

        XHR.send(postData);

        XHR.onreadystatechange = function(){
         if(XHR.readyState == 4 && XHR.status == 200){


              }
            }

    });

})
