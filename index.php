<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>QR code Scan</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/comment_style.css">
    <link type="text/css" rel="stylesheet" href="css/progressbar.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script type = "text/javascript" src = "js/ratejs.js" ></script>
  <script type = "text/javascript" src = "js/post_comments.js" ></script>
  <script type = "text/javascript" src = "js/jquery.js" ></script>
  <script type = "text/javascript" src = "css/progressbar.js" ></script>

  </head>

  <body id="page-top">
  <?php  
    include('config.php');
      $post_id = '1';
  ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
          <?php
            $id=1;
            $result = mysqli_query($con, "SELECT name FROM items where id='$id'");
            while($row = mysqli_fetch_assoc($result))
            {
                echo $row['name'];
            }
            $result = mysqli_query($con, "SELECT * FROM allergens where item_id='$id'");
                global $gluten;
                global $dairy;
                global $treenuts;
                global $egg;
                global $soy;
                global $peanuts;
            while($row = mysqli_fetch_assoc($result))
            {
                $gluten= $row['gluten'];
                $dairy= $row['dairy'];
                $treenuts= $row['treenuts'];
                $egg= $row['egg'];
                $soy= $row['soy'];
                $peanuts= $row['peanuts'];
            }
            ?>
        </a>
        <table id="allergensList">
          <tr>
            <td id="td_gluten"><img src="img/Gluten.png" title="Gluten"></td>
            <td id="td_dairy"><img src="img/Dairy.png" title="Dairy"></td>
            <td id="td_treenuts"><img src="img/TreeNuts.png" title="Tree Nuts"></td>
            <td id="td_egg"><img src="img/Egg.png" title="Egg"></td>
            <td id="td_soy"><img src="img/Soy.png" title="Soy"></td>
            <td id="td_peanuts"><img src="img/Peanuts.png" title="Peanuts"></td>
          </tr>
        </table>
          <script>
            var gluten = '<?php echo $gluten ;?>';
            var dairy = '<?php echo $dairy ;?>';
            
            var treenuts='<?php echo $treenuts; ?>';
            var egg='<?php echo $egg; ?>';
            var soy='<?php echo $soy; ?>';
            var peanuts='<?php echo $peanuts; ?>';
            if (gluten==0)
              $('#td_gluten').remove();
            if (dairy==0)
              $('#td_dairy').remove();
            if (treenuts==0)
              $('#td_treenuts').remove(); 
            if (egg==0)
              $('#td_egg').remove(); 
            if (soy==0)
              $('#td_soy').remove(); 
            if (peanuts==0)
              $('#td_peanuts').remove();                        
          </script>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center" style="height:57em">
      <div class="container">
        <img id="pr-img" src="img/blue.png" width="50%" height="50%">
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
                      <p><h5>HEALTH</h5>
            <div style="text-align: center;">
              <div id="progressbar" style="display: inline-block;"">
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
                var xy = '<?php echo $health ;?>';
                //alert(ab);
                document.getElementById("progress").style.width = ab ;
                document.getElementById("progress").innerHTML = ab ;
                  if (xy >= 75 && xy<=100){
                    highHealth();
                  } else if (xy >=40 && xy<75){
                    mediumHealth();
                  } else if (xy > 0 && xy < 40){
                    lowHealth();
                  };
              </script>
              </div>
            </div>
          </p>   
      </div>
    </header>
     
    <!-- Portfolio Grid Section -->
          <div class="container" style="padding-top:3em;">
          <div class="row">
            <div class="col-lg-8 mx-auto" style="text-align: center">
                <h2 class="text-left text-uppercase text-secondary mb-0">Product Details</h2>
            </div>
          </div>
        </div>
   <section class="portfolio" id="portfolio" style="padding-top:2em">
    <div class="container">
         <div class="row">
        <div class="col-lg-8 mx-auto">
          <p>Description:
              <?php
                $result = mysqli_query($con, "SELECT description FROM items where id='$id'");
                while($row = mysqli_fetch_assoc($result))
                {
                    echo $row['description'];
                } 
            ?>
          </p>
          <p>Allergens: 
              <?php
                $result = mysqli_query($con, "SELECT allergens FROM items where id='$id'");
                while($row = mysqli_fetch_assoc($result))
                {
                    echo $row['allergens'];
                } 
            ?>
          </p>
          <p>Size: 
              <?php
                $result = mysqli_query($con, "SELECT size FROM items where id='$id'");
                while($row = mysqli_fetch_assoc($result))
                {
                    echo $row['size'];
                } 
            ?>
          </p>
          <p>Expiry: 
              <?php
                $result = mysqli_query($con, "SELECT expiry FROM items where id='$id'");
                while($row = mysqli_fetch_assoc($result))
                {
                    echo $row['expiry'];
                } 
            ?>
          </p>
        </a>
        </div>
   </div><br>
<hr>
     <!-- Form Section -->
     <section id="contact">
        <div class="container">

          <h2 class="text-center text-uppercase text-secondary mb-0">Product Reviews</h2>
          <hr class="star-dark mb-5">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <form name="sentMessage"  id="contactForm" novalidate="novalidate" onsubmit="return post();">
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>Name</label>
                    <input class="form-control" id="name" type="text" placeholder="Your Name or Alias" required="required" data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                  <div class="control-group">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <label>Message</label>
                    <textarea class="form-control" id="message" rows="5" placeholder="Your Feedback" required="required" data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <br>
                <div id="success"></div>
                <div class="form-group">
                  <input type="submit" class="btn btn-primary btn-xl" value="Post" id="sendMessageButton">
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h3>Customer Reviews</h3>
              <hr>
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
          </div>
        </div>
      </section>

   
   
     <!-- Footer -->
    
    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; QRcode 2019</small>
      </div>
    </div>

    <!-- A section visible to only small screen devices -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>

   
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>
