<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8" />  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
        <link rel="stylesheet" type="text/css" href="../assets/bootstrap.min.css" />  
        <title>计算机学院信息化管理系统注册</title>  
        <a href="/index.php">
        <img border="0" src="/image/xatu.jpg" alt="获奖信息管理系统" style="width:1350px;height:160px;"></a>
        <marquee behavior="alternate"><h4>欢迎来到西安工业大学获奖信息管理系统</h4></marquee>
        <style type='text/css'>
          div{
              width: 100%;
              height: 470px;
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
        <form id="iterInfo" name="iterInfo" method="post" action="register.php" class="form-inline" role="form">
            <font color="blue"><h3>请使用学号或工号注册（本系统已经做了加密处理，不会泄露个人信息）</h3></font>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;账号：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text"  id='username' class="form-control" name="username" placeholder="请输入学号或者工号"/><br /><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="password" id='password' class="form-control" name="password" placeholder="请输入密码"/><br /><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码确认：
            <input type="password" id='password2' class="form-control" name="password2"  placeholder="请确认密码"/><br /><br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" id='reg' width="80px" height="100px" value="注册" class='btn btn-info' name="reg">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="index.php">返回登录页面</a>
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
    if (!empty($_POST['reg'])) 
    {
    if($pdo)
    {
        $name=$_POST["username"];
        $password=$_POST["password"];
        $password2=$_POST["password2"];
        if($name==""||$password==""||$password2=="")//判断是否为空
        {
          echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请输入用户名和密码并确认密码！"."\"".")".";"."</script>";
          echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."register.php"."\""."</script>";
          exit;
        }
        $sqlreg="SELECT username from userinfo where username='{$name}'";
        $result = $pdo->query($sqlreg);
        if($result->rowCount()!=0)
        {
        	echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户已存在！"."\"".")".";"."</script>";
        	echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."register.php"."\""."</script>";
        }
        else
             {
        if($password==$password2)//判断密码与确认密码是否一致
          {
            $codepass = base64_encode($password);
            $sqlreg = "INSERT INTO userinfo VALUES (null,'{$name}','{$codepass}')";
            $rw = $pdo->exec($sqlreg);
            if ($rw > 0) 
            {
            //echo"数据库关闭";
            //echo"注册成功！";
           	    echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."注册成功，请登录！"."\"".")".";"."</script>";
     			echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";  
            }
        }
        else
        {
          echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请确认密码一致！"."\"".")".";"."</script>";
          echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."register.php"."\""."</script>";    
        }
      }
    }
  }
    ?> 
</html>  