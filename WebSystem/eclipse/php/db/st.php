<!DOCTYPE html>
<head>
    <!-- テーブル表示用jqGridの読み込み -->
    <link type="text/css" media="screen" href="jqGrid/jquery-ui.min.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="jqGrid/jquery-ui.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="jqGrid/css/ui.jqgrid.css" rel="stylesheet" />
    <meta charset="UTF-8">
<title> 生徒管理 - Web出席管理システム</title>

<!-- 共通Layoutの読み込み -->
<?php
require('../Layout/Layout.php');
?>

<div class="titlebar">
    生徒管理
    <div class="buttonWrapper">
        <button class="graduate_b" type="button" name="graduate">
            <input class="graduate_b_img" type="image" src="../Layout/image/graduate.png" alt="卒業処理"/>
                卒業処理
        </button>
        
        <button class="registration_b" type="button" name="registration">
            <input class="registration_b_img" type="image" src="../Layout/image/registration.png" alt="登録" />
                登録
        </button>
    </div>
</div>

<!-- 検索項目 -->
<div class="searchbox">
    <form id="studentInfo">
        <div class="searchbox_txtwrapper">
            <p class="searchbox_txt1">検索項目</p>
            <p class="searchbox_txt2">入学年度
            
            <p class="searchbox_txt3">学科コース
            <select id="select" name="selectName">
                <option value="sample">項目選択</option>
            </select>
            </p>
            <div class="statusbox">
                <p class="searchbox_txt4">学生状態
                <label for="a">
                    <input type="radio" name="student_status" value="enrollment" id="a" required>在学
                </label>
                <label for="b">
                    <input type="radio" name="student_status" value="graduate" id="b">卒業
                </label>
                <label for="c">
                    <input type="radio" name="student_status" value="dropout" id="c">退学
                </label>
                <label for="d">
                    <input type="radio" name="student_status" value="absencedabsence" id="d">休学
                </label></p>
            </div>
            <button class="search_b" type="button" id="search_studentInfo" name="search">検索</button>
        </div>
    </form>
</div>

<!-- 検索結果表示 -->
<div class="searchresult">
    <table id="list">
    </table>
    <div id ="pager1"></div>
    <div id="statusbar"></div>
</div>

<!-- Layout.php終了タグ -->
        </div>
        </main>

    <script type="text/javascript" src="jqGrid/jquery-3.4.1.min.js" ></script>
    <script type="text/javascript" src="jqGrid/js/jquery.jqGrid.min.js" ></script>
    <script type="text/javascript" src="jqGrid/js/i18n/grid.locale-ja.js" ></script>
    <script type="text/javascript" src="jqGrid/jquery-ui.js"></script>
    <script type="text/javascript" src="jqGridSet.js"></script>
    <script type="text/javascript" src="js/db/student.js"></script>
    <script type="text/javascript" src="js/db/studentLoad.js"></script>
    </body>
</html>