<?php

    

 while($row=$books->fetch_assoc()){
                                  $result[$row['book_id']]['books'][$row['book_id']]=$row['book_title'];
                                  $result[$row['book_id']]['authors'][$row['author_id']]=$row['author_name'];
}
?>
