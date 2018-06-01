<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/common/conn.php";
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['query'])) {
    if ($_POST['team']=="各种获奖管理") {
        $data = array();
        $data['rows'][0]['team'] = "";
        $data['total'] = "";
        $curtime = date('Y-m-d');
        $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
        $rows = (isset($_GET['rows'])) ? intval($_GET['rows']) : 50;
        $offset = ($page - 1) * $rows;

        $sql = "SELECT `name`, `year`, `award_name`, `award_time`, `rank`, `licenceauth`, `awark_class`, `time` FROM `graduate` ORDER BY `graduate`.`time` desc limit $offset,$rows";

        foreach ($pdo->query($sql) as $k => $v) {
            $data['rows'][$k]['name'] = $v['name'];
            $data['rows'][$k]['year'] = $v['year'];
            $data['rows'][$k]['award_name'] = $v['award_name'];
            $data['rows'][$k]['award_time'] = $v['award_time'];
            $data['rows'][$k]['rank'] = $v['rank'];
            $data['rows'][$k]['licenceauth'] = $v['licenceauth'];
            $data['rows'][$k]['awark_class'] = $v['awark_class'];
            $data['rows'][$k]['time'] = $v['time'];
        }
        $sql_count = "SELECT  count(*) FROM `graduate`";
        $st_count = $pdo->query($sql_count);
        $row_count = $st_count->fetch();
        $data['total'] = $row_count[0];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }else {

        $data = array();
        $data['rows'][0]['team'] = "";
        $data['total'] = "";
        $curtime = date('Y-m-d');
        $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
        $rows = (isset($_GET['rows'])) ? intval($_GET['rows']) : 50;

        $sql = "SELECT `name`, `year`, `award_name`, `award_time`, `rank`, `licenceauth`, `awark_class`, `time` FROM `graduate` WHERE `awark_class`='{$_POST['team']}' ORDER BY `graduate`.`time` desc limit $offset,$rows";
        foreach ($pdo->query($sql) as $k => $v) {
            $data['rows'][$k]['name'] = $v['name'];
            $data['rows'][$k]['year'] = $v['year'];
            $data['rows'][$k]['award_name'] = $v['award_name'];
            $data['rows'][$k]['award_time'] = $v['award_time'];
            $data['rows'][$k]['rank'] = $v['rank'];
            $data['rows'][$k]['licenceauth'] = $v['licenceauth'];
            $data['rows'][$k]['awark_class'] = $v['awark_class'];
            $data['rows'][$k]['time'] = $v['time'];
        }
        $sql_count = "SELECT  count(*) FROM `graduate` WHERE `awark_class` = '{$_POST['team']}'";
        $st_count = $pdo->query($sql_count);
        $row_count = $st_count->fetch();
        $data['total'] = $row_count[0];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
if (isset($_POST['flag'])) {
    $pigeonhole = 0;
    try {
        //插入获得的本科生获奖信息
        $sql = "";
        if ($_POST['flag'] == "insert") {
            $sql = "INSERT INTO `graduate`(`name`, `year`,`pigeonhole`, `award_name`, `award_time`, `rank`, `licenceauth`, `awark_class`, `time`) VALUES ('{$_POST['name']}','{$_POST['year']}','{$pigeonhole}','{$_POST['award_name']}','{$_POST['award_time']}','{$_POST['rank']}','{$_POST['licenceauth']}','{$_POST['awark_class']}','{$_POST['time']}')";
        } else {    //更新数据
            $sql = "UPDATE `graduate` SET `name`='{$_POST['name']}', `year`='{$_POST['year']}',`award_name`='{$_POST['award_name']}',`award_time`='{$_POST['award_time']}',`rank`='{$_POST['rank']}',`licenceauth`='{$_POST['licenceauth']}',`awark_class`='{$_POST['awark_class']}' WHERE `time`='{$_POST['time']}'";
        }
        $st = $pdo->exec($sql);
        echo $st->rowCount();

    }
    catch(PDOException $ex) {
        echo $sql_inser;
    }
}

if(isset($_POST['del'])){
    try{
        //要删除的字段必须和用户输入完全一致
        $sql = "DELETE FROM `graduate` WHERE `time`='{$_POST['time']}' ";
        $st = $pdo->exec($sql);
        echo true;
    }
    catch(PDOException $ex){
        echo $ex;
    }
}

if(isset($_POST['pipe'])){   //归档
    $pigeonhole = 1;
    try{
        $sql = "UPDATE `graduate` SET `pigeonhole`='{$pigeonhole}' WHERE `name`='{$_POST['name']}' and `time`='{$_POST['time']}' ";
        $st = $pdo->exec($sql);
        echo true;
    }
    catch(PDOException $ex){
        echo $ex;
    }
}

if(isset($_POST['check'])){  //审核
    $pigeonhole = 1;
    try{
        $sql = "SELECT * FROM `graduate` WHERE `pigeonhole`='{$pigeonhole}' and `name`='{$_POST['name']}' and `time`='{$_POST['time']}' ";
        $st = $pdo->exec($sql);
        echo true;
    }
    catch(PDOException $ex){
        echo $ex;
    }
}

?>