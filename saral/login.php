if<!DOCTYPE html>
<html lang="en-US">

  <head>
  <meta charset="utf-8">
   <title>Login Backend</title>

  </head>
  <body >
  <?php 
  session_start();
 
  	if(isset($_POST['login-Button']))
	{
		 
		if(!isset( $_POST['userName'], $_POST['password']))
{
    $_SESSION['msg'] = 'Sorry, You are not allowed';
}
else
{
	
	
	$userName = $_POST['userName'];
	$userPassword = $_POST['password'];
	$servername = "localhost";
    $username = "root";
    $password = "root";
    if((!empty($userName))&&(!empty($userPassword)))
    {
    $connection = mysqli_connect($servername, $username, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    } 
   
     $result=mysqli_query($connection,"select * from loginform where uname='".$userName."'");
       
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	if((mysqli_num_rows($result)==1)&&(password_verify($userPassword,$row['password']))){
		
		if($row['status'] == 0)
		{
			$_SESSION['msg']='Your account has not been verified yet.';
			header('location:index.php');
		}
		else{

		 $_SESSION['Name']=$row['name'];
		 $_SESSION['userName']=$row['uname'];
		 $_SESSION['rollno']=$row['rollno'];
		 $_SESSION['isLogin']=true;
		if( $row['access']==0)
		{
			$_SESSION["access"]=0;
		header("location:practise.php");
	}elseif ($row['access']==1) {
		$_SESSION['access']=1;

		header("location:practise.php");
		
	}
}
}

	else {

		$_SESSION['msg'] = "Invalid Username or password";
		
		header("location:index.php");

	}
}



}
	}
	if(isset($_POST['register-Button']))
	{
		$servername = "localhost";
        $userName = "root";
        $password = "root";

        $connection = mysqli_connect($servername, $userName, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    } 
   
     $result=mysqli_query($connection,"select * from loginform where uname='".$_POST['username']."'");
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	if(mysqli_num_rows($result)>0){
		$_SESSION['msg']="Member already Exists";

		
		if($row['status']=='0')
		{
			
			 $message="Please click the link below to activate your account http://getmnc.com/mailverification.php?em=$row[uname]&vhash=$row[hash]";
	        if(mail($row['uname'],"GETMNC Account Validation",$message,"From:Team GETMNC"))
	        {
	        	$_SESSION['msg']="Username is already registered. Verification link has been sent.";
	        	header("location:practise.php");
	        }
	        else
	        {
	        	$_SESSION['msg']="Sorry! something went wrong please try after some time.";
	  	header('location:index.php');
	        }
	          
		}
		header('location:index.php'); 
	  }
	else{

        $epass=password_hash($_POST['password'], PASSWORD_BCRYPT);
        $hash = md5(rand());

	 

	//  $message="Please click the link below to activate your account http://getmnc.com/mailverification.php?em=$_POST[username]&vhash=$hash";
	 // $v=mail($_POST['username'],"GETMNC Account Validation",$message,"From:Team GETMNC");
	  
	 // if($v)
	  {
	  	$_SESSION['msg']="Validation link has been sent to your mail.";
	  	 mysqli_query($connection,"Insert into loginform values('$_POST[name]','$_POST[rno]','$_POST[college]','$_POST[username]','$epass',0,'$hash',0)");
	  	header('location:index.php');
	  }
	 /* else{
	  	$_SESSION['msg']="Sorry! something went wrong please try after some time.";
	  	header('location:index.php');
	  }*/

	}

		
	}

?>
</body>
</html>

