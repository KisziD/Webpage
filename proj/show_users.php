<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
    li {
    display: ;
}

ul {
    margin-top: 1em;
    margin-bottom: 2em;
    margin-left: 0;
    margin-right: 0;
    padding-left: 50px;
    list-style-image: url('list_image.png');

}
</style>
    <ul>
    <?php foreach ($data->getRows() as $d) { ?>
        <li> <?=$d->get("user_name")?> : <?=$d->get("user_email")?> </li>   
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <input type="text" name="name" size="5">
   :
   <input type="text" name="email"size="5">
  <input type="submit" name="+" value="+" >
</form>
</ul>
</body>
</html>