<?php
$link=mysql_connect("localhost","username","pass");
mysql_select_db("whiteBlog",$link);

$sql="Select count(*) From article"; //count all record in the table
$rs=mysql_query($sql);
$total_rec=mysql_result($rs,0,0); // keep all record in $total_page
$p_size=3; // display perpage
$total_page=(int)($total_rec/$p_size);
//divide all pages 
if(($total_rec % $p_size)!=0){ // if get some decimal point plus one more page 
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
//use limit funtion to display data form Mysql
$rs=mysql_query($sql);
while($result=mysql_fetch_array($rs)){ //loop to display all data
    $title = $result["title"];
    
    echo("$title<br/>");
}
for($i=1;$i<=$total_page;$i++){ //link to display page
   echo "<a href=".$_SERVER['PHP_SELF']."?page=".$i."> ".$i."</a> ";
}

?>
