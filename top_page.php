<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8" />  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
        <link rel="stylesheet" type="text/css" href="/assets/bootstrap.min.css" />  
        <title>计算机学院信息化管理系统</title>  
        <style type="text/css"></style>  

    </head>  
    <body>  
        <br><br><br>
        <?php
        session_start();
        include_once "/common/strap.php";
        include_once "/common/conn.php";
        include_once "/common/top_bottom.php";
        if (empty($_SESSION['username'])){
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
        }
        else{
            $username = $_SESSION['username'];
            $sqlpass="SELECT password from userinfo where username='{$username}'";   
            foreach($pdo->query($sqlpass) as $row)
            { 
                $password = base64_decode($row['password']);
                break;
            }
        }
        ?>

        <!-- 页面部分 -->  
        <div class="row" width="100%">  
            <div class="col-sm-2" width="50%">  
                <br /><br />
                <div class="panel panel-default">  
                    <div class="panel-heading">  
                        <a href="#collapseA"  class="panel-title">教师业务信息</a>  
                    </div>  

                    <div class="panel-body">  
                        <ul class="nav nav-pills nav-stacked">  
                            <li><a href="/teacherinfo/prizeinfo.php" target ="#">各种获奖信息</a></li> 
                        </ul>  
                    </div>  

                </div>  
                <div class="panel panel-default">  
                    <div class="panel-heading">  
                        <a href="#collapseB"  class="panel-title">学生基本信息</a>  
                    </div>  

                    <div class="panel-body">  
                        <ul class="nav nav-pills nav-stacked">  
                            <li><a href='/studentinfo/graduate/graduateprize.php' target ="#">研究生获奖信息</a></li>
                            <li><a href="/studentinfo/undergraduate/undergraduateprize.php" target ="#">本科获奖信息</a></li>   
                        </ul>  
                    </div>  

                </div>  

                <div class="panel panel-default">  
                    <div class="panel-heading">  
                        <a href="#collapseC"  data-toggle="collapse" class="panel-title">各种统计计算</a>  
                    </div>  
                    <div class="panel-body">  
                        <ul class="nav nav-pills nav-stacked">  
                            <li><a href="/countAll/count.php" target ="#">各种获奖工作量统计</a></li> 
                        </ul>  
                    </div>  

                </div> 
                <div class="panel panel-default">  
                    <div class="panel-heading">  
                        <a href="#collapseD"  data-toggle="collapse" class="panel-title">账号管理</a>  
                    </div>  

                    <div class="panel-body">  
                        <ul class="nav nav-pills nav-stacked">  
                            <li><a href="logout.php" >注销</a></li> 
                            <li><a href="logout.php" >切换账号</a></li> 
                        </ul>  
                    </div>  

                </div>  

            </div>  

            <div class="col-sm-2" width="50%">
                <br><br><br>
                <div style="color:#F00" aligin="center">
                    <label>当前操作者：<?php echo $username;?></label>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="/assets/jquery.min.js"></script>  
        <script type="text/javascript" src="/assets/bootstrap.min.js"></script>  
    </body>  
</html>  