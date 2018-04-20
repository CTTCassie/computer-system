<!DOCTYPE html>
<head>
    <?php
    session_start();
    include_once "../common/strap.php";
    include_once "../common/conn.php";
    if (empty($_SESSION['username']))
    {
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."../index.php"."\""."</script>";
    }
    else
    {
        $username = $_SESSION['username'];
        $sqlpass="SELECT password from userinfo where username='{$username}'";   
        foreach($pdo->query($sqlpass) as $row)
          { 
            $password = base64_decode($row['password']);
            break;
          }
    }
    ?>
    <?php
        $Page_size=4; 
        $sql_count = "SELECT * FROM teacherinfo";
        $stmt = $pdo->query($sql_count);
        $count = $stmt->rowCount(); 
        $page_count = ceil($count/$Page_size); 

        $init=1; 
        $page_len=7; 
        $max_p=$page_count; 
        $pages=$page_count;

        if(empty($_GET['page'])||$_GET['page']<0){ 
            $page=1; 
        }else { 
            $page=$_GET['page']; 
        } 
        $offset=$Page_size*($page-1);
    ?>
    <meta charset="UTF-8">

    <title>各种获奖信息管理</title>

    <link rel="stylesheet" href="../assets/jquery-ui.min.css">
    <script src="../assets/jquery.min.js"></script>
    <script src="../assets/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="assets/style.css">

    <script src="../assets/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="../common/jquery.table2excel.js"></script>
    <script>
        $(function() {     //实现下载功能
            var dd = new Date();
            dd.setDate(dd.getDate());
            var y = dd.getFullYear();     //获取当前年份
            var m = (dd.getMonth() + 1) < 10 ? "0" + (dd.getMonth() + 1) : (dd.getMonth() + 1);//获取当前月份的日期，不足10补0
            var d = dd.getDate() < 10 ? "0" + dd.getDate() : dd.getDate();//获取当前几号，不足10补0

            var date = y + "-" + m + "-" + d;
            $("#download").click(function(){
                $(".table2excel").table2excel({
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: date,
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true
                });
            });
        });
    </script>

    <script>
        searchData = function(){     //查询数据
            var name = $("#teacher_name").val();    //获得教师名
            var name = $.trim(name);

            var science_class = $("#science_class").val();   //获得科研获奖类别
            var science_class = $.trim(science_class);
            var date1 = $("#date1").val();
            var date1 = $.trim(date1);
            var date2 = $("#date2").val();
            var date2 = $.trim(date2);

            var teach_class = $("#teach_class").val();   //获得科研获奖类别
            var teach_class = $.trim(teach_class);
            var date3 = $("#date3").val();
            var date3 = $.trim(date3);
            var date4 = $("#date4").val();
            var date4 = $.trim(date4);

            var other_class = $("#other_class").val();   //获得科研获奖类别
            var other_class = $.trim(other_class);
            var date5 = $("#date5").val();
            var date5 = $.trim(date5);
            var date6 = $("#date6").val();
            var date6 = $.trim(date6);

            var famous_class = $("#famous_class").val();   //获得科研获奖类别
            var famous_class = $.trim(famous_class);
            var date7 = $("#date7").val();
            var date7 = $.trim(date7);
            var date8 = $("#date8").val();
            var date8 = $.trim(date8);

            $.get('datasorce.php',{
                name:name,
                science_class:science_class,
                date1:date1,
                date2:date2,
                teach_class:teach_class,
                date3:date3,
                date4:date4,
                other_class:other_class,
                date5:date5,
                date6:date6,
                famous_class:famous_class,
                date7:date7,
                date8:date8,
                page:1
            },function(data) {
                $("#accort").html(data);
             })       

        }
        previouspage = function(){   //返回上一页
            window.history.back(); 
        }
    </script>

