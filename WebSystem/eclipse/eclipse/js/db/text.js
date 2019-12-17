<script>
function clickBtn1(){
 const m_classroomform = document.roomInfo.m_classroomform;

// 値(数値)を取得
const num = m_classroomform.selectedIndex;
//const num = document.form1.color1.selectedIndex;

// 値(数値)から値(value値)を取得
const str = m_classroomform.options[num].value;
//const str = document.form1.color1.options[num].value;

document.getElementById("m_classroomform").textContent = str;
}
</script>
