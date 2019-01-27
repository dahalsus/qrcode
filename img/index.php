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

<div class="container">
  <h1>
    <?php
    $id=1;
        $result = mysqli_query($con, "SELECT name FROM items where id='$id'");
    while($row = mysqli_fetch_assoc($result))
    {
        echo $row['name'];
    } 
    ?>
</h1>
  <div>
    <?php
        $result = mysqli_query($con, "SELECT description FROM items where id='$id'");
    while($row = mysqli_fetch_assoc($result))
    {
        echo 'Description: '.$row['description'];
    } 
    ?>
      
    </div>
  <div>
    <?php
        $result = mysqli_query($con, "SELECT img_url FROM items where id='$id'");
    while($row = mysqli_fetch_assoc($result))
    {
        echo '<img src="'.$row['img_url'].'" />';
    } 
    ?>
  </div>
  <div>Health</div>
  <div>
    <div id="progressbar">
      <div id="progress">25%</div>
    <?php
      global $health;
      $qr = mysqli_query($con,"SELECT * FROM items where id='$id'"); 
        while($data = mysqli_fetch_assoc($qr)){
              $health = $data['health'];
          };         
      $health=($health/10)*100;
    ?>
    <script>
      var ab = '<?php echo $health."%" ;?>';
      //alert(ab);
      document.getElementById("progress").style.width = ab ;
      document.getElementById("progress").innerHTML = ab ;
    </script>
    </div>
  </div>
	<div class="rate">
		<div id="1" class="btn-1 rate-btn"></div>
        <div id="2" class="btn-2 rate-btn"></div>
        <div id="3" class="btn-3 rate-btn"></div>
        <div id="4" class="btn-4 rate-btn"></div>
        <div id="5" class="btn-5 rate-btn"></div>
	</div>
<br>
    <div class="box-result">
    	<?php
        	$query = mysqli_query($con,"SELECT * FROM ratings"); 
            	while($data = mysqli_fetch_assoc($query)){
                    $rate_db[] = $data;
                    $sum_rates[] = $data['rate'];
                }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
        ?>
    <div class="result-container">
    	<div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
        <div class="rate-stars"></div>
    </div>
        <p style="margin:5px 0px; font-size:16px; text-align:center">Rated <strong><?php echo substr($rate_value,0,3); ?></strong> out of <?php echo $rate_times; ?> Review(s)</p>
    </div>

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