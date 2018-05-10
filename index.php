<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8" />  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
        <link rel="stylesheet" type="text/css" href="../assets/bootstrap.min.css" />  
        <title>计算机学院信息化管理系统</title>  
        <style type="text/css"></style>  

    </head>
    <body>
    <?php
    session_start();
    include_once "/common/top_bottom.php";
    //error_reporting(0);
    ?>
    <br><br><br>
    <div class="page" width="100%">
        <form id="iterInfo" name="iterInfo" method="post" action="index.php" class="form-inline" role="form">
            <div class="panel panel-primary" width="100%">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        用户登录/LOGIN
                    </h3>
                </div>
                <div class="panel-body">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;账号：
                    <input type="text"  id='username' class="form-control" name="username" placeholder="请输入学号或者工号"/><br /><br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码：
                    <input type="password" id='password' class="form-control" name="password" placeholder="请输入密码"/><br /><br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label><input name="individual" type="radio" value="学生" />学生</label> 
                    <label><input name="individual" type="radio" value="教师" checked="true"/>教师</label> 
                    <label><input name="individual" type="radio" value="管理员" />管理员</label> <br /><br />
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" id='log' width="80px" height="100px" value="登录" class='btn btn-info' name="log">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="register.php">没有账号，请先注册</a>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="/assets/jquery.min.js"></script>  
    <script type="text/javascript" src="/assets/bootstrap.min.js"></script>
    </body> 
    <?php
    require($_SERVER['DOCUMENT_ROOT'] . "/common/conn.php");
    if (!empty($_POST['log'])) 
    {
    if($pdo)
    {
        $name=$_POST["username"];
        $password=$_POST["password"];
        $individual = $_POST["individual"];
        if($name=="" || $password=="")//判断是否为空
        {
          echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请输入用户名和密码！"."\"".")".";"."</script>";
          echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
          exit;
        }
        $sqlname="SELECT uid from userinfo where username='{$name}'";
        $result = $pdo->query($sqlname);
        if($result->rowCount()!=0)
        { 
          $sqlpass="SELECT password from userinfo where username='{$name}'";   
          foreach($pdo->query($sqlpass) as $row)
          { 
            $pass = base64_decode($row['password']);
            break;
          }
          if($pass==$password)//判断密码与注册时密码是否一致
          {
            $_SESSION["username"]=$name;
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."欢迎您  ".$name."   ！"."\"".")".";"."</script>";
            if($individual == "教师"){
              echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/teacherinfo/prizeinfo.php"."\""."</script>";
            }
            else if($individual == "学生"){
              echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/studentinfo/graduate/graduateprize.php"."\""."</script>";
            }
            else{    //管理员
              echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/top_page.php"."\""."</script>";
            }
            //echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/top_page.php"."\""."</script>";
          }
          else
          {  
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."密码不正确！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
          }
      }
      else
      {
        echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户不存在！"."\"".")".";"."</script>";
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
      }
    }
  }
    ?> 
</html>  