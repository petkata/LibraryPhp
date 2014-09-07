<?php

$bookid=$_GET['bid'];

if($_POST){
$comm = trim($_POST['txt']);
$comm = mysqli_real_escape_string($connect,$comm);

$date = date("Y-m-d H:i:s", strtotime('+1 hours'));
$error = false;
    
    if(mb_strlen($comm)<2 || mb_strlen($comm)>250 ){
        echo '<p><h3>коментара трябва да съдържа от 2 до 250 символа</h3></p>';
        $error=true;
    }
    if(!$error){
        mysqli_query($connect,'INSERT INTO `comments` (`comment_content`, username ) VALUES("'.$comm.'", "'.$_SESSION['username'].'" )');
                                 if (mysqli_error($connect)) {
            echo 'Error v comment';
            exit;
        } 
                                     $id = mysqli_insert_id($connect);
        //**************************
   mysqli_query($connect,'insert into books_comments (book_id, comment_id) value ( 
 (SELECT `book_id`
FROM `books`
WHERE `book_id` ="'.$bookid.'") , ' . $id . ' )');
   if (mysqli_error($connect)) {
            echo 'Error v BC';
            exit;
        }
                                     
        //**************************
//$sql='INSERT INTO `comments`(comment_date ,comment_content ,username) VALUES ("'.$date.'","'.$comm.'","'.$_SESSION['username'].'")';
/*if(mysqli_query($connect, $sql)){    
               header('Location: book_comments.php?bid='.$bookid.'');
        }*/
    }
}
$q= mysqli_query($connect, 'SELECT *
FROM books
INNER JOIN books_comments AS bc ON books.book_id = bc.book_id
INNER JOIN comments AS c ON c.comment_id = bc.comment_id Where bc.book_id="'.$bookid.'"');
if(!$q){
    echo 'Грешка в базата';
}

while($row=$q->fetch_assoc()){
    echo '<br>На&nbsp'.$row['comment_date'].'&nbsp<b><i>'.$row['username'].'</i></b>&nbspнаписа&nbsp:
        
<br>'.$row['comment_content'].'<br>';}
?>
<form method="POST" >
   
    <div><p> <br><textarea name="txt" rows="5" cols="40" placeholder="Коментара трябва да съдържа от 2 до 250 символа" ></textarea></p></div>
    <div><input type="submit" value="Коментирай"  />
        
    </div>
    </form>
<?php
include 'includes/footer.php';
?>
