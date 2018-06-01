<!DOCTYPE html>
<head>
    <?php
    session_start();
    include_once "../../common/strap.php";
    include_once "../../common/conn.php";
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
        $sql_count = "SELECT * FROM `postgraduate`";
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

    <link rel="stylesheet" href="../../assets/jquery-ui.min.css">
    <script src="../../assets/jquery.min.js"></script>
    <script src="../../assets/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="assets/style.css">

    <script src="../../assets/jquery-1.11.0.min.js" type="text/javascript"></script>
    <script src="../../common/jquery.table2excel.js"></script>
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
            var name = $("#name").val(); 
            var name = $.trim(name);
            var year = $("#year").val(); 
            var year = $.trim(year);
            var date1 = $("#date1").val();
            var date1 = $.trim(date1);
            var date2 = $("#date2").val();
            var date2 = $.trim(date2);
            var awark_class = $("#awark_class").val();
            var awark_class = $.trim(awark_class);
            var licenceauth = $("#licenceauth").val();
            var licenceauth = $.trim(licenceauth);

            if(name){
                $.get('datasorce.php',{
                    name: name,
                    year: year,
                    date1: date1,
                    date2: date2,
                    awark_class: awark_class,
                    licenceauth: licenceauth,
                    page: 1
                },function(data) {
                    $("#accort").html(data);
                })   
            }
            else{
                alert("学生姓名不可为空");
            } 

        }
        pigeonhole = function(){    //归档查询
            var name = $("#name").val(); 
            var name = $.trim(name);
            var year = $("#year").val(); 
            var year = $.trim(year);
            var date1 = $("#date1").val();
            var date1 = $.trim(date1);
            var date2 = $("#date2").val();
            var date2 = $.trim(date2);
            var awark_class = $("#awark_class").val();
            var awark_class = $.trim(awark_class);
            var licenceauth = $("#licenceauth").val();
            var licenceauth = $.trim(licenceauth);

            if(name){
                $.get('pigeonhole.php',{
                    name: name,
                    year: year,
                    date1: date1,
                    date2: date2,
                    awark_class: awark_class,
                    licenceauth: licenceauth,
                    page: 1
                },function(data) {
                    $("#accort").html(data);
                })   
            }
            else{
                alert("学生姓名不可为空");
            } 
        }
        previouspage = function(){   //返回上一页
            window.history.back(); 
        }
    </script>

</head>
<body>
    <br>
<div class="page" width="100%">
    <form id="iterInfo" name="iterInfo" method="post" action="datasorce.php" class="form-inline" role="form" enctype="multipart/form-data">
        <div class="panel panel-info" width="100%">
            <div class="panel-heading">
                <h3 class="panel-title">
                    研究生获奖信息
                </h3>
            </div>
            <div class="panel-body">
                <input type='checkbox' name='a'/>
                姓名：<font color='#FF0000'>*</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" id='name' class="form-control" style="width:10%;height:25%;" name='name'/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type='checkbox' name='b'/>
                年度：<input type="text" id='year' class="form-control" style="width:10%;height:25%;" name='year'/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type='checkbox' name='c'/>
                获奖时间：
                <input id='date1' class="form-control" name='date1' type="date" width="50px"/>
                &nbsp;&nbsp;
                <label>至</label>
                &nbsp;&nbsp;
                <input id='date2' class="form-control" name='date2' type="date" width="50px"/>
                 &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                <span class='label label-success' name="username" id="username">当前用户：<?php echo $username; ?></span>
                <br><br>
                <input type='checkbox' name='d'/>
                获奖级别：
                <select style='width:10%;height:25%;' class='form-control' name='awark_class' type='text' id='awark_class'>
                    <option value='empty'></option>
                    <option value='国家级' selected="selected">国家级</option>
                    <option value='省级'>省级</option>
                    <option value='校级'>校级</option>
                </select>
                <br><br>
                <input type='checkbox' name='e'/>
                发证机关：
                <input type="text" id='licenceauth' class="form-control" style="width:18%;height:25%;" name='licenceauth'/>
                <br><br>
                <input type='button' class='btn btn-default' onclick='searchData()' value='未归档查询'/>&nbsp; &nbsp;&nbsp; &nbsp;
                <input type='button' class='btn btn-default' onclick='pigeonhole()' value='归档数据'/>&nbsp; &nbsp;&nbsp; &nbsp;
                <input type='button' class='btn btn-default' id='download' value='数据导出'/>&nbsp; &nbsp;&nbsp; &nbsp;
                <input type='button' class='btn btn-default' onclick='previouspage()' value='返回'/>&nbsp; &nbsp;&nbsp; &nbsp;

            </div>
        </div>
    </form>
</div>

    <br>
    <?php
        echo "<div id='accort' class='table-responsive table2excel' data-tableName='Test Table 1'>";
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

            $sql = "SELECT `name`,`year`,`award_name`,`award_time`,`rank`,`licenceauth`,`awark_class` FROM `postgraduate` order by `time` limit $offset,$Page_size";
            foreach ($pdo->query($sql) as $row){
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

            echo "<br>";
            
        echo "</div>";

        echo '<div class="page" align="right"  style="font-size:14px">'; 

        $countpages = "共 " . $count . " 条记录；" . "共 " . $pages . " 页";
        echo $countpages,"&nbsp;&nbsp;&nbsp;&nbsp;";
   
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

</table>


</body>
</html>
