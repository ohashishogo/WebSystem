<?php

//データベース接続
$server = "localhost";
$userName = "root";
$password = "";
$dbName = "testtable";

$mysqli = new mysqli($server, $userName, $password,$dbName);

if ($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
}else{
    $mysqli->set_charset("utf-8");
}

$sql = "SELECT * FROM m_class";

$result = $mysqli -> query($sql);

//クエリー失敗
if(!$result) {
    echo $mysqli->error;
    exit();
}

//レコード件数
$row_count = $result->num_rows;

//連想配列で取得
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $rows[] = $row;
}

//結果セットを解放
$result->free();

// データベース切断
$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
<title>テーブル出力</title>
<meta charset="utf-8">
</head>
<body>
<h1>クラスマスタ出力結果</h1>


レコード件数：<?php echo $row_count; ?>
<table border='1'>
<tr>
<th>年度</th>
<th>クラス</th>
<th>出席番号</th>
<th>学籍番号</th>
</tr>

<?php
foreach($rows as $row){
?>
<tr>
    <td><?php echo $row['m_class_year']; ?></td>
    <td><?php echo $row['m_class_id']; ?></td>
  <td><?php echo $row['m_class_studentid']; ?></td>
  <td><?php echo $row['m_student_id']; ?></td>
</tr>
<?php
}
?>

</table>

</body>
</html>