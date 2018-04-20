 <?php
	 try{
	        $pdo = new PDO("mysql:host=localhost;dbname=cims;","root","root");
	    }catch(PDOException $e){
	        die("数据库连接失败".$e->getMessage());
	    }

	    $pdo->query("SET NAMES 'UTF8'");

	 try{
	        $pdo_branchDB = new PDO("mysql:host=localhost;dbname=branchdb;","root","root");
	    }catch(PDOException $e){
	        die("数据库连接失败".$e->getMessage());
	    }

	    $pdo_branchDB->query("SET NAMES 'UTF8'");

	 // try{
	 //        $pdo_fzDB = new PDO("mysql:host=localhost;dbname=fzdb;","root","root");
	 //    }catch(PDOException $e){
	 //        die("数据库连接失败".$e->getMessage());
	 //    }

	 //    $pdo_fzDB->query("SET NAMES 'UTF8'");
 ?>