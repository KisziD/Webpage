<form method="post" action="">
    <table cellspacing="0" cellpadding="0" class="table" width="75%">
        <thead>
            <tr class="head-row">
                <th>Finished</th>
                <th>Item</th>

            </tr>
        </thead>
        <tbody>
            <tr class="todo-data-row">
                <td>

                </td>
                <td>
                    <?=$todo->todoname?>

                </td>

            </tr>
            <tr class="form-row">
                <td><input type="checkbox" name="finished" <?=($todo->finished) ? "checked" : ""?>></td>

                <td><input type="text" name="todoname"> </td>

            </tr>
            <tr>
                <td colspan="2"><input id="modsub" type="submit" name="submit" value="Submit"></td>
            </tr>
        </tbody>
    </table>
</form>