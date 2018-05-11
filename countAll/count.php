<!DOCTYPE html>
<head>
    <?php
    session_start();
    include_once "../common/strap.php";
    include_once "../common/conn.php";
    include_once "../common/top_bottom.php";
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
        $sql_count = "SELECT * FROM `countworkload`";
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
        workloadCount = function(){
            var year = $("#year").val(); 
            var year = $.trim(year);
            if(year){
                var data = "你确定要统计" + year + "年度获奖工作量吗？";
                alert(data);
                $.get('countsorce.php',{
                    year: year,
                    page: 1
                },function(data) {
                    $("#accort").html(data);
                }) 
            }
        }

        searchData = function(){     //上年度数据归档
            var year = $("#year").val(); 
            var year = $.trim(year);
            $.get('countsorce.php',{
                year: year,
                page: 1
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
    <?php
        echo "<br><br><br>";
        echo '<div>';
          $caculate = "window.location.href='count.php'";
          $queryrecord = "window.location.href='searchrecord.php'";
          echo "<input type='button' class='btn btn-info' onclick=$caculate value='获奖工作量统计及积分计算' />";
          echo "&nbsp;&nbsp;";
          echo "<input type='button' class='btn btn-info' onclick=$queryrecord value='信息查询' />";
        echo '</div>';
        echo "<br>";
    ?>
    <?php

        echo "<div id='accort' class='table-responsive table2excel' data-tableName='Test Table 1'>";
            echo "<table width='100%' cellspacing='0'  cellpadding='0' border='1' style='width:100%;table-layout:fixed'>";
            echo "<tr height='40px' bgcolor='#F0FFFF'>
                  <th style='width:5%;table-layout:fixed'>姓名</th>
                  <th style='width:5%;table-layout:fixed'>年度</th>
                  <th style='width:10%;table-layout:fixed'>获奖名称</th>
                  <th style='width:10%;table-layout:fixed'>获奖积分</th>
                  <th style='width:5%;table-layout:fixed'>操作</th>
                  </tr>";

            $sql = "SELECT `name`, `year`, `award_name`, `award_points`, `id` FROM `countworkload` order by `time` limit $offset,$Page_size";
            foreach ($pdo->query($sql) as $row){
                 echo "<tr height='50px'>"; 
                 echo "<td>{$row['name']}</td>"; 
                 echo "<td>{$row['year']}</td>"; 
                 echo "<td>{$row['award_name']}</td>"; 
                 echo "<td>{$row['award_points']}</td>"; 
                 echo "<td style='width:6%;table-layout:fixed'>
                        <a href='add_info.php?id={$row['id']}'>新建</a>
                        <a href='edit.php?id={$row['id']}'>修改</a>
                        <a href='drop.php?id={$row['id']}'>删除</a>
                       </td>";
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
            echo "<br>";

     ?>
<div class="page" width="100%">
    <form id="iterInfo" name="iterInfo" method="post" action="datasorce.php" class="form-inline" role="form" enctype="multipart/form-data">
        <div class="panel panel-success" width="100%">
            <div class="panel-heading">
                <h3 class="panel-title">
                    获奖工作量统计及积分计算
                </h3>
            </div>
            <div class="panel-body">
            <div style='color:#00F'>
                <h3>注：本统计只计算排名为第一的获奖人员，其他人员由团队协调划转</h3>
            </div>
            <div>
                <h3>获奖工作量统计及计算</h3>
            </div>
            <label>年度</label>
            <select style='width:10%;height:25%;' class='form-control' name='year' type='text' id='year'>
                <option value='2018' selected='selected'>2018</option>
                <option value='2017'>2017</option>
                <option value='2016'>2016</option>
                <option value='2015'>2015</option>
                <option value='2014'>2014</option>
            </select>
            &nbsp; &nbsp;&nbsp; &nbsp;
            <input type='button' class='btn btn-default' onclick='workloadCount()' value='获奖工作量统计'/>&nbsp; &nbsp;&nbsp; &nbsp;
            <input type='button' class='btn btn-default' onclick='searchData()' value='上年度数据归档'/>&nbsp; &nbsp;&nbsp; &nbsp;
            <input type='button' class='btn btn-default' id='download' value='数据导出'/>&nbsp; &nbsp;&nbsp;&nbsp;
            <input type='button' class='btn btn-default' onclick='previouspage()' value='返回'/>&nbsp; &nbsp;&nbsp; &nbsp;

            </div>
        </div>
    </form>
</div>

</table>


</body>
</html>

