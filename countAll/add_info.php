<html>
<head>
    <a href="/index.php">
    <img border="0" src="/image/xatu.jpg" alt="获奖信息管理系统" style="width:1350px;height:160px;"></a>
    <marquee behavior="alternate"><h4>欢迎来到西安工业大学获奖信息管理系统</h4></marquee>
    <meta charset="UTF-8">
      <?php
        include_once "../common/strap.php";
    ?> 
    <style type='text/css'>
        div{
            width: 100%;
            height: 470px;
            background: -webkit-linear-gradient(
                top,white,lightblue,skyblue
            );
        }
    </style>
    <title>新建报告-</title>
     <script>

    </script>
</head>
<body>
<center>
    <br><br><br>
     <h3>新建获奖工作量统计报告</h3>
     <br>
    <?php
    include_once "../common/conn.php";

    $sql = "SELECT * FROM `countworkload` WHERE `id`='{$_GET['id']}'";
    $id = $_GET['id'];
    $stmt = $pdo->query($sql);
    if($stmt->rowCount()>0){
        $info = $stmt->fetch(PDO::FETCH_ASSOC);
    }else{
        die("没有要修改的数据！");
    }

    ?>
    <form id="addInfo" name="addInfo" method="post" action="action.php">
        <input type="hidden" name="action" value="addInfo"/>
        <input type="hidden" name="test_type" value="获奖工作量统计"/>
        <input type="hidden" name="id" value="<?php echo $id?>"/>
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
                <td><input type="submit" value="增加"/>&nbsp;&nbsp;
                    <input type="reset" value="重置"/>
                </td>
            </tr>
        </table>
    </form>
    <br><br><br>
    <label><a href="/">Copyright©西安工业大学</a></label>
</center>
</body>
</html>