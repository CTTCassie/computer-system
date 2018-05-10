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
        $sql = "SELECT `name`, `year`, `science_name`, `science_class`, `science_time`, `science_rank`, `teach_name`, `teach_class`, `teach_time`, `teach_rank`, `other_name`, `other_class`, `other_time`, `other_rank`, `famous_name`, `famous_class`, `famous_time`, `time` FROM `teacherinfo` ORDER BY `teacherinfo`.`time` desc limit $offset,$rows ";

        foreach ($pdo->query($sql) as $k => $v) {
            $data['rows'][$k]['name'] = $v['name'];
            $data['rows'][$k]['year'] = $v['year'];
            $data['rows'][$k]['science_name'] = $v['science_name'];
            $data['rows'][$k]['science_class'] = $v['science_class'];
            $data['rows'][$k]['science_time'] = $v['science_time'];
            $data['rows'][$k]['science_rank'] = $v['science_rank'];
            $data['rows'][$k]['teach_name'] = $v['teach_name'];
            $data['rows'][$k]['teach_class'] = $v['teach_class'];
            $data['rows'][$k]['teach_time'] = $v['teach_time'];
            $data['rows'][$k]['teach_rank'] = $v['teach_rank'];
            $data['rows'][$k]['other_name'] = $v['other_name'];
            $data['rows'][$k]['other_class'] = $v['other_class'];
            $data['rows'][$k]['other_time'] = $v['other_time'];
            $data['rows'][$k]['other_rank'] = $v['other_rank'];
            $data['rows'][$k]['famous_name'] = $v['famous_name'];
            $data['rows'][$k]['famous_class'] = $v['famous_class'];
            $data['rows'][$k]['famous_time'] = $v['famous_time'];
            $data['rows'][$k]['time'] = $v['time'];
        }
        $sql_count = "SELECT  count(*) FROM `teacherinfo`";
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

        $sql = "SELECT `name`, `year`, `science_name`, `science_class`, `science_time`, `science_rank`, `teach_name`, `teach_class`, `teach_time`, `teach_rank`, `other_name`, `other_class`, `other_time`, `other_rank`, `famous_name`, `famous_class`, `famous_time`, `time` FROM `teacherinfo` WHERE `science_class`='{$_POST['team']}' ORDER BY `teacherinfo`.`time` desc limit $offset,$rows ";
        foreach ($pdo->query($sql) as $k => $v) {
            $data['rows'][$k]['name'] = $v['name'];
            $data['rows'][$k]['year'] = $v['year'];
            $data['rows'][$k]['science_name'] = $v['science_name'];
            $data['rows'][$k]['science_class'] = $v['science_class'];
            $data['rows'][$k]['science_time'] = $v['science_time'];
            $data['rows'][$k]['science_rank'] = $v['science_rank'];
            $data['rows'][$k]['teach_name'] = $v['teach_name'];
            $data['rows'][$k]['teach_class'] = $v['teach_class'];
            $data['rows'][$k]['teach_time'] = $v['teach_time'];
            $data['rows'][$k]['teach_rank'] = $v['teach_rank'];
           $data['rows'][$k]['other_name'] = $v['other_name'];
            $data['rows'][$k]['other_class'] = $v['other_class'];
            $data['rows'][$k]['other_time'] = $v['other_time'];
            $data['rows'][$k]['other_rank'] = $v['other_rank'];
            $data['rows'][$k]['famous_name'] = $v['famous_name'];
            $data['rows'][$k]['famous_class'] = $v['famous_class'];
            $data['rows'][$k]['famous_time'] = $v['famous_time'];
            $data['rows'][$k]['time'] = $v['time'];
        }
        $sql_count = "SELECT  count(*) FROM `teacherinfo` WHERE `science_name` = '{$_POST['team']}'";
        $st_count = $pdo->query($sql_count);
        $row_count = $st_count->fetch();
        $data['total'] = $row_count[0];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}
if (isset($_POST['flag'])) {
    try {
        //插入获得的教师获奖信息
        $sql = "";
        if ($_POST['flag'] == "insert") {
            $sql = "INSERT INTO `teacherinfo`(`name`, `year`, `science_name`, `science_class`, `science_time`, `science_rank`, `teach_name`, `teach_class`, `teach_time`, `teach_rank`, `other_name`, `other_class`, `other_time`, `other_rank`, `famous_name`, `famous_class`, `famous_time`, `time`) VALUES ('{$_POST['name']}','{$_POST['year']}','{$_POST['science_name']}','{$_POST['science_class']}','{$_POST['science_time']}',{$_POST['science_rank']},'{$_POST['teach_name']}','{$_POST['teach_class']}','{$_POST['teach_time']}',{$_POST['teach_rank']},'{$_POST['other_name']}','{$_POST['other_class']}','{$_POST['other_time']}',{$_POST['other_rank']},'{$_POST['famous_name']}','{$_POST['famous_class']}','{$_POST['famous_time']}','{$_POST['time']}')";
        } else {    //更新数据
            //`name`, `year`, `science_name`, `science_class`, `science_time`, `science_rank`, `teach_name`, `teach_class`, `teach_time`, `teach_rank`, `other_name`, `other_class`, `other_time`, `other_rank`, `famous_name`, `famous_class`, `famous_time`, `time`
            $sql = "UPDATE `teacherinfo` SET `name`='{$_POST['name']}',`year`='{$_POST['year']}',`science_name`='{$_POST['science_name']}',`science_class`='{$_POST['science_class']}',`science_time`='{$_POST['science_time']}',`teach_name`='{$_POST['teach_name']}',`teach_class`='{$_POST['teach_class']}',`teach_time`='{$_POST['teach_time']}',`teach_rank`='{$_POST['teach_rank']}',`other_name`='{$_POST['other_name']}', `other_class`='{$_POST['other_class']}',`other_time`='{$_POST['other_time']}',`other_rank`='{$_POST['other_rank']}',`famous_name`='{$_POST['famous_name']}',`famous_class`='{$_POST['famous_class']}',`famous_time`='{$_POST['famous_time']}' WHERE `time`='{$_POST['time']}'";
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
        $sql = "DELETE FROM `teacherinfo` WHERE `time`='{$_POST['time']}' ";
        $st = $pdo->exec($sql);
        echo true;
    }
    catch(PDOException $ex){
        echo $ex;
    }
}

?>