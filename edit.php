<html>
<head>
    <meta charset="UTF-8">
    <?php
        include_once "common/strap.php";
    ?> 
    <title>修改用户信息表</title>
    <style type='text/css'>
        div{
            width: 100%;
            height: 750px;
            background: -webkit-linear-gradient(
                top,white,lightblue,skyblue
            );
        }
    </style>
    <script>

    </script>
</head>
<body>
<center>
     <br><br><br>
     <h4>编辑用户账号信息</h4>
     <br>
    <?php
    include_once "common/conn.php";

    $uid = $_GET['uid'];
     
    if($uid == ''){
    	 echo "<script> alert('没有要修改的数据');
                    window.history.back();
                </script>";
    }
    if($uid != ''){
            $sql = "SELECT * FROM `userinfo` WHERE uid=".$uid;
            $stmt = $pdo->query($sql);//返回预处理对象
            if($stmt->rowCount() > 0){
                $info = $stmt->fetch(PDO::FETCH_ASSOC);//按照关联数组进行解析
                $pass = base64_decode($info['password']);
            }else{
                die("没有要修改的数据！");
            }
    ?>
            <form id="editInfo" name="editInfo" method="post" action="action.php">
                <input type="hidden" name="action" value="edit"/>
                <input type="hidden" name="uid" id="uid" value="<?php echo $info['uid'];?>"/>
                <table>
                    <tr>
                        <td>用户名</td>
                        <td><input style="width:100%;height:100%;" type="text" name="username" id="username" value="<?php echo $info['username']?>"/></td>
                    </tr>
                    <tr>
                        <td>密码</td>
                        <td><input style="width:100%;height:100%;" type="text" name="password" id="password" value="<?php echo $pass?>"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="修改"/>&nbsp;&nbsp;
                            <input type="reset" value="重置"/>&nbsp;&nbsp;
                        </td>
                    </tr>
                </table>
            </form>
    <?php
        }
    ?>
</center>
</body>
</html>
