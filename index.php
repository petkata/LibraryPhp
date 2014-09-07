<?php
$pageTitle='Вход';
include 'includes/header.php';
include 'includes/functions.php';    
if(isset($_SESSION['login'])==TRUE){

       header('Location: books.php');
  }
 else {
    if($_POST){
        
        mysqli_query($connect,'SET NAMES utf8');
    $username=  trim($_POST['username']);
    $pass=  trim($_POST['pass']);
    
    $sql="SELECT username, password FROM users WHERE username='$username' and password='$pass'";
    $result=mysqli_query($connect,$sql);
    $count=  mysqli_num_rows($result);
    if($count==1){
        $_SESSION['login']=TRUE;
        $_SESSION['username']=$username;
        header('Location: index.php');
        exit ;
    }
    else {
        echo "Грешно име или парола";
    }
  }
?>
<form method="POST" action="./index.php">
    <div>
        Име на потребител: <input type="text" name="username" />
    </div>
    <div>
        Парола : <input type="password" name="pass" />
    </div>
    <div>
        <input type="submit" value="Вход" />
        <input type="button" value="Регистрация" onclick="location.href='reg.php'">
   </div>
</form>
<?php
 }
include 'includes/footer.php';
?>