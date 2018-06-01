
   <?php  
                include_once "../../common/conn.php";

                $name = $_GET['name'];
                $year = $_GET['year'];
                $date1 = $_GET['date1'];
                $date2 = $_GET['date2'];
                $awark_class = $_GET['awark_class'];
                $licenceauth = $_GET['licenceauth'];
                $pigeonhole = 1;  //归档查询

                echo "<table width='100%' cellspacing='0'  cellpadding='0' border='1' style='width:100%;table-layout:fixed'>";

                echo "<tr height='40px' bgcolor='#AFEEEE'>
                        <th style='width:5%;table-layout:fixed'>姓名</th>
                        <th style='width:5%;table-layout:fixed'>年度</th>
                        <th style='width:10%;table-layout:fixed'>获奖名称</th>
                        <th style='width:10%;table-layout:fixed'>获奖时间</th>
                        <th style='width:10%;table-layout:fixed'>本人排名</th>
                        <th style='width:10%;table-layout:fixed'>发证机关</th>
                        <th style='width:10%;table-layout:fixed'>获奖级别</th>
                    </tr>";

                $sql_query = "SELECT * FROM `postgraduate` WHERE `name`='{$name}' and `pigeonhole`='{$pigeonhole}' ";
                if(!empty($year)){
                    $sql_query = "SELECT * FROM `postgraduate` WHERE `name`='{$name}' and `year`='{$year}' and `pigeonhole`='{$pigeonhole}' ";
                }
                if(!empty($year) && !empty($date1) && !empty($date2)){
                    $sql_query = "SELECT * FROM `postgraduate` WHERE `name`='{$name}' and `year`='{$year}' and (`award_time` between '{$date1}' and '{$date2}') and `pigeonhole`='{$pigeonhole}' ";
                }
                if(!empty($year) && !empty($date1) && !empty($date2) && $awark_class != 'empty'){
                    $sql_query = "SELECT * FROM `postgraduate` WHERE `name`='{$name}' and `year`='{$year}' and (`award_time` between '{$date1}' and '{$date2}') and `awark_class`='{$awark_class}' and `pigeonhole`='{$pigeonhole}' ";
                }
                if(!empty($year) && !empty($date1) && !empty($date2) && $awark_class != 'empty' && !empty($licenceauth)){
                    $sql_query = "SELECT * FROM `postgraduate` WHERE `name`='{$name}' and `year`='{$year}' and (`award_time` between '{$date1}' and '{$date2}') and `awark_class`='{$awark_class}' and `licenceauth`='{$licenceauth}' and `pigeonhole`='{$pigeonhole}' ";
                }

                foreach ($pdo->query($sql_query) as $row){
                    echo "<tr height='50px'>"; 
                    echo "<td>{$row['name']}</td>"; 
                    echo "<td>{$row['year']}</td>"; 
                    echo "<td>{$row['award_name']}</td>"; 
                    echo "<td>{$row['award_time']}</td>"; 
                    echo "<td>{$row['rank']}</td>";
                    echo "<td>{$row['licenceauth']}</td>";
                    echo "<td>{$row['awark_class']}</td>";
                    echo "</tr>";
                }

                echo "</table>";
            echo "<br><br><br><br><br><br><br>";
              
    ?>  