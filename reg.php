<?php
$pageTitle='Регистрация';
include 'includes/header.php';
include 'includes/functions.php';
       
       mysqli_query($connect,'SET NAMES utf8');
if($_POST){
    $username = trim($_POST['username']);
    $username =  str_replace(' ', '', $username);
    $pass = trim($_POST['pass']);
    $pass = str_replace(' ', '', $pass);
    $username = mysqli_real_escape_string($connect,$username);
    $pass = mysqli_real_escape_string($connect,$pass);
    $error = false;
    if(mb_strlen($username)<3){
        echo '<p><h2>Името е прекалено късо</h2></p>';
        $error=true;
    }

    if(mb_strlen($pass)<3){
        echo '<p><h2>Паролата е прекалено къса</h2></p>';
        $error = true;
    }

    if(!$error){
        if( $sql="SELECT username, password FROM users WHERE username='$username'")
        {
          $result=mysqli_query($connect,$sql);
        $count=  mysqli_num_rows($result);
        if($count==1){  
            echo '<p><h2>Името е заето </h2></p>';
           }
        }
	$sql='INSERT INTO `users`(`username`,`password`) VALUES ("'.$username.'","'.$pass.'")';	
        if(mysqli_query($connect, $sql)){ 
            echo "<script>alert('Успешна регистрация') ;
                document.location = 'index.php'</script>";
            
            //  header('Location: index.php');
        }
    }
    
        }
?>
<a href="index.php">Вход</a>
<form method="POST" action="./reg.php">
    <div>Име :<input type="text" name="username" /></div>
    <div>Парола:<input type="password" name="pass" autocomplete="off" /></div>
    <div><input type="submit" value="Регистрация"  style="position: absolute; left: 170px; " /></div>
</form>
<?php 
include 'includes/footer.php';
?>