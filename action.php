<?php

 include_once "common/conn.php";

 if (!empty($_POST["action"])){
 	switch ($_POST["action"]){
 		case 'edit':{
 			$uid = $_POST['uid'];
 			$username = $_POST['username'];
 			$password = $_POST['password'];
 			$pass = base64_encode($password);
 			$sql_update = "UPDATE `userinfo` SET `username`='{$username}',`password`='{$pass}' WHERE uid='{$uid}'";
 			$rw = $pdo->exec($sql_update);
            if($rw > 0){
                echo "<script>alert('修改成功');
                     window.location='/showuserinfo.php'
                      
                </script>";
            }else{
                echo "<script>alert('修改失败');
                      window.location='/showuserinfo.php'
                </script>";
            }
 			break;
 		}
 	}
 }


if(!empty($_GET["act"])){
    switch ($_GET["act"]){
    	case "del":{
    		$uid = $_GET['uid'];
    		$sql_delete = "SELECT * FROM `userinfo` WHERE uid='{$uid}'";
    		$stmt = $pdo->query($delete_data);
            $count = $stmt->rowCount();
            
            if($count == 0){
                echo "<script> alert('没有删除的数据');
                                window.location='top_page.php'; //跳转到首页
                     </script>";
            }else{
                $sql = "DELETE FROM `userinfo` WHERE uid='{$uid}'";
                $pdo->exec($sql);
             
                echo "<script> 
                        window.location='top_page.php' //跳转到首页
                     </script>";
            }
    		break;
    	}

    }
}

 ?>