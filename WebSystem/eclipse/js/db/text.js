// 変数testに、入力不可にしたい項目を定義
var target = document.getElementById("input1","input2");
var target2 = document.getElementById("input3","input4");

// 変数testの要素を入力不可にする
target.disabled = true;

// 変数triggerに、入力不可を解除するきっかけにしたい項目を定義
var trigger = document.getElementById("room1");

// 入力不可を解除する条件を定義
trigger.addEventListener("click", function(){
    if(trigger.checked){
      // ここに条件をクリアした時の動作を入れる
      target.disabled = false;
      target2.disabled = true;
       }
  }, false);

// 変数trigger2に、入力不可を解除するきっかけにしたい項目を定義
var trigger2 = document.getElementById("room2");

// 入力不可を解除する条件を定義
trigger2.addEventListener("click", function(){
    if(trigger2.checked){
      // ここに条件をクリアした時の動作を入れる
      target.disabled = true;
      target2.disabled = false;
       }
  }, false);

//input2
