<?php
$roomt=$_POST['roomtype'];
$floor=$_POST['floor'];
$value = $_POST['radio'];
//データベース接続
$server2 = "localhost";
$userName2 = "root";
$password2 = "";
$dbName2 = "testtable";

$mysqli = new mysqli($server2, $userName2, $password2,$dbName2);

if ($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
}else{
    $mysqli->set_charset("UTF8");
}

if(strcmp($value, "selecttype")==0){

$sql2 = "SELECT m_classroom.m_classroom_id, m_classroomform.m_classroomform_name FROM m_classroom LEFT JOIN m_classroomform ON m_classroom.m_classroomform_id = m_classroomform.m_classroomform_id WHERE m_classroomform.m_classroomform_name=\"".$_POST['roomtype']."\";";

}else{

$sql2 = "SELECT m_classroom.m_classroom_id, m_classroomform.m_classroomform_name FROM m_classroom LEFT JOIN m_classroomform ON m_classroom.m_classroomform_id = m_classroomform.m_classroomform_id where m_classroom.m_classroom_id LIKE\"".$_POST['floor']."%\";";

}
$result = $mysqli -> query($sql2);

//クエリー失敗
if(!$result) {
    echo $mysqli->error;
    exit();
}

//レコード件数
$row_count = $result->num_rows;

//連想配列で取得
while($row2 = $result->fetch_array(MYSQLI_ASSOC)){
    $rows2[] = $row2;

}

//結果セットを解放
$result->free();

// データベース切断
$mysqli->close();

?>


<h1>出力結果</h1>


レコード件数：<?php echo $row_count; ?>
<table border='1'>
<tr>
<th>教室</th>
<th>教室タイプ</th>
</tr>

<?php
if($row_count==0){
exit();
}
foreach($rows2 as $row2){

?>
<tr>
    <td><?php echo $row2['m_classroom_id']; ?></td>
    <td><select name="roomtype">
	<option value="1" selected><?php echo $row2['m_classroomform_name']; ?></option>
	<option value="2">通常</option>
	<option value="3">PC可</option>
	<option value="4">その他</option>
	</select>
    </td>
</tr>
<?php
}
?>
</table>

</body>
</html>
