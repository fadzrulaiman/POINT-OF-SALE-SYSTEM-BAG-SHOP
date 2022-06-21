<?php

include_once 'database.php';

try {

    $result = "";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //Create
    if (isset($_POST['search'])) {

    //This array will be used to store temporary
        $dataArray = array();
        $count = 0;

        $input_data = explode(" ", $_POST['inputsearch']);

        ?>
            <center>
                <div class="row" style="display: inline-block; overflow: hidden;">
                <h2 class="mb-4 p-3 bg-secondary text-white" style="color: black;float: left;">Result For : </h2>
                    <h2 style="color: #000000;float: right;"> 
                <?php
                for ($index = 0; $index < count($input_data); $index++) {
                    echo $input_data[$index] . "";
                    echo " ";
                }
                ?>
                    </h2>
                
            </div>
            </center>
            
        <?php

        try {

            if (count($input_data) >= 1) {

                ?>
                <div class="thumbnail" style="background-color:white;">
                    <div>
                        <table class="table table-striped">
                            <thead style="background-color: #00FFFF;">
                                <tr class="small">
                                    <th scope="col" style="width: 8%;">Product ID</th>
                                    <th scope="col" style="width: 10%;">Name</th>
                                    <th scope="col" style="width: 6%;">Price</th>
                                    <th scope="col" style="width: 10%;">Brand</th>
                                    <th scope="col" style="width: 10%;">Size</th>
                                    <th scope="col" style="width: 10%">Fabric</th>
                                    <th scope="col" style="width: 6%;">Colour</th>
                                    <th scope="col" style="width: 10%;">Ship From</th>
                                    <!-- <th scope="col" style="width: 6%;">Stock</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                for ($index = 0; $index < count($input_data); $index-=-1) {

                                    $stmt = $conn->prepare("SELECT * FROM  tbl_products_a174485_pt2 WHERE fld_product_name LIKE :first_string OR fld_product_price LIKE :first_string OR fld_product_brand LIKE :first_string");

                                    $stmt->bindParam(':first_string', $first_string, PDO::PARAM_STR);

                                    $first_string = $input_data[$index];
                                    $first_string = "%$first_string%";

                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($result as $readrow) {
                                        if (empty($dataArray)) {

                                            $dataArray[$count] = $readrow['fld_product_num'];
                                            $count++;
                                            ?>
                                            <tr class="small">
                                                <td><?php echo $readrow['fld_product_num']; ?></td>
                                                <td><?php echo $readrow['fld_product_name']; ?></td>
                                                <td><?php echo $readrow['fld_product_price']; ?></td>
                                                <td><?php echo $readrow['fld_product_brand']; ?></td>
                                                <td><?php echo $readrow['fld_product_size']; ?></td>
                                                <td><?php echo $readrow['fld_product_fabric']; ?></td>
                                                <td><?php echo $readrow['fld_product_colour']; ?></td>
                                                <td><?php echo $readrow['fld_product_ship']; ?></td>
                                                <!-- <td><?php //echo $readrow['fld_product_quantity']; ?></td> -->
                                            </tr>

                                            <?php
                                        } else {

                                            if (in_array($readrow['fld_product_num'], $dataArray, TRUE)) {

                                            } else {

                                                $dataArray[$count] = $readrow['fld_product_num'];
                                                $count++;
                                                ?>
                                                <tr class="small">
                                                    <td><?php echo $readrow['fld_product_num']; ?></td>
                                                    <td><?php echo $readrow['fld_product_name']; ?></td>
                                                    <td><?php echo $readrow['fld_product_price']; ?></td>
                                                    <td><?php echo $readrow['fld_product_brand']; ?></td>
                                                    <td><?php echo $readrow['fld_product_size']; ?></td>
                                                    <td><?php echo $readrow['fld_product_fabric']; ?></td>
                                                    <td><?php echo $readrow['fld_product_colour']; ?></td>
                                                    <td><?php echo $readrow['fld_product_ship']; ?></td>
                                                    <!-- <td><?php //echo $readrow['fld_product_quantity']; ?></td> -->
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php

            } else {

                ?>
                <div class="thumbnail" style="background-color:white;">
                    <div>
                        <table class="table table-striped">
                            <thead>
                              <th scope="col" style="width: 10%;">Product ID</th>
                                    <th scope="col" style="width: 10%;">Name</th>
                                    <th scope="col" style="width: 6%;">Price</th>
                                    <th scope="col" style="width: 10%;">Brand</th>
                                    <th scope="col" style="width: 10%;">Size</th>
                                    <th scope="col" style="width: 10%">Fabric</th>
                                    <th scope="col" style="width: 6%;">Colour</th>
                                    <th scope="col" style="width: 6%;">Ship From</th>
                                <!-- <th scope="col" style="width: 6%;">Stock</th> -->
                            </tr>


                            <?php
                            for ($index = 0; $index < count($input_data); $index++) {

                                $stmt = $conn->prepare("SELECT * FROM  tbl_products_a174485_pt2 WHERE fld_product_name LIKE :first_string OR fld_product_price LIKE :first_string OR fld_product_brand LIKE :first_string");

                                $stmt->bindParam(':first_string', $first_string, PDO::PARAM_STR);

                                $first_string = $input_data[$index];
                                $first_string = "%$first_string%";

                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                foreach ($result as $readrow) {
                                    ?>
                                    <tr class="small">
                                        <td><?php echo $readrow['fld_product_num']; ?></td>
                                        <td><?php echo $readrow['fld_product_name']; ?></td>
                                        <td><?php echo $readrow['fld_product_price']; ?></td>
                                        <td><?php echo $readrow['fld_product_brand']; ?></td>
                                        <td><?php echo $readrow['fld_product_size']; ?></td>
                                        <td><?php echo $readrow['fld_product_fabric']; ?></td>
                                        <td><?php echo $readrow['fld_product_colour']; ?></td>
                                        <td><?php echo $readrow['fld_product_ship']; ?></td>
                                        <!-- <td><?php// echo $readrow['fld_product_quantity']; ?></td> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php }
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <?php

            }

            if ($result == "") {
                ?>
                <div class="px-5 mt-5">
                    <p class="text-muted  fw-normal"> No result found.</p>
                </div>
                <?php
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
      // header("location:error.php");
        }
    }
} catch (PDOException $e) {
  // echo "Error: " . $e->getMessage();
    header("location:error.php");
}
?>