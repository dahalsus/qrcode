<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Cheese</title>
<link type="text/css" rel="stylesheet" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/comment_style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type = "text/javascript" src = "js/ratejs.js" ></script>
<script type = "text/javascript" src = "js/post_comments.js" ></script>
</head>

<body>
<?php  
	include('config.php');
    $post_id = '1';
?>
  <div style="margin-left:12%"><h2 align="left">Feedback</h2></div>
  <form method='post' action="" onsubmit="return post();">
  <textarea id="comment" placeholder="Write Your Comment Here....."></textarea>
  <br>
  <input type="text" id="username" placeholder="Your Name">
  <br>
  <input type="submit" value="Post Comment">
  </form>

  <div id="all_comments">
  <?php
    include('config.php');

    $comm = mysqli_query($con, "select name,comment,post_time from comments order by post_time desc");
    while($row=mysqli_fetch_array($comm))
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
    ?>
  </div>
  </div>
</body>
</html>