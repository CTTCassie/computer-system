<!DOCTYPE html>
<head>
    <?php
    session_start();
    include_once "../common/strap.php";
    include_once "../common/conn.php";
    if (empty($_SESSION['username']))
    {
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."../login.php"."\""."</script>";
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
</head>
</html>