</head>
<body>

    <br>
    <?php
        echo "<div id='accort' class='table-responsive table2excel' data-tableName='Test Table 1'>";
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


            $sql = "SELECT `name`, `year`, `science_name`, `science_class`, `science_time`, `science_rank`, `teach_name`, `teach_class`, `teach_time`, `teach_rank`, `other_name`, `other_class`, `other_time`, `other_rank`, `famous_name`, `famous_class`, `famous_time` FROM `teacherinfo` order by `time` limit $offset,$Page_size";
            foreach ($pdo->query($sql) as $row){
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
        echo "</div>";

        echo '<div class="page" align="right"  style="font-size:14px">'; 
   
            echo "<span id='pagenumber'>$page/$pages</span> "; 
                if($page!=1){ 
                    echo "<a href='searchRecord.php?page=1'>第一页</a>&nbsp;";
                    echo "<a href='searchRecord.php?page=".($page-1)."'>前一页</a>&nbsp;";

                }else { 
                    echo "第一页 &nbsp;&nbsp;";
                    echo "前一页&nbsp;&nbsp;"; 
                } 

                $page_len = ($page_len%2)?$page_len:$pagelen+1;
                $pageoffset = ($page_len-1)/2;
                if($pages>$page_len){ 
                    if($page<=$pageoffset){ 
                        $init=1; 
                        $max_p = $page_len; 
                    }else{
                        if($page+$pageoffset>=$pages+1){ 
                            $init = $pages-$page_len+1; 
                        }else{ 

                            $init = $page-$pageoffset; 
                            $max_p = $page+$pageoffset; 
                        } 
                    } 
                } 

                if($page!=$pages){ 
                    echo "<a href='searchRecord.php?page=".($page+1)."'>下一页</a>&nbsp;";
                    echo "<a href='searchRecord.php?page=".($pages)."'>最末页</a>&nbsp;";
                }else { 
                    echo "下一页 ";
                    echo "最末页"; 
                } 
                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
            echo '</div>'; 

     ?>

     <div class="page" width="100%">
    <form id="iterInfo" name="iterInfo" method="post" action="datasorce.php" class="form-inline" role="form">
        <div class="panel panel-primary" width="100%">
            <div class="panel-heading">
                <h3 class="panel-title">
                    查询信息栏
                </h3>
            </div>
            <div class="panel-body">
                姓名：<font color='#FF0000'>*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" id='teacher_name' class="form-control" style="width:10%;height:25%;" name='teacher_name'/>
                <br><br>
                科研获奖类别：
                <select style='width:10%;height:25%;' class='form-control' name='science_class'
                        type='text' id='science_class'>
                    <option value='国家级'>国家级</option>
                    <option value='省级'>省级</option>
                    <option value='校级'>校级</option>
                </select>

                &nbsp;&nbsp;&nbsp;&nbsp;科研获奖时间：
                <input id='date1' class="form-control" name='date1' type="date" width="50px"/>
                &nbsp;&nbsp;
                <select style='width:6%;height:25%;' class='form-control' name='arrive1' type='text' id='arrive1'>
                    <option value='之间'>之前</option>
                    <option value='之后'>之后</option>
                    <option value='至'>至</option>
                </select>
                &nbsp;&nbsp;
                <input id='date2' class="form-control" name='date2' type="date" width="50px"/>
                 &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                <span class='label label-success' name="username" id="username">当前用户：<?php echo $username; ?></span>
                <br><br>
                教学获奖类别：
                <select style='width:10%;height:25%;' class='form-control' name='teach_class' type='text' id='teach_class'>
                    <option value='国家级'>国家级</option>
                    <option value='省级'>省级</option>
                    <option value='校级'>校级</option>
                </select>
                &nbsp;&nbsp;&nbsp;&nbsp;教学获奖时间：
                <input id='date3' class="form-control" name='date3' type="date" width="50px"/>
                &nbsp;&nbsp;
                <select style='width:6%;height:25%;' class='form-control' name='arrive2' type='text' id='arrive2'>
                    <option value='之间'>之前</option>
                    <option value='之后'>之后</option>
                    <option value='至'>至</option>
                </select>
                &nbsp;&nbsp;
                <input id='date4' class="form-control" name='date4' type="date" width="50px"/>
                <br><br>
                其他获奖类别：
                <select style='width:10%;height:25%;' class='form-control' name='other_class' type='text' id='other_class'>
                    <option value='国家级'>国家级</option>
                    <option value='省级'>省级</option>
                    <option value='校级'>校级</option>
                </select>
                &nbsp;&nbsp;&nbsp;&nbsp;其他获奖时间：
                <input id='date5' class="form-control" name='date5' type="date" width="50px"/>
                &nbsp;&nbsp;
                <select style='width:6%;height:25%;' class='form-control' name='arrive3' type='text' id='arrive3'>
                    <option value='之间'>之前</option>
                    <option value='之后'>之后</option>
                    <option value='至'>至</option>
                </select>
                &nbsp;&nbsp;
                <input id='date6' class="form-control" name='date6' type="date" width="50px"/>
                <br><br>
                显著业绩类别：
                <select style='width:10%;height:25%;' class='form-control' name='famous_class' type='text' id='famous_class'>
                    <option value='国家级'>国家级</option>
                    <option value='省级'>省级</option>
                    <option value='校级'>校级</option>
                </select>
                &nbsp;&nbsp;&nbsp;&nbsp;显著业绩时间：
                <input id='date7' class="form-control" name='date7' type="date" width="50px"/>
                &nbsp;&nbsp;
                <select style='width:6%;height:25%;' class='form-control' name='arrive4' type='text' id='arrive4'>
                    <option value='之间'>之前</option>
                    <option value='之后'>之后</option>
                    <option value='至'>至</option>
                </select>
                &nbsp;&nbsp;
                <input id='date8' class="form-control" name='date8' type="date" width="50px"/>
                <br><br>

                <input type='button' class='btn btn-default' onclick='searchData()' value='查询数据'/>&nbsp; &nbsp;&nbsp; &nbsp;
                <input type='button' class='btn btn-default' id='download' value='数据导出'/>&nbsp; &nbsp;&nbsp; &nbsp;
                <input type='button' class='btn btn-default' onclick='previouspage()' value='返回'/>&nbsp; &nbsp;&nbsp; &nbsp;

            </div>
        </div>
    </form>
</div>

</table>


</body>
</html>
