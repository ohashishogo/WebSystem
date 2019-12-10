<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
      <link rel="stylesheet" href="css/popup.css">
  </head>
<body>
  <div class="test">
    <div class="font"><p>教室データ登録</p></div>
  </div>
<div class="Choice">
  <p>登録データ選択</p>
  <form name="roomInfo" id="roomInfo" method="post" action="#">
  <input type="radio" name="number" value="教室" id="room1"  checked onClick="changeDisabled()" required><label for="room1">教室</label>  <!--ラジオボタン　どっちか選択-->

  <input type="radio" name="number" value="教室分類" id="room2" onClick="changeDisabled()"><label for="room2">教室分類</label></br>
  </div>

  <script type="text/javascript">

function changeDisabled() {
    if ( document.roomInfo["number"][0].checked ) {
        document . roomInfo["m_classroom_id"] . disabled = false;
        document . roomInfo["m_classroom"] . disabled = false;
        document . roomInfo["m_classroom_name"] . disabled = false;
    } else {
        document . roomInfo["m_classroom_id"] . disabled = true;
        document . roomInfo["m_classroom"] . disabled = true;
        document . roomInfo["m_classroom_name"] . disabled =  false;
    }
}
window.onload = changeDisabled;

</script>

  <p>教室</p>
  <p>教室番号<input type="text" pattern="^[0-9]+$" id="m_classroom_id"></p>
  <p>教室形態
    <select name="example" id="m_classroom">
      <option value="サンプル1">サンプル1</option>
      <option value="サンプル2">サンプル2</option>
      <option value="サンプル3">サンプル3</option>
    </select>
  </p>
  <br>
  <p>教室分類</p>
  <p>教室形態番号<input type="text" name="namae" id="m_classroomform_id"> </p>
  <p>教室形態名<input type="text" name="namae" stle="ime-mode: active;"id="m_classroom_name"></p>
  </form>
</body>
</html>
