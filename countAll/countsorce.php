
   <?php  
                include_once "../common/conn.php";

                $year = $_GET['year'];

                echo "<table width='100%' cellspacing='0'  cellpadding='0' border='1' style='width:100%;table-layout:fixed'>";

                echo "<tr height='40px' bgcolor='#AFEEEE'>
                        <th style='width:5%;table-layout:fixed'>姓名</th>
                        <th style='width:5%;table-layout:fixed'>年度</th>
                        <th style='width:10%;table-layout:fixed'>获奖名称</th>
                        <th style='width:10%;table-layout:fixed'>获奖积分</th>
                    </tr>";
                    $sql_query = "SELECT * FROM `countworkload` WHERE `year`='{$year}'";

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