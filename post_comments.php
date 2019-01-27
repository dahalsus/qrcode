<?php

include('config.php');
$db=mysqli_select_db($con, $mysql_database);
$id='1';
if(isset($_POST['user_comm']) && isset($_POST['user_name']))
{
  $comment=$_POST['user_comm'];
  $name=$_POST['user_name'];
  $insert=mysqli_query($con, "INSERT into comments values('','$id','$name','$comment',CURRENT_TIMESTAMP)");
  
  $id=mysqli_insert_id($con);

  $select=mysqli_query($con, "SELECT name,comment,post_time from comments where name='$name' and comment='$comment' and id='$id'");
  
  if($row=mysqli_fetch_array($select))
  {
    $name=$row['name'];
    $comment=$row['comment'];
      $time=$row['post_time'];
  ?>
      <div class="comment_div"> 
      <p class="name"><?php echo $name.' says';?></p>
        <p class="comment"><?php echo $comment;?></p> 
      <p class="time">Commented on: <?php echo $time;?></p>
    </div>
  <?php
  }
exit;
}

?>