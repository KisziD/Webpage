<?php foreach($message as $m){?>
<p class="Error">
    <?php echo $m;?>
</p>
<?php }?>
<form method="post" action="">
    <table cellspacing="0" cellpadding="0" class="table">
        <thead>
            <tr class="head-row">
                <th>Licence Plate</th>
                <th>Manufacturer</th>
                <th>Model</th>
                <th>Year</th>
                <th>VIN</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car) { ?>
            <tr class="data-row">
                <td>
                    <?= $car->licence_plate ?>
                </td>
                <td>
                    <?= $car->manufacturer  ?>
                </td>
                <td>
                    <?= $car->model  ?>
                </td>
                <td>
                    <?= $car->year  ?>
                </td>
                <td>
                    <?= $car->VIN  ?>
                </td>
            </tr>
            <?php } ?>
            <tr class="form-row">
                <td><input type="submit" name="submit" value="submit"></td>
                <td><input type="text" name="manufacturer"> </td>
                <td><input type="text" name="model"> </td>
                <td><input type="text" name="year"> </td>
                <td><input type="text" name="VIN" size="35"> </td>
            </tr>
        </tbody>
    </table>
</form>