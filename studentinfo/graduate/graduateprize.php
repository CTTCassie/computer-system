<!DOCTYPE html>
<html>
<?php
    session_start();
    include_once "../../common/top_bottom.php";
?>
<style>
    .datagrid-header span {
        font-size: 15px !important;
    }

    .datagrid-header-row {
        Height: 50px;
    }

    #table .datagrid-btable tr {
        height: 35px;
    }

    .datagrid-header-row td {
        font-size: 15px !important;
    }
</style>
<script src="../../assets/jquery.self-bd7ddd393353a8d2480a622e80342adf488fb6006d667e8b42e4c0073393abee.js?body=1"
        data-turbolinks-track="reload"></script>
<script src="../../assets/jquery_ujs.self-784a997f6726036b1993eb2217c9cb558e1cbb801c6da88105588c56f13b466a.js?body=1"
        data-turbolinks-track="reload"></script>
<script src="../../assets/bootstrap.min.js"></script>
<script src="../../assets/jquery-3.2.1.min.self-5c2148f394c0d0085e316066a9ec847d1d5335885c0ab4a32480ad882998ed3f.js?body=1"></script>
<script type="text/javascript" src="../../assets/jqueryTime.js"></script>
<script type="text/javascript" src="../../assets/jquery-calendarTime.js"></script>
<link rel="stylesheet" type="text/css" href="../../assets/css/jquery-calendar.css">
<link rel="stylesheet" type="text/css" href="../../assets/css/stylesTime.css">


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
<meta name="csrf-param" content="authenticity_token"/>
<meta name="csrf-token"
      content="RUBLbnWo8X3pdUynyA9v8fPStXj6nXmN2+vSkrPQZ+xJUcxZ7i5p3KSOE08g0xCB89VNDFWPKR9P/BwdEgxZ/w=="/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../../assets/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="../../assets/bootstrap-theme.min.css" crossorigin="anonymous">
<link href="../../assets/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../../assets/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../../assets/easyui/locale/easyui-lang-zh_CN.js"></script>
<link rel="stylesheet" href="../../assets/easyui/themes/default/easyui.css" type="text/css"/>
<link rel="stylesheet" href="../../assets/easyui/themes/icon.css" type="text/css"/>

<script src="../../assets/echarts.min.js"></script>
<body>
<body class="easyui-layout">
<div data-options="region:'north',split:true" style="height:60px;"></div>
<div data-options="region:'south',split:true" style="height:50px;"></div>
<div data-options="region:'east',split:true" style="width:50px;"></div>
<div data-options="region:'west',split:true" style="width:50px;"></div>

<div data-options="region:'center',title:'计算机学院信息化管理系统-本科生获奖信息'" style="padding:5px;height:90%;background:#eee;">
    <table id="dd" class="easyui-datagrid" toolbar="#tb" style="width:100%;height:100%;font-size:50px">
        <div>
            <select id="customCombobox" style="width:5;height:5;font-size:10px">
                <option value="各种获奖管理">各种获奖管理</option>
                <option value="国家级">国家级</option>
                <option value="省级">省级</option>
                <option value="校级">校级</option>
            </select>
            <?php
                echo "&nbsp;&nbsp;";
                $queryrecord = "window.location.href='searchRecord.php'";
                $uploading = "window.location.href='/upload.php'";
                echo "<input type='button' onclick=$queryrecord value='记录查询' />";
                echo "&nbsp;&nbsp;";
                echo "<input type='button' onclick=$uploading value='上传获奖附件' />";
            ?>
        </div>
    </table>
</div>
</body>


</body>
</html>

<script type="text/javascript" charset="utf-8">
    var datagrid; //定义全局变量datagrid
    var editRow = undefined; //定义全局变量：当前编辑的行

    $("#queryrecord").click(function(){
        var queryrecord = $("#queryrecord").val();
        var queryrecord= $.trim(queryrecord); 
        window.location.href = 'searchRecord.php';
    });
    $("#uploading").click(function(){ 
        var uploading = $("#uploading").val();
        var uploading = $.trim(uploading);
        //window.location.href = 'upload.php';
    });

    function isEndEdit(){    //判断是否结束编辑
        if(editRow == undefined){
            return true;
        }
        if($('#dd').datagrid('validateRow', editRow)){
            $('#dd').datagrid('endEdit', editRow);
            editRow = undefined;
            return true;
        }else{
            return false;
        }
    }
    
    $('#customCombobox').change(function () {
        getdata($("#customCombobox").val());
    });

    function GetDateStr(AddDayCount) {
        var dd = new Date();
        dd.setDate(dd.getDate() + AddDayCount);//获取AddDayCount天后的日期
        var y = dd.getFullYear();     //返回表示年份的四位数字
        var m = (dd.getMonth() + 1) < 10 ? "0" + (dd.getMonth() + 1) : (dd.getMonth() + 1);//获取当前月份的日期，不足10补0
        var d = dd.getDate() < 10 ? "0" + dd.getDate() : dd.getDate();//获取当前几号，不足10补0
        var hours = dd.getHours();    //获取系统时
        var minutes = dd.getMinutes();  //获取系统分
        var seconds = dd.getSeconds();  //获取系统秒
        return y + "-" + m + "-" + d + "-" + hours + "-" + minutes + "-" + seconds;
    }
    function getdata(arr) {
        var Address = [
             {"value": "国家级", "text": "国家级"}, 
             {"value": "省级", "text": "省级"}, 
             {"value": "校级","text": "校级"}, 
        ];

        datagrid = $("#dd").datagrid({
            url: "/studentinfo/graduate/updategraduate.php",  //请求的数据源
            iconCls: 'icon-save', //图标
            fitColumns: true, singleSelect: true,
            pagination: true, //显示分页
            pageSize: 50, //页大小
            pageList: [50, 65, 80, 100], //页大小下拉选项此项各value是pageSize的倍数
            fitColumn: false, //列自适应宽度
            striped: true, //行背景交换
            nowap: true, //列内容多时自动折至第二行
            border: false,
            fitColumns: true,
            pageNumber: 1,
            method: 'post',
            rownumbers: true,
            idField: 'ID', //主键
            columns: [[    //显示的列
                {field: 'Id', title: '编号', checkbox: true, hidden: true},
                {
                    field: 'name',title: '姓名',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'year',title: '年度',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'award_name',title: '获奖名称',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'award_time',title: '获奖时间',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'rank',title: '本人排名',
                    editor: {
                        type: 'numberbox',
                        options: {precision: 0}
                    }
                },
                {
                    field: 'licenceauth',title: '发证机关',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'awark_class',title: '获奖级别',
                    editor: {
                        type: 'combobox',
                        options: {editable: false, data: Address, valueField: "value", textField: "text"}
                    }
                },
                {
                    field: 'time', title: '日期'
                }
            ]],

            queryParams: {query: "true", team: arr}, //查询参数
            toolbar: [
            
                {
                    text: '增加', iconCls: 'icon-add', handler: function () {
                        var lastLine = $('#dd').datagrid("getRows").length;
                        if (editRow == undefined) {
                            datagrid.datagrid('insertRow', {

                                index: lastLine,   //从最后一条记录插入
                                row: {
                                    time: GetDateStr(0)
                                }
                            });

                            datagrid.datagrid('beginEdit', lastLine);
                            editRow = lastLine;
                        }
                    }
                }, '-', {
                        text: '保存',iconCls: 'icon-save',handler: function(){
                        if(isEndEdit()){   //判断是否结束编辑
                            var check = true;
                            var arr;
                            var row = datagrid.datagrid("getChanges", "updated");
                            if (row.length == 0) {
                                row = datagrid.datagrid("getChanges", "inserted");
                                arr = {
                                    "flag": "insert",
                                    "name": row[0].name,
                                    "year": row[0].year,
                                    "award_name": row[0].award_name,
                                    "award_time": row[0].award_time,
                                    "rank": row[0].rank,
                                    "licenceauth": row[0].licenceauth,
                                    "awark_class": row[0].awark_class,
                                    "time": row[0].time
                                }
                            } else {
                                arr = {
                                    "flag": "rowIndex",
                                    "name": row[0].name,
                                    "year": row[0].year,
                                    "award_name": row[0].award_name,
                                    "award_time": row[0].award_time,
                                    "rank": row[0].rank,
                                    "licenceauth": row[0].licenceauth,
                                    "awark_class": row[0].awark_class,
                                    "time": row[0].time
                                }
                            }
                            if (check) {
                                $.ajax({
                                    type: "post",
                                    url: 'updategraduate.php',
                                    data: arr,
                                    async: false,
                                    dataType: "json",
                                    success: function (data) {

                                        $("#dd").datagrid('reload');
                                    },
                                    complete: function () {
                                        //请求完成的处理  
                                        alert("数据保存成功");
                                        $("#dd").datagrid('reload');
                                    },
                                    error: function (data) {
                                        flag = -1;
                                        $("#dd").datagrid('reload');
                                    }
                                });
                            } else {
                                alert("输入含有非法字符或为空");
                                $("#dd").datagrid('reload');
                            }
                        }

                        editRow = undefined;

                    }
                }, '-', {
                    text: '取消',iconCls: 'icon-undo',handler: function(){
                        $('#dd').datagrid('rejectChanges');
                        editRow = undefined;
                    }
                }, '-', {  
                        text: '删除', iconCls: 'icon-remove', handler: function () {
                        var row = $('#dd').datagrid("getSelections","deleted");
                        if(row.length <= 0){
                            alert("您尚未选择要删除的数据");
                        }
                        else{
                            
                            var arr = {
                                "del": "true", 
                                "time": row[0].time
                            };

                            $.ajax({
                                url: "updategraduate.php",    //请求的url地址  
                                dataType: "json",   //返回格式为json
                                async: true,//请求是否异步，默认为异步，这也是ajax重要特性
                                data: arr,    //参数值
                                type: "post",   //请求方式 get 或者post
                                beforeSend: function () {
                                    //请求前的处理  
                                },
                                success: function (req) {
                                    $("#dd").datagrid('reload');
                                },
                                complete: function () {
                                    //请求完成的处理  
                                    alert("删除成功");
                                    $("#dd").datagrid('reload');
                                },
                                error: function (req) {
                                    //请求出错处理
                                    $("#dd").datagrid('reload');
                                }
                            });
                        }
                        editRow = undefined;    //当删除结束之后清空当前编辑行
                    }

                }, '-'],
            onClickRow: function (rowIndex, rowData) {
                //单击开启编辑行
                if (editRow != undefined) {
                    datagrid.datagrid("endEdit", editRow);
                }
                if (editRow == undefined) {
                    datagrid.datagrid("beginEdit", rowIndex);
                    editRow = rowIndex;
                }
            },
            onClickCell: function (rowIndex, field, value) {
                if (editRow != undefined) {
                    datagrid.datagrid("endEdit", editRow);
                    editRow = undefined;
                }
            }
        })
    }

    getdata("各种获奖管理");

    
</script>