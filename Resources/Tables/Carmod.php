<form method="post" action="">
    <table cellspacing="0" cellpadding="0" class="table" width="75%">
        <thead>
            <tr class="head-row">
                <th>Manufacturer</th>
                <th>Model</th>
                <th>Year</th>
                <th>VIN</th>

            </tr>
        </thead>
        <tbody>
            <tr class="car-data-row">
                <td>
                    <?=$c->manufacturer?>
                </td>
                <td>
                    <?=$c->model?>

                </td>
                <td>
                    <?=$c->year?>

                </td>
             <td>
                    <?=$c->VIN?>

                </td>
                </tr>
            <tr class="form-row">
                <td><input type="text" name="manufacturer"></td>
                <td><input type="text" name="model"> </td>
                <td><input type="text" name="year"> </td>
                <td><input type="text" name="VIN"> </td>

            </tr>
            <tr>
                <td colspan="4"><input id="modsub" type="submit" name="submit" value="Submit"></td>
            </tr>
        </tbody>
    </table>
</form>