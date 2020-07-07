data: [
                    <?php
                        include 'config.php';
                        $sql = "select category,sum(qty) from sales join products group by category";
                        $result= $mysqli->query($sql);
                     
                        while ($row = $result->fetch_assoc()) {
                            $category = $row['category'];
                            $total=$row['sum(qty)'];
                         
                            
                            ?>
                            [ 
                                '<?php echo $category ?>', <?php echo $total; ?>
                            ],
                            <?php
                        }
                        ?>
             
                    ]