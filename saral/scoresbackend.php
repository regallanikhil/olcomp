<!DOCTYPE html>
<html>
<head>
  <title>Scores</title>
  <style type="text/css">
    body{
    background: #f1f1f1;
  }
  #pagecontent{
      background: white;
    position: absolute;
    left:10%;
    width:80%; 
    height: 100%;
}
  th,tr,td{
    border: 1px solid black;
    padding: 3px;

  }
  table{
    position: relative;
    left: 27%;
    top: 20%;
    width: 60%;
  }
  h1{
    position: absolute;
    left: 45%;
  }
  #back{
    position: absolute;
    top: 13%;
    left: 50%;
  }
   #download{
    position: absolute;
    top: 14%;
    left: 55%;
  }

  </style>
  <script type="text/javascript">
    function bck()
    {
      window.open('scores.php','_self');

    }
  </script>
</head>
<body>
<div id='pagecontent'>
<h1>Scores List</h1>
<?php
session_start();
if(!$_SESSION['isLogin'])
{
header('location:index.php');
}
if(!$_SESSION['access']){
include('usernavigation.html');

}
else include('verticalNavigation.html');
    $servername="localhost";
    $username = "root";
    $password = "root";
    $connection = mysqli_connect($servername, $username, $password,"editor");
    if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    } 
 if(isset($_POST['scorecard']))
{

if($_SESSION['access'])
{ 
		$_SESSION['contestcode']=$_POST['contestcode'];
        $result=mysqli_query($connection,"select * from $_POST[contestcode]");
        if(mysqli_num_rows($result)>0)
    {
     echo '<table>
    
  <tr>
    <th>ContestantName</th>
    <th>UserName</th>
    <th>programcode</th>
    <th>Score</th>
    
  </tr>';
  
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
       echo '

  <tr>
    <td>'.$row['contestantname'].'</td>
    <td>'.$row['username'].'</td>
     <td>'.$row['programcode'].'</td>
    <td>'.$row['score'].'</td>
    
  </tr>';
  

    }
    echo "</table>";
     }else{
     echo "<script>alert('No contests found....');
window.open('scores.php','_self');
 </script>";
  }
  }
  if(!$_SESSION['access'])
  {
	  $user=$_SESSION['userName'];  
    $result=mysqli_query($connection,"select * from $_POST[contestcode] where username='$user'");
     if(mysqli_num_rows($result)>0)
    {
    echo '<table>
    
  <tr>
    <th>ContestantName</th>
    <th>programcode</th>
    <th>Score</th>
    
  </tr>';
  
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
       echo '

  <tr>
    <td>'.$row['contestantname'].'</td>
    <td>'.$row['programcode'].'</td>
    <td>'.$row['score'].'</td>
    
  </tr>';
  

    }
    echo "</table>";
     }else{
     echo "<script>alert('No contests found ....');
window.open('scores.php','_self');
 </script>";
  }
  }
}
?>
<button id='back' onclick="bck()" >Back</button>
</div>
<?23-12-2017php
  if($_SESSION['access'])
  {
	  echo'<div >
            <form class="form" action="functions.php" method="post" name="upload_excel"   
                      enctype="multipart/form-data">
                  <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <input id="download" type="submit" name="Export" value="Download"/>
                            </div>
                   </div>                    
            </form>           
		</div>';
  }
?>
</body>
</html>
