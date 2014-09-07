<?php
  $pageTitle='Списък';
  include 'includes/header.php';
  include 'includes/emptysession.php';
  include 'includes/functions.php';      
  echo $_SESSION['username']."----|".'<a href="includes/exit.php">ИЗХОД|</a>';
 

$books=mysqli_query($connect, 'SELECT * FROM books LEFT JOIN books_authors 
ON books.book_id=books_authors.book_id LEFT JOIN authors ON books_authors.author_id=authors.author_id');

if(!$books){
            echo 'Грешка в данните';
           }
           
$result=array();

while($row=$books->fetch_assoc()){
                                  $result[$row['book_id']]['books'][$row['book_id']]=$row['book_title'];
                                  $result[$row['book_id']]['authors'][$row['author_id']]=$row['author_name'];
                                  }

                                
echo '<table border="1"><tr><td><b>Книга<a href="newbook.php">(добави)</a></b></td><td><b>Автор(и)<a href="newauthor.php">(добави)</a></b></td></tr>';

foreach ($result as $title) {
                              foreach ($title['books'] as $bid => $booktitle)  {
        echo '<td><a href=book_comments.php?bid='.$bid.'>'.$booktitle.'</a></td><td>';
    }
                             $ar=array();
                             foreach ($title['authors'] as $aid=>$authorname){
                                                                     
                                                                     $ar[]='<a href=authors.php?id='.$aid.'>'.$authorname.'</a>';
                                                                  
                                                                    }
                              echo implode(' , ', $ar).'</td></tr>';
                            }  
echo '</table>';

?>
<?php
include 'includes/footer.php';
?>