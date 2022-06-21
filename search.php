<?php
include_once 'database.php';
?>

<!DOCTYPE html>
<html>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>My Bag Ordering System : Search</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    .container{  
        /*text-align: center;*/
    } 
    .file {
        visibility: hidden;
        position: absolute;
    }
    html {
            /*width:100%;
            height:100%;*/
            /*background:url(products/bikezone.png)center center no-repeat, linear-gradient(to top left, #bdc3c7, #2c3e50) no-repeat;*/
            position: relative;
            min-height:100%;
            
        }
        body{
            margin-bottom: 60px;
            background-color: #808080
;
        }

   /* section{
        background-color: #442b22;
        }*/
        h1,p{
            color: white;
        }
        .bts {
            transition-duration: 0.4s;
            background-color: #ffc406;
        }

        .bts:hover {
            background-image:linear-gradient(#000,#997500);
            color: white;
        }
    </style>
</head>
<body style="background-image: url(https://wallpaperaccess.com/full/1668999.jpg);">
    <?php include_once 'nav_bar.php'; ?>

    <section class="container-fluid" style="background-color: #382828; padding: 3rem;text-align: center;">
        <div class="container content">
            <div class="row">
                <div class="col-md-12">
                    <h1>Tech Bags Search</h1>
                    <hr>
                    <p>Search product by Name, Price, Brand or all three.</p>
                </div>
                <div class="col-md-12">
                    <form action="search.php" method="POST" class="needs-validation">
                        <!-- <div class="form-group">
                            <input type="text" name="inputsearch" class="form-control text-center " id="inputSearch" placeholder="Chair" required>
                        </div>
                        <button class="btn btn-primary search" type="submit" name="search" style="">Search</button> -->
                        <div class="row">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control text-center" placeholder="Search for..." name="inputsearch" id="inputSearch" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default bts" type="submit" name="search" style="">Search</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- <span id="Block" class="help-block"></span> -->
                    </form>
                </div>
            </div>

        </div>
    </section>

    <!-- <section class="container resultlist" style="display:none;">
        <div class="text-center">
            <h3>Result</h3>
            <p>Found <span class="cresult">0</span> results.</p>

        </div>
        <div class="px-5 mt-md-5">
            <div class="container content">

                <?php
                //include_once 'search_products_crud.php';
                ?>
            </div>
        </div>
        <div class="row list-item"></div>
    </section> -->
    <div style="background-color: #808080;">
        <div class="container content" >

            <?php
            include_once 'search_crud.php';
            ?>
        </div>
    </div>


    <!-- <?php include_once 'footer.php'; ?> -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.browse', function() {
            var file = $(this).parent().find('.file');
            file.trigger('click');

        });
        $('inputSearch[type="file"]').change(function(event) {
            var filename = event.target.files[0].name;
            $("#file").val(filename);

            var reader = new FileReader();
            reader.onload = function (argument) {
                // body...
                document.getElementById("preview").src = argument.target.result;

            };
            //read image file as data URL
            reader.readAsDataURL(this.files[0]);
        });
    </script>

    <!-- <?php include_once 'footer.php'; ?> -->

</body>
<script async="" src="js/validate-forms.js"></script>
</html>
    <!-- <script>
        $("#search").submit(function(event) {
            event.preventDefault();

            var input = ("#inputSearch");
            var val= $(input).val();

            $(input).parent().removeClass('has-error');
            $(input).parent().find("#Block").text("");

            if (val.length > 2) {
                $.get('search_crud.php',{search: val}).done(function(res) {
                    $('.list-item').empty();

                    if (res.status==200) {
                        $('.cresult').text(res.data.length);

                        $.each(res.data, function(index, valdata) {
                             if (valdata.FLD_IMAGE=='') {
                                valdata.FLD_IMAGE=valdata.FLD_PRODUCT_ID + '.png';
                             }
                             $('.list-item').append(`<div class="col-md-4">
                                    <div class="thumbnail">
                                        <img src="products/${valdata.FLD_IMAGE}" alt="${valdata.FLD_IMAGE}" style="height:100%">
                                        <div class="caption text-center">
                                            <h3>${valdata.FLD_PRODUCT_NAME}</h3>
                                            <p>
                                                <a href="products_details.php?pid=${valdata.FLD_PRODUCT_ID}" class="btn btn-primary" role="button">View</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>`);
                        });

                    }
                });
                $(".resultlist").show("slow");
            }else{
                input.parent().addClass("has-error");
                input.parent().find("#Block").text("Please enter more than 2 characters.");

                $('.list-item').empty();
            }
        });
    </script> -->