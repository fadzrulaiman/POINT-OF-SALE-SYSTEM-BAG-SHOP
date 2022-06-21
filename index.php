<?php
require 'database.php';

if (!isset($_SESSION['loggedin']))
    header("LOCATION: login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>TechBags Ordering System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url(https://wallpaperaccess.com/full/1668999.jpg);">


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">TechBags</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="products.php">Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="customers.php">Customers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="staffs.php">Staff</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="orders.php">Orders</a>
      <li class="nav-item">
        <a class="nav-link" href="search.php">Search</a>
      </li>    
    </ul>
    <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo $_SESSION['user']['fld_staff_role'] . ' | ' . $_SESSION['user']['fld_staff_name']; ?> <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
  </div>  
</nav>
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-4">
      <h2>The Company Logo</h2>
      <div class="img"><img src="icon.png" height="180px" width="170px"></div>
      <p>A Local Malaysian Brand That Is In The Rising</p>
      <h5>Our Social Media</h5>
      <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link " href="https://www.facebook.com/"><img src="facebook.png"> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.instagram.com/"><img src="instagram.png"></a>
        </li>
    
        <li class="nav-item">
          <a class="nav-link " href="https://twitter.com/?lang=en"><img src="twitter.png"></a>
        </li>
      </ul>
      <hr class="d-sm-none">
    </div>
    <div class="col-sm-8">
      <h2>Our Product</h2>
      <div class="img"><img src="background.png" height="100%" width="110%"></div>
      <h4>Supreme Quality</h4>
      <h6>The products that we sell are above than high quality due to the excellent jobs that had been done by our staff to choose the right quality for our beloved customers. Not only that we are also on our way to become a top brand in selling branded and high quality computer bags</h6>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>TechBags.Co</p>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script>
    $("#searchForm").submit(function (e) {
        e.preventDefault();

        var input = $("#inputSearch");
        var val = input.val();

        input.parent().removeClass('has-error');
        input.parent().find("#helpBlock2").text("");

        if (val.length > 2) {
            $.ajax({
                url: 'ajax/search.php',
                type: 'get',
                dataType: 'json',
                data: {
                    search: val
                },
                beforeSend: function () {
                    $("body").addClass('loading');
                    input.addClass('disabled');
                },
                success: function (res) {
                    $('.list-item').empty();

                    if (res.status == 200) {
                        $(".result-count").text(res.data.length);

                        $.each(res.data, function (idx, data) {
                            if (data.FLD_PRODUCT_IMAGE === '')
                                data.FLD_PRODUCT_IMAGE = data.FLD_PRODUCT_ID + '.png';

                            $('.list-item').append(`<div class="col-md-4">
                                <div class="thumbnail thumbnail-dark">
                                <img src="products/${data.FLD_PRODUCT_IMAGE}" alt="${data.FLD_PRODUCT_NAME}" style="height: 345px;">
                                <div class="caption text-center">
                                <h3>${data.FLD_PRODUCT_NAME}</h3>
                                <p>
                                <a href="products_details.php?pid=${data.FLD_PRODUCT_ID}" class="btn btn-primary" role="button">View</a>
                                </p>
                                </div>
                                </div>
                                </div>`);
                        });

                        $(".resultList").show("slow", function () {
                            $("body").removeClass('loading');

                            $('html, body').animate({
                                scrollTop: $("#resultSection").offset().top
                            }, 500);
                        });
                    }
                },
                complete: function () {
                    input.removeClass('disabled');
                }
            });
        } else {
            input.parent().addClass("has-error");
            input.parent().find("#helpBlock2").text("Please enter more than 2 characters.");

            $('.list-item').empty();
        }
    });
</script>

</body>
</html>
