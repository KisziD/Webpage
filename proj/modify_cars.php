
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cars</title>
<style>
td{
    text-align: center;
}
table {
    border-spacing: 5px;
}
</style>
</head>
<body>
<table>
<tr>
 <td><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <input type="submit" name="modify" value="submit" ></td>
 <td><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <input type="text" name="modmanufacturer"> </td>
 <td><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <input type="text" name="modmodel"> </td>
 <td><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <input type="text" name="modyear"> </td>
 <td><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <input type="text" name="modVIN"> </td>
</tr>
</table>
</body>
</html>