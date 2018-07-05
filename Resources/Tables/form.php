<?php foreach ($message as $m) {?>
<p class="Error">
    <?php echo $m; ?>
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
                <th colspan="3">VIN</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car) {?>
            <tr class="data-row">
                <td id="licence">
                    <?=$car->licence_plate?>
                </td>
                <td>
                    <?=$car->manufacturer?>
                </td>
                <td>
                    <?=$car->model?>
                </td>
                <td id="year">
                    <?=$car->year?>
                </td>
                <td id="VIN" colspan>
                    <?=$car->VIN?>

                </td>
                <td>
                    <?php

    $link = '<a href="Router.php?page=carmodify&id=#id"><i class="fas fa-edit"></i></a>';
    $href = $car->licence_plate;
    $new_href = '#id';

    $new_link = str_replace($new_href, $href, $link);

    echo $new_link;

    ?></td>
                <td>
                    <?php

    $link = '<a href="Router.php?page=cardelete&id=#id"><i class="far fa-trash-alt"></i></a>';
    $href = $car->licence_plate;
    $new_href = '#id';

    $new_link = str_replace($new_href, $href, $link);

    echo $new_link;

    ?></td>
            </tr>
            <?php }?>
            <tr class="form-row">
                <td><input type="submit" name="submit" value="submit"></td>
                <td><input type="text" name="manufacturer"> </td>
                <td><input type="text" name="model"> </td>
                <td><input type="text" name="year"> </td>
                <td colspan="3"><input type="text" name="VIN" size="35"> </td>
            </tr>
        </tbody>
    </table>
</form>