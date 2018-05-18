<!DOCTYPE html>
<html>
<?php
    session_start();
    include_once "../common/top_bottom.php";
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
<script src="../assets/jquery.self-bd7ddd393353a8d2480a622e80342adf488fb6006d667e8b42e4c0073393abee.js?body=1"
        data-turbolinks-track="reload"></script>
<script src="../assets/jquery_ujs.self-784a997f6726036b1993eb2217c9cb558e1cbb801c6da88105588c56f13b466a.js?body=1"
        data-turbolinks-track="reload"></script>
<script src="../assets/bootstrap.min.js"></script>
<script src="../assets/jquery-3.2.1.min.self-5c2148f394c0d0085e316066a9ec847d1d5335885c0ab4a32480ad882998ed3f.js?body=1"></script>
<script type="text/javascript" src="../assets/jqueryTime.js"></script>
<script type="text/javascript" src="../assets/jquery-calendarTime.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/jquery-calendar.css">
<link rel="stylesheet" type="text/css" href="../assets/css/stylesTime.css">


<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
<meta name="csrf-param" content="authenticity_token"/>
<meta name="csrf-token"
      content="RUBLbnWo8X3pdUynyA9v8fPStXj6nXmN2+vSkrPQZ+xJUcxZ7i5p3KSOE08g0xCB89VNDFWPKR9P/BwdEgxZ/w=="/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../assets/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="../assets/bootstrap-theme.min.css" crossorigin="anonymous">
<link href="../assets/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../assets/easyui/jquery.min.js"></script>
<script type="text/javascript" src="../assets/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="../assets/easyui/locale/easyui-lang-zh_CN.js"></script>
<link rel="stylesheet" href="../assets/easyui/themes/default/easyui.css" type="text/css"/>
<link rel="stylesheet" href="../assets/easyui/themes/icon.css" type="text/css"/>

<script src="../assets/echarts.min.js"></script>
<body>
<body class="easyui-layout">
<div data-options="region:'north',split:true" style="height:60px;"></div>
<div data-options="region:'south',split:true" style="height:50px;"></div>
<div data-options="region:'east',split:true" style="width:50px;"></div>
<div data-options="region:'west',split:true" style="width:50px;"></div>
<div data-options="region:'center',title:'计算机学院信息化管理系统-教师获奖信息'" style="padding:5px;height:90%;background:#eee;">
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
                $uploading = "window.location.href='upload.php'";
                $student = "window.location.href='/studentinfo/student.php'";
                echo "<input type='button' onclick=$queryrecord value='记录查询' />";
                echo "&nbsp;&nbsp;";
                echo "<input type='button' onclick=$uploading value='上传获奖附件' />";
                echo "&nbsp;&nbsp;";
                echo "<input type='button' onclick=$student value='查看学生获奖信息' />";
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
        var Address1 = [
             {"value": "A类", "text": "A类"}, 
             {"value": "B类", "text": "B类"}, 
             {"value": "C类", "text": "C类"}, 
        ];

        datagrid = $("#dd").datagrid({
            url: "/teacherinfo/updaterecord.php",  //请求的数据源
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
                    field: 'year',title: '统计年度',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'science_name',title: '科研获奖名称',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'science_class',title: '科研获奖类别',
                    editor: {
                        type: 'combobox',
                        options: {editable: false, data: Address, valueField: "value", textField: "text"}
                    }
                },
                {
                    field: 'science_time',title: '科研获奖时间',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'science_rank',title: '科研获奖排名',
                    editor: {type: 'validatebox'}
                    /*editor: {
                        type: 'numberbox',
                        options: {precision: 0}
                    }*/
                },
                {
                    field: 'teach_name',title: '教学获奖名称',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'teach_class',title: '教学获奖类别',
                    editor: {
                        type: 'combobox',
                        options: {editable: false, data: Address, valueField: "value", textField: "text"}
                    }
                },
                {
                    field: 'teach_time',title: '教学获奖时间',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'teach_rank',title: '教学获奖排名',
                    editor: {type: 'validatebox'}
                    /*editor: {
                        type: 'numberbox',
                        options: {precision: 0}
                    }*/
                },
                {
                    field: 'other_name',title: '其他获奖名称',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'other_class',title: '其他获奖类别',
                    editor: {
                        type: 'combobox',
                        options: {editable: false, data: Address, valueField: "value", textField: "text"}
                    }
                },
                {
                    field: 'other_time',title: '其他获奖时间',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'other_rank',title: '其他获奖排名',
                    editor: {type: 'validatebox'}
                    /*editor: {
                        type: 'numberbox',
                        options: {precision: 0}
                    }*/
                },
                {
                    field: 'famous_name',title: '显著业绩名称',
                    editor: {type: 'validatebox'}
                },
                {
                    field: 'famous_class',title: '业绩类(级)别',
                    editor: {
                        type: 'combobox',
                        options: {editable: false, data: Address1, valueField: "value", textField: "text"}
                    }
                },
                {
                    field: 'famous_time',title: '显著业绩获得时间',
                    editor: {type: 'validatebox'}
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
                                    "science_name": row[0].science_name,
                                    "science_class": row[0].science_class,
                                    "science_time": row[0].science_time,
                                    "science_rank": row[0].science_rank,
                                    "teach_name": row[0].teach_name,
                                    "teach_class": row[0].teach_class,
                                    "teach_time": row[0].teach_time,
                                    "teach_rank": row[0].teach_rank,
                                    "other_name": row[0].other_name,
                                    "other_class": row[0].other_class,
                                    "other_time": row[0].other_time,
                                    "other_rank": row[0].other_rank,
                                    "famous_name": row[0].famous_name,
                                    "famous_class": row[0].famous_class,
                                    "famous_time": row[0].famous_time,
                                    "time": row[0].time
                                }
                            } else {
                                arr = {
                                    "flag": "rowIndex",
                                    "name": row[0].name,
                                    "year": row[0].year,
                                    "science_name": row[0].science_name,
                                    "science_class": row[0].science_class,
                                    "science_time": row[0].science_time,
                                    "science_rank": row[0].science_rank,
                                    "teach_name": row[0].teach_name,
                                    "teach_class": row[0].teach_class,
                                    "teach_time": row[0].teach_time,
                                    "teach_rank": row[0].teach_rank,
                                    "other_name": row[0].other_name,
                                    "other_class": row[0].other_class,
                                    "other_time": row[0].other_time,
                                    "other_rank": row[0].other_rank,
                                    "famous_name": row[0].famous_name,
                                    "famous_class": row[0].famous_class,
                                    "famous_time": row[0].famous_time,
                                    "time": row[0].time
                                }
                            }
                            if (check) {
                                $.ajax({
                                    type: "post",
                                    url: 'updaterecord.php',
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
                                url: "updaterecord.php",    //请求的url地址  
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