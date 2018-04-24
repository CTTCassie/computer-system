<!DOCTYPE html>  
<html lang="en">  
    <head>  
        <meta charset="utf-8" />  
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  
        <link rel="stylesheet" type="text/css" href="/assets/bootstrap.min.css" />  
        <title>用户信息展示</title>  
        <style type="text/css"></style>  
        <?php
        session_start();
        include_once "/common/strap.php";
        include_once "/common/conn.php";
        if (empty($_SESSION['username'])){
          echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."../index.php"."\""."</script>";
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
        <script>

        </script>

    </head>
    <body>
    <br><br><br>
    <div class="page" width="50%">
      <div text-align:right;>
        <span class='label label-success' name="username" id="username">当前用户：<?php echo $username; ?></span> 
      </div>   
      <br><br>
      <table width="100%" cellspacing="0"  cellpadding="0" border="1" style="width:100%;table-layout:fixed">
        <tr height="40px" bgcolor="#0099FF">
            <th style='width:200px;'>账户</th>
            <th style='width:200px;'>密码</th>
            <th style='width:200px;'>操作</th>
            <th></th>
        </tr>
        <?php
           $sql = "SELECT `uid`, `username`, `password` FROM `userinfo` WHERE 1";
           foreach ($pdo->query($sql) as $row){
            echo "<tr height='50px'>";
            echo "<td>{$row['username']}</td>"; 
            echo "<td>{$row['password']}</td>"; 
            echo "<td style='width:6%;table-layout:fixed'>
                    <a href='edit.php?uid={$row['uid']}'>修改</a>
                    <a href='drop.php?uid={$row['uid']}'>删除</a>
                  </td>";
            echo "<td></td>";
            echo "</tr>";
           }
        ?>
      </table>
    </div>
    <script type="text/javascript" src="/assets/jquery.min.js"></script>  
    <script type="text/javascript" src="/assets/bootstrap.min.js"></script>
    </body> 
</html>  