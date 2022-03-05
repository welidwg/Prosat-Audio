<?php
$current = "home";
require_once("./mainNav.php");
require_once("../Scripts/utiles.php");
$connect = Connect();
if (!isset($_SESSION["login"])) {
  $views = mysqli_fetch_array(mysqli_query($connect, "SELECT * from views"));
  $old = $views[0];
  $new = $old += 1;
  mysqli_query($connect, "UPDATE views SET nViews=$new");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prosat audio | home</title>
  <style>
    .icon-tab {
      margin-top: 30px;

      text-align: center;
      cursor: pointer;
    }

    .icon-tab span.glyphicon {
      display: block;
      font-size: 35px;

      color: #8d98b8;

      margin: 0px auto;
      line-height: 65px;

      transition-duration: 0.25s;
    }









    .icon-label {
      color: #b3b3b3;
      font-size: 16px;

      transition-duration: 0.35s;
    }


    .icon-tab.active .icon-label,
    .icon-tab:hover .icon-label {
      color: black;
    }

    .icon-tab:hover span.glyphicon {
      margin-bottom: 10px;
    }


    .item {
      margin-top: 50px;
    }


    @media (max-width:767px) {
      .icon-tab {}

      .icon-tab span {
        display: inline !important;
        vertical-align: middle;
      }

      .icon-tab.active span.glyphicon {
        padding-right: 10px;
      }

      .icon-tab:hover span.glyphicon {
        padding-right: 10px;
        transition-duration: 0.25s;
      }
    }
  </style>
</head>
<script>
  $('#myCarousel').carousel({
    interval: 3000,
  })
  $(function() {
    $('div.icon-tab').click(function() {
      $(this).addClass('active').siblings().removeClass('active');
      setDisplay(450);
    });

    function setDisplay(time) {
      $('div.icon-tab').each(function(rang) {
        $('.item').eq(rang).css('display', 'none');

        if ($(this).hasClass('active')) {
          $('.item').eq(rang).fadeIn(time);
        }
      });
    }

    //Disable the animation on page load
    setDisplay(0);
  });
</script>


<body>
  <section class="clean-block clean-catalog dark">

    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <?php
        $first = runQuery("SELECT * from products order by addDate desc limit 1");
        $array = runQuery("SELECT * from products order by addDate desc limit 1,2");
        if (!empty($array) && !empty($first)) {
          $firstPic = explode(",", $first[0]["pictures"])[0];
        ?>
          <style>
          </style>
          <div class="carousel-item active">
            <div class="mask flex-center">
              <div class="container">
                <div class="row align-items-center">
                  <div class="col-md-6  col-12 order-md-1 order-2 mt-5" style="position: relative;float: left;top:5vw;left:5vw">
                    <h4>
                      <?= $first[0]["name"] ?>

                    </h4>
                    <p><?= $first[0]["details"] ?></p>
                    <a href="./productDetails?prod=<?= $first[0]["product_id"] ?>">Details</a>
                  </div>
                  <div class="col-md-6 col-12 order-md-4 order-1 mt-5" style="position: relative;float: right;top: 5vw;">
                    <img style="border-radius: 50%;
            border: 4px solid #ccc;
            max-height: 250px;
            height: 250px;
            width: 250px;background-color: white;" src="../assets/img/uploads/products/<?= $firstPic ?>" class="mx-auto customImg" alt="slide">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
          foreach ($array as $k => $v) {
            $pic = explode(",", $array[$k]["pictures"])[0];
            # code...
          ?>
            <div class="carousel-item ">
              <div class="mask flex-center">
                <div class="container">
                  <div class="row align-items-center">
                    <div class="col-md-6 col-12 order-md-1 order-2  mt-5" style="position: relative;float: left;top:5vw;left:5vw">
                      <h4><?= $array[$k]["name"] ?></h4>
                      <p><?= $array[$k]["details"] ?></p>
                      <a href="./productDetails?prod=<?= $array[$k]["product_id"] ?>">Details</a>
                    </div>
                    <div class="col-md-6 col-12 order-md-4 order-1 mt-5" style="position: relative;float: right;top: 5vw;"><img style="border-radius: 50%;
            border: 4px solid #ccc;
            max-height: 250px;
            height: 250px;
            width: 250px;background-color: white;" src="../assets/img/uploads/products/<?= $pic ?>" class="mx-auto" alt="slide"></div>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
        } else { ?>
          <div class="carousel-item active">
            <div class="mask flex-center">
              <div class="container">
                <div class="row align-items-center">
                  <div class="col-md-6  col-12 order-md-1 order-2 mt-5" style="position: relative;float: left;top:5vw;left:5vw">
                    <h4>Product Example</h4>
                    <p>Until you add some products , this will be shown as an example</p>
                    <a href="#">Details</a>
                  </div>
                  <div class="col-md-6 col-12 order-md-4 order-1 mt-5" style="position: relative;float: right;top: 5vw;"><img style="border-radius: 50%;
            border: 4px solid #ccc;
            max-height: 250px;
            height: 250px;
            width: 250px;" src="https://i.imgur.com/NKvkfTT.png" class="mx-auto " alt="slide"></div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>


      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
    </div>
    <!--slide end-->
  </section>
  </div>

</body>
<?php include_once("./footer.php"); ?>

</html>