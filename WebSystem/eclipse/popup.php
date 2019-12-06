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
  <input type="radio" name="room" value="教室" id="room1" required><label for="room1">教室</label>  <!--ラジオボタン　どっちか選択-->
  <input type="radio" name="room" value="教室分類" id="room2"><label for="room2">教室分類</label></br>
  </div>

  <p>教室</p>
  <p>教室番号  <input type="text"  id="input1","input2" value=""></p>



  <p>教室形態
    <select name="example">
<option value="サンプル1">サンプル1</option>
<option value="サンプル2">サンプル2</option>
<option value="サンプル3">サンプル3</option>

</select>


  </p>

  <tr>
      <td><input  type="text" name="namae" id="input1" value=""></td>
  </tr>

  <br>
  <p>教室分類</p>
  <p>教室形態番号 <input type="text" name="namae"> </p>
  <p>教室形態名  <input type="text" name="namae"></p>
<script type="text/javascript" src="js/db/text.js"></script>
</body>
</html>
