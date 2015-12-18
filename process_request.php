<?php
    include ( 'helpers.php' );
    include ( 'p2.php' );

   check_post_only ();
    
   /*if ( get_db_handle() ) {
       echo "connected to sql database <br/>";
   } */   
   store_data_in_db();
   include ( 'confirmation.php' );
   

?>
