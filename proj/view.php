<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <title>Cars</title>
    <?php
    include "links.html";?>
</head>

<body>
   
    <div class="container">
        <!--- Navigation  -->
         <?php include "navbar.html";
            include($requested_page);
        ?>

    </div>
</body>

</html>