<!DOCTYPE html>
<head>
    <?php
    session_start();
    include_once "../common/strap.php";
    include_once "../common/conn.php";
    if (empty($_SESSION['username']))
    {
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/index.php"."\""."</script>";
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
    <meta charset="UTF-8">

    <title>学生获奖主页面</title>

    <link rel="stylesheet" href="../assets/jquery-ui.min.css">
    <script src="../assets/jquery.min.js"></script>
    <script src="../assets/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../assets/style.css">
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
<center>
    <?php
        echo "<br><br><br><br><br><br><br><br><br><br><br><br>";

        echo "<label><h3>获奖信息管理平台之学生登录页面</h3></label>";
        echo "<br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $graduate = "window.location.href='/studentinfo/graduate/graduateprize.php'";
        $postgraduate = "window.location.href='/studentinfo/postgraduate/postgraduateprize.php'";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$postgraduate value='研究生各种获奖信息'/>";
        echo "<br><br><br>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<input type='button' class='btn btn-success' style='width:400px;height:35px;' onclick=$graduate value='本科生各种获奖信息'/>";
    ?>
</center>
</body>
</html>
