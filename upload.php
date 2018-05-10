<!DOCTYPE html>
<head>
    <?php
    session_start();
    include_once "/common/strap.php";
    include_once "/common/conn.php";
    if (empty($_SESSION['username']))
    {
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."/index.php"."\""."</script>";
    }
    else
    {
        $username = $_SESSION['username'];
        $sqlpass="SELECT password from userinfo where username='{$username}'";   
        foreach($pdo->query($sqlpass) as $row)
          { 
            $password = base64_decode($row['password']);
            break;
          }
    }
    ?>
    <meta charset="UTF-8">

    <title>上传获奖附件</title>

    <link rel="stylesheet" href="/assets/jquery-ui.min.css">
    <script src="/assets/jquery.min.js"></script>
    <script src="/assets/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="assets/style.css">

    <script>
        selectFile = function(){
            var docObj=document.getElementById("file");
            var imgObjPreview=document.getElementById("preview"); 

            if(docObj.files && docObj.files[0]){   //火狐浏览器
                imgObjPreview.style.display = 'block';  
                imgObjPreview.style.width = '200px';
                imgObjPreview.style.height = '200px';                        
                imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);  
            }
            else{   //IE下，使用滤镜  
                docObj.select();  
                var imgSrc = document.selection.createRange().text;  
                var localImagId = document.getElementById("localImag");
                //设置宽度和高度
                localImagId.style.width = "300px";  
                localImagId.style.height = "120px";  
                try{  
                    localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";  
                    localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
                }catch(e){  
                    alert("您上传的图片格式不正确，请重新选择!");  
                    return false;
                }
                imgObjPreview.style.display = 'none';  
                document.selection.empty();
            }  
            return true;
        }

        previouspage = function(){   //返回上一页
            window.history.back(); 
        }
    </script>

</head>
<body>
    <br><br>
     <div class="page" width="100%">
    <form id="upload" name="upload" method="post" action="upload_file.php" class="form-inline" role="form" enctype="multipart/form-data">
        <div class="panel panel-primary" width="100%">
            <div class="panel-heading">
                <h3 class="panel-title">
                    上传获奖证书照片
                </h3>
            </div>
            <div class="panel-body">
                <label for='file'>获奖证书照片：</label>  
                <input type='file' name='file' id='file' onchange='selectFile()' ><br>
                <div id="localImag">
                    <img id="preview" width=-1 height=-1 style="diplay:none" />
                </div><br>
                <input type="submit" class='btn btn-success' name="submit" value="提交" />&nbsp; &nbsp;&nbsp; &nbsp;
                <input type='button' class='btn btn-success' onclick='previouspage()' value='返回'/>

            </div>
        </div>
    </form>
</div>

</table>


</body>
</html>
