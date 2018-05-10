
   <?php  
                include_once "../common/conn.php";

                $name = $_GET['name'];
                $year = $_GET['year'];
                $award_points1 = $_GET['award_points1'];
                $op = $_GET['op'];
                $award_points2 = $_GET['award_points2'];

                echo "<table width='100%' cellspacing='0'  cellpadding='0' border='1' style='width:100%;table-layout:fixed'>";

                echo "<tr height='40px' bgcolor='#AFEEEE'>
                        <th style='width:5%;table-layout:fixed'>姓名</th>
                        <th style='width:5%;table-layout:fixed'>年度</th>
                        <th style='width:10%;table-layout:fixed'>获奖名称</th>
                        <th style='width:10%;table-layout:fixed'>获奖积分</th>
                    </tr>";
                    $sql_query = "SELECT * FROM `countworkload` WHERE `name`='{$name}'";
                    if(!empty($year)){
                        $sql_query = "SELECT * FROM `countworkload` WHERE `name`='{$name}' and `year`='{$year}'";
                    }
                    if(!empty($award_points1) && !empty($award_points2)){
                        if($op == "以上"){
                            $sql_query = "SELECT * FROM `countworkload` WHERE `name`='{$name}' and (`award_points` >= '{$award_points1}')";
                        }
                        else if($op == "以下"){
                            $sql_query = "SELECT * FROM `countworkload` WHERE `name`='{$name}' and (`award_points` <= '{$award_points1}')";
                        }
                        else{   //至
                            $sql_query = "SELECT * FROM `countworkload` WHERE `name`='{$name}' and (`award_points` between '{$award_points1}' and '{$award_points2}') ";
                        }
                    }

                foreach ($pdo->query($sql_query) as $row){
                    echo "<tr height='50px'>"; 
                    echo "<td>{$row['name']}</td>"; 
                    echo "<td>{$row['year']}</td>"; 
                    echo "<td>{$row['award_name']}</td>"; 
                    echo "<td>{$row['award_points']}</td>"; 
                    echo "</tr>";
                }

                echo "</table>";
            echo "<br><br><br>";
              
    ?>  