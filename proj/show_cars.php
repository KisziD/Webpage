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
        <li> <?=$d->get("licence_plate")?> <?=$d->get("manufacturer")?> <?=$d->get("model")?> <?=$d->get("year")?>  <?=$d->get("VIN")?> </li>   
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <input type="text" name="manufacturer" size="5">
  <input type="text" name="model" size="5">
  <input type="text" name="year" size="5">
   <input type="text" name="VIN"size="5">
  <input type="submit" name="+" value="submit" >
</form>
</ul>
</body>
</html>