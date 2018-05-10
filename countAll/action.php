<?php

 include_once "../common/conn.php";

if (!empty($_POST["action"])) {
    switch ($_POST["action"]) {
        case 'edit':{
            $id = $_POST['id'];
            $name = $_POST['name'];
            $year = $_POST['year'];
            $award_name = $_POST['award_name'];
            $award_points = $_POST['award_points'];
            $id = $_POST['id']; 

            $sql_update = "UPDATE `countworkload` SET `name`='{$name}', `year`='{$year}', `award_name`='{$award_name}', `award_points`='{$award_points}' WHERE id='{$id}'";
            $rw = $pdo->exec($sql_update);
            if($rw > 0){
                echo "<script>alert('修改成功');
                     window.location='count.php'
                      
                </script>";
            }else{
                echo "<script>alert('修改失败');
                      window.history.back();
                </script>";
            }
            break;
        }

        case 'addInfo':{  
            $name = $_POST['name'];
            $year = $_POST['year'];
            $award_name = $_POST['award_name'];
            $award_points = $_POST['award_points'];
            $id = $_POST['id']; 
            $date =  date("Y-m-d-h-i-sa");
            if(empty($_POST['test_type']) || $_POST['test_type']=='获奖工作量统计'){

                $sql = "INSERT INTO `countworkload`(`name`, `year`, `award_name`, `award_points`, `time`, `id`) VALUES ('{$name}','{$year}','{award_name}','{$award_points}','{$date}',null)";
                
                $sql_date = "UPDATE `countworkload` SET `time`=now() WHERE `id`='{$id}' ";
                echo $sql;
                $rw = $pdo->exec($sql);
                $pdo->exec($sql_date);

                if ($rw > 0) {
                    echo "<script> alert('增加成功');
                                    window.location = 'count.php';
                             </script>";
                } else {
                    echo "<script> alert('增加失败');
                                     window.history.back(); //返回上一页   
                             </script>";
                }
            }   
        break;
    }
 } 
}

if(!empty($_GET["act"])){
    switch ($_GET["act"]) {
      
    }
}
?>