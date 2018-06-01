<html>
<head>
    <a href="/index.php">
    <img border="0" src="/image/xatu.jpg" alt="获奖信息管理系统" style="width:1350px;height:160px;"></a>

    <marquee behavior="alternate"><h4>欢迎来到西安工业大学获奖信息管理系统</h4></marquee>
    <meta charset="UTF-8">
    <?php
        include_once "../common/strap.php";
    ?> 
    <title>修改报告</title>
    <style type='text/css'>
        div{
            width: 100%;
            height: 470px;
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
     <h4>修改获奖工作量统计报告</h4>
     <br>
    <?php
    include_once "../common/conn.php";
    $id = $_GET['id'];
     
    if($id == ''){
    	 echo "<script> alert('没有要修改的数据');
                    window.history.back();
                </script>";
    }
    if($id != ''){
            $sql = "SELECT * FROM `countworkload` WHERE `id`='{$id}'";
            $stmt = $pdo->query($sql);//返回预处理对象
            if($stmt->rowCount() > 0){
                $info = $stmt->fetch(PDO::FETCH_ASSOC);//按照关联数组进行解析
            }else{
                die("没有要修改的数据！");
            }
    ?>
            <form id="editInfo" name="editInfo" method="post" action="action.php">
                <input type="hidden" name="action" value="edit"/>
                <input type="hidden" name="id" id="id" value="<?php echo $info['id'];?>"/>
                <table>
                    <tr>
                        <td>姓名</td>
                        <td><input style="width:100%;height:100%;" id="name" name="name" type="text"  value="<?php echo $info['name']?>"/></td>
                    </tr>
                    <tr>
                        <td>年度</td>
                        <td><input style="width:100%;height:100%;" type="text" name="year" id="year" value="<?php echo $info['year']?>"/></td>
                    </tr>
                    <tr>
                        <td>获奖名称</td>
                        <td><textarea rows="5" cols="50" style="width:100%;height:100%;" id="award_name" name="award_name" type="text" value="<?php echo $info['award_name']?>"/><?php echo $info['award_name']?></textarea></td>
                    </tr>
                    <tr>
                        <td>获奖积分</td>
                        <td><input style="width:100%;height:100%;" id="award_points" name="award_points" type="text"  value="<?php echo $info['award_points']?>"/></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="修改"/>&nbsp;&nbsp;
                            <input type="reset" value="重置"/>
                        </td>
                    </tr>
                </table>
            </form>
            <br><br><br>
        <label><a href="/">Copyright©西安工业大学</a></label>
    <?php
        }
    ?>
</center>
</body>
</html>
