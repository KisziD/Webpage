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
            <tr class="form-row">
                <td><input type="text" name="manufacturer" value="<?=$c->manufacturer?>"></td>
                <td><input type="text" name="model" value="<?=$c->model?>"> </td>
                <td><input type="text" name="year" value="<?=$c->year?>"> </td>
                <td><input type="text" name="VIN" value="<?=$c->VIN?>"> </td>

            </tr>
            <tr>
                <td colspan="4"><input id="modsub" type="submit" name="submit" value="Submit"></td>
            </tr>
        </tbody>
    </table>
</form>