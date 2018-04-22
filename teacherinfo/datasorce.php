
   <?php  
                include_once "../common/conn.php";

                $name = $_GET['name'];
                $science_class = $_GET['science_class'];
                $date1 = $_GET['date1'];
                $date2 = $_GET['date2'];
                $teach_class = $_GET['teach_class'];
                $date3 = $_GET['date3'];
                $date4 = $_GET['date4'];
                $other_class = $_GET['other_class'];
                $date5 = $_GET['date5'];
                $date6 = $_GET['date6'];
                $famous_class = $_GET['famous_class'];
                $date7 = $_GET['date7'];
                $date8 = $_GET['date8'];

                echo "<table width='100%' cellspacing='0'  cellpadding='0' border='1' style='width:100%;table-layout:fixed'>";

                echo "<tr height='40px' bgcolor='#0099FF'>
                        <th style='width:5%;table-layout:fixed'>姓名</th>
                        <th style='width:5%;table-layout:fixed'>统计年度</th>
                        <th colspan='2'>科研获奖名称</th>
                        <th style='width:5%;table-layout:fixed'>科研获奖类别</th>
                        <th style='width:5%;table-layout:fixed'>科研获奖时间</th>
                        <th style='width:5%;table-layout:fixed'>科研获奖排名</th>
                        <th colspan='2'>教学获奖名称</th>
                        <th style='width:5%;table-layout:fixed'>教学获奖类别</th>
                        <th style='width:5%;table-layout:fixed'>教学获奖时间</th>
                        <th style='width:5%;table-layout:fixed'>教学获奖排名</th>
                        <th colspan='2'>其他获奖名称</th>
                        <th style='width:5%;table-layout:fixed'>其他获奖类别</th>
                        <th style='width:5%;table-layout:fixed'>其他获奖时间</th>
                        <th style='width:5%;table-layout:fixed'>其他获奖排名</th>
                        <th colspan='2'>显著业绩名称</th>
                        <th style='width:5%;table-layout:fixed'>业绩类(级)别</th>
                        <th style='width:5%;table-layout:fixed'>显著业绩获得时间</th>
                    </tr>";

                $sql_query = "SELECT * FROM `teacherinfo` WHERE `name`='{$name}'";

                if($science_class != 'empty'){
                    $sql_query = "SELECT * FROM `teacherinfo` WHERE `name`='{$name}' and `science_class`='{$science_class}' ";
                    if($date1 && $date2){
                        $sql_query = "SELECT * FROM `teacherinfo` WHERE `name`='{$name}' and `science_class`='{$science_class}' and (`science_time` between '{$date1}' and '{$date2}') ";
                    }
                }
                else if($teach_class != 'empty'){
                    $sql_query = "SELECT * FROM `teacherinfo` WHERE `name`='{$name}' and `teach_class`='{$teach_class}' ";
                    if($date3 && $date4){
                        $sql_query = "SELECT * FROM `teacherinfo` WHERE `name`='{$name}' and `teach_class`='{$teach_class}' and (`teach_time` between '{$date3}' and '{$date4}')";
                    }
                }
                else if($other_class != 'empty'){
                    $sql_query = "SELECT * FROM `teacherinfo` WHERE `name`='{$name}' and `other_class`='{$other_class}' ";
                    if($date5 && $date6){
                        $sql_query = "SELECT * FROM `teacherinfo` WHERE `name`='{$name}' and `other_class`='{$other_class}' and (`other_time` between '{$date5}' and '{$date6}')";
                    }
                }
                else if($famous_class != 'empty'){
                    $sql_query = "SELECT * FROM `teacherinfo` WHERE `name`='{$name}' and `famous_class`='{$famous_class}' ";
                    if($date7 && $date8){
                        $sql_query = "SELECT * FROM `teacherinfo` WHERE `name`='{$name}' and `famous_class`='{$famous_class}' and (`famous_time` between '{$date7}' and '{$date8}')";
                    }
                }

                foreach ($pdo->query($sql_query) as $row){
                    echo "<tr height='50px'>"; 
                    echo "<td>{$row['name']}</td>"; 
                    echo "<td>{$row['year']}</td>"; 
                    echo "<td colspan='2'>{$row['science_name']}</td>"; 
                    echo "<td>{$row['science_class']}</td>"; 
                    echo "<td>{$row['science_time']}</td>"; 
                    echo "<td>{$row['science_rank']}</td>"; 
                    echo "<td colspan='2'>{$row['teach_name']}</td>"; 
                    echo "<td>{$row['teach_class']}</td>"; 
                    echo "<td>{$row['teach_time']}</td>"; 
                    echo "<td>{$row['teach_rank']}</td>"; 
                    echo "<td colspan='2'>{$row['other_name']}</td>"; 
                    echo "<td>{$row['other_class']}</td>"; 
                    echo "<td>{$row['other_time']}</td>"; 
                    echo "<td>{$row['other_rank']}</td>"; 
                    echo "<td colspan='2'>{$row['famous_name']}</td>"; 
                    echo "<td>{$row['famous_class']}</td>"; 
                    echo "<td>{$row['famous_time']}</td>"; 
                    echo "</tr>";
                }

                echo "</table>";
            echo "<br><br><br><br><br><br><br>";
              
    ?>  