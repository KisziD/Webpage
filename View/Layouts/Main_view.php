<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <?php
    include $_SERVER['DOCUMENT_ROOT']."/View/Elements/links.html";?>
</head>

<body>
   
    <div class="container">
        <!--- Navigation  -->
         <?php include $_SERVER['DOCUMENT_ROOT']."/View/Elements/navbar.html";
            //include($requested_page);
            include $page;
        ?>

    </div>
</body>

</html>