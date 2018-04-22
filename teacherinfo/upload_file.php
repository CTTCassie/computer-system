<?php

$allowedExts = array("rar", "exe","xml","cov","exe","PNG","png","jpg");  // 允许上传的图片后缀

$temp = explode(".", $_FILES["file"]["name"]); // 获取文件后缀名
$extension = end($temp);

$ROOTPATH = "C:\wamp64\www\image";   //上传附件存储位置

//上传限制条件
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "application/octet-stream")
|| ($_FILES["file"]["type"] == "text/xml")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"]/1000 < 10240)   // 小于 10M
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br/>";
        echo "文件类型: " . $_FILES["file"]["type"] ."<br/>";
        echo "文件大小: " . ($_FILES["file"]["size"]) . " kB<br/>";
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] ."<br/>";

        //自定义文件名
        $filename =  date('Y-m-j');
        $array = $_FILES["file"]["type"];  
        $array = explode("/",$array);  
        $_FILES["file"]["name"] = $filename.".".$array[1];

        $url = $ROOTPATH . "\\" . $_FILES["file"]["name"];
        echo $url,"<br>";
        if (file_exists($url . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . "文件已经存在";
        }
        else
        {
            move_uploaded_file($_FILES["file"]["tmp_name"], $url);
            echo "上传成功";
        }
    }
}
else
{
    echo "非法的文件格式";
}
?>

<html>  
<body>  
    <br><br>  
    <img src="<?php echo $url;?>" alt="image">  
</body>  
</html> 