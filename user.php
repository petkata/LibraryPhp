<?php
$pageTitle='Потребител';
  include 'includes/header.php';
  include 'includes/emptysession.php';
  include 'includes/functions.php';      
 echo '<a href="includes/exit.php"><h2>ИЗХОД</a></h2>';
 echo $_SESSION['username'];
 $sql=  mysqli_query($connect, 'SELECT * FROM books as b Left Join books_comments as bc ON bc.book_id=b.book_id 
     Left join comments ON comments.comment_id=bc.comment_id WHERE comments.username="'.$_GET['name'].'"');
 if (mysqli_error($connect)) {
            echo 'Грешка';
            exit;
        }
$result=array();

while ($row = $sql->fetch_assoc()) {
    $result[$row['book_id']]['books'][$row['book_id']]=$row['book_title'];
    $result[$row['book_id']]['comments'][$row['comment_id']]=$row['comment_content'];
   $result[$row['book_id']]['comment_id'][$row['comment_id']]=$row['comment_date'];
}
echo '<br>'.$_GET['name'];
 echo '<table><tr><td>КНИГА</td><td>KОМЕНТАР</td><td>НАПИСАН НА</td></tr>';
foreach ($result as $value) {
    foreach ($value['books'] as $bid => $booktitle) {
         echo '<tr><td><a href=book_comments.php?bid='.$bid.'>'.$booktitle.'</a></td><td>';
    }$com=[];
    foreach ($value['comments'] as $cid => $comcontent) {
        $com[]=$comcontent; 
    }echo implode('<br>', $com).'</td><td>';
    $date=[];
    foreach ($value['comment_id'] as $did => $comdate) {
        $date[] =$comdate;
    }echo implode('<br>', $date).'</td></tr>';
}echo '</table>';
include 'includes/footer.php';
?>
