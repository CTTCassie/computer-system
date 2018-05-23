<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8" />  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
        <link rel="stylesheet" type="text/css" href="../assets/bootstrap.min.css" />  
        <title>计算机学院信息化管理系统</title>  

        <a href="/index.php">
        <img border="0" src="/image/xatu.jpg" alt="获奖信息管理系统" style="width:1350px;height:160px;"></a>

        <marquee behavior="alternate"><h4>欢迎来到西安工业大学获奖信息管理系统</h4></marquee>
        <style type='text/css'>
          div{
              width: 100%;
              height: 750px;
              background: -webkit-linear-gradient(
                top,white,lightblue,skyblue
              );
          }
        </style>

    </head>
    <body>
    <?php
    session_start();
    //include_once "/common/top_bottom.php";
    //error_reporting(0);
    ?>
    <br><br>

  <center>
    <div class="page" width="100%">
        <form id="iterInfo" name="iterInfo" method="post" action="index.php" class="form-inline" role="form">
          <font color="blue"><h3>用户登录/LOGIN</h3></font>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;账号：
          <input type="text"  id='username' class="form-control" name="username" placeholder="请输入学号或者工号"/><br /><br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码：
          <input type="password" id='password' class="form-control" name="password" placeholder="请输入密码"/><br /><br />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label><input name="individual" type="radio" value="学生" />学生</label>
          <label><input name="individual" type="radio" value="教师" checked="true"/>教师</label>
          <label><input name="individual" type="radio" value="管理员" />管理员</label> <br /><br />
          <input type="submit" id='log' width="80px" height="100px" value="登录" class='btn btn-info' name="log">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="register.php">没有账号，请先注册</a>
        </form>
        <br><br><br><br>
        <label><a href="/">Copyright©西安工业大学</a></label>
    </div>
  </center>
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
              echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/studentinfo/student.php"."\""."</script>";
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