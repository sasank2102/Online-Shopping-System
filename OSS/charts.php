<html>
    <head>
        <link href="css/index.css" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="index.css" type="text/css"/>


        <script src="js/jquery-3.2.1.min.js"       type="text/javascript"></script> 
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <script>
            function url_function(f1) {


                f1.submit();
                window.location.search = "?cat=" + $("#cat").val() + "&sub_cat=all";
            }
        </script>

        <?php
        if (isset($_GET['cat'])) {
            if ($_GET['cat'] === 'all') {
                $a1 = 'category';
                $sql = "select category,sum(qty) as total from dummy_sales join products using (pid) group by category";
                $title = "Sales Distribution of all categories";
            } else if ($_GET['sub_cat'] === 'all') {
                $a1 = 'sub_category';
                $sql = 'select sub_category,sum(qty) as total from dummy_sales join products using (pid) group by category,sub_category having category="' . addslashes($_GET['cat']) . '"';
                $title = "Sales Distribution of " . addslashes($_GET['cat']) . " category";
            } else {
                $a1 = 'pname';
                $sql = "select pname,sum(qty) as total from dummy_sales join products using (pid) group by category,sub_category,pname having category='" . addslashes($_GET['cat']) . "' and sub_category='" . addslashes($_GET['sub_cat']) . "'";
                $title = "Sales Distribution of " . addslashes($_GET['cat']) . "-" . addslashes($_GET['sub_cat']) . " category";
            }
        }
        ?>

        <?php
        require 'config.php';
        //echo $sql;
        $result = $mysqli->query($sql);
        

        while ($row = $result->fetch_assoc()) {
            $category = $row[$a1];
            $total = $row['total'];
            $datapie[] = array($category, doubleval($total));
        }
        
        if(isset($datapie)){
        $data = json_encode($datapie);
        }
        ?>

        <script>
            $(function () {

                Highcharts.setOptions({
                    lang: {
                        thousandsSep: ','
                    }

                });

                var chart;


                $(document).ready(function () {

                    chart = new Highcharts.Chart({

                        chart: {
                            renderTo: 'container',
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: '<?php echo $title; ?>'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.y}</b>',
                            percentageDecimals: 1
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    formatter: function () {
                                        return '<b>' + this.point.name + '</b>: ' + Highcharts.numberFormat(this.percentage, 2) + ' %';
                                    }
                                }
                            }
                        },
                        series: [{
                                type: 'pie',
                                name: 'Units Sold',
                                data: <?php echo $data; ?>
                            }]
                    });



                });



            });
        </script>



    </head>
    <body>
        <?php include 'navbar_admin.php'  ?> 
        <?php include 'footer.php' ?>


        <div class="container" style="margin-top: 20px;">
            
               <?php if(!isset($datapie)){
              ?>
            <h2 style="text-align: center;color: blueviolet;margin-top: 20px;">No Sales for this product or Category!</h2>
            <?php
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                <div class="form-group">

                    <div class="col-md-5">
                        <label for="cat">Category:</label>

                        <select class="form-control" name="cat" id="cat" onchange="url_function(this.form)"  >
                            <option value="all">All</option>
                            <?php
                            $sql = 'select cname from category';

                            $result = $mysqli->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option <?php if (isset($_GET['cat']) && $_GET['cat'] == $row['cname']) { ?>selected="true" <?php }; ?>value="<?php echo $row['cname']; ?>"><?php echo $row['cname']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="cat">Sub-Category:</label>

                        <select class="form-control" name="sub_cat" id="sub_cat" onchange="this.form.submit()"  >
                            <?php
                            if ($_GET['cat'] === 'all') {
                                echo '<option >-</option>';
                            } else {
                                echo '<option value="all">All</option>';
                            }
                            ?>
                            <?php
                            if (isset($_GET['cat'])) {
                                $sql = 'select scname from sub_category where cid=(select cid from category where cname="' . $_GET['cat'] . '")';

                                $result = $mysqli->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <option <?php if (isset($_GET['sub_cat']) && $_GET['sub_cat'] == $row['scname']) { ?>selected="true" <?php }; ?>value="<?php echo $row['scname']; ?>"><?php echo $row['scname']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>




                </div>
            </form>
            <div class="container">
                <div id="container" style="min-width: 400px; height: 400px; margin: 20px auto"></div>
            </div>
         
        </div>


    </body>
</html>