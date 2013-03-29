<?php
$link=mysql_connect("localhost","root","n");
mysql_select_db("whiteBlog",$link);

$sql="Select count(*) From article"; //นับจำนวน Record ทั้งหมดใน Table
$rs=mysql_query($sql);
$total_rec=mysql_result($rs,0,0); // เก็บจำนวน Record ทั้งหมดไว้ใน $total_page
$p_size=3; //กำหนดจำนวน Record ที่จะแสดงผลต่อ 1 เพจ
$total_page=(int)($total_rec/$p_size);
//ทำการหารหาจำนวนหน้าทั้งหมดของข้อมูล ในที่นี้ให้หารออกมาเป็นเลขจำนวนเต็ม
if(($total_rec % $p_size)!=0){ //ถ้าข้อมูลมีเศษให้ทำการบวกเพิ่มจำนวนหน้าอีก 1
   $total_page++;
}
if(empty($_GET['page'])){

   $page=1;
   $start=0;
}else{

   $page=$_GET['page'];
   $start=$p_size*($page-1);
}
$sql="Select * From article LIMIT $start , $p_size";
//ใช้ Option LIMIT ของ MySQL เพื่อทำการเลือกข้อมูลออกมาตามต้องการ
$rs=mysql_query($sql);
while($result=mysql_fetch_array($rs)){ //วนรอบแสดงข้อมูล
    $title = $result["title"];
    
    echo("$title<br/>");
}
for($i=1;$i<=$total_page;$i++){ //สร้าง Link เพื่อให้ผู้ใช้งานเลือกชมหน้าข้อมูล
   echo "<a href=".$_SERVER['PHP_SELF']."?page=".$i."> ".$i."</a> ";
}

?>
