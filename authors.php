<?php
$pageTitle="Автор" ;
include 'includes/header.php';
include 'includes/emptysession.php';
include 'includes/functions.php';
echo '<a href="includes/exit.php"><h2>ИЗХОД</h2></a>';
echo '<a href="books.php">Книги</a>';
$authorid=$_GET['id'];
$authors=mysqli_query($connect, 'SELECT * FROM books INNER JOIN books_authors as ba
ON books.book_id=ba.book_id 
Inner join books_authors as bas 
on bas.book_id=ba.book_id Inner join authors as a 
on a.author_id=bas.author_id
Where ba.author_id= '.$authorid.'');
if(!$authors){
            echo 'Грешка в данните';
           }
          
           $result=array();

while($row=$authors->fetch_assoc()){
                                   $result[$row['book_id']]['books'][$row['book_id']]=$row['book_title'];
                                  $result[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
                                  } 

                                  
echo '<table border="1"><tr><td><b>Книга</b></td><td><b>Автор(и)</b></td></tr>';

foreach ($result as $title) {
                             foreach ($title['books'] as $bid => $booktitle) {
        echo '<tr><td><a href=book_comments.php?bid='.$bid.'>'.$booktitle.'</a></td><td>';
    }                           
                             
                             $ar=array();
                             foreach ($title['authors'] as $aid=>$authorname){
                                                                     
                                                                     $ar[]='<a href=authors.php?id='.$aid.'>'.$authorname.'</a>';
                                                                  
                                                                    }
                              echo implode(' , ', $ar).'</td></tr>';
                            }  
echo '</table>';
if (isset($aid)!=$authorid){
                                 echo 'НЯМА ТАКЪВ АВТОР   (<a href="newauthor.php">Добави автор</a>)';
                                }
elseif ($authorid==NULL){header('Location: books.php');}
include 'includes/footer.php';
?>
