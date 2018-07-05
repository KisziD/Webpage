<?php foreach ($message as $m) {?>
<p class="Error">
    <?php echo $m; ?>
</p>
<?php }?>
<form method="post" action="">
    <table cellspacing="0" cellpadding="0" class="table">
        <thead>
            <tr class="head-row">
                <th>Finished</th>
                <th colspan="3">Item</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos as $todo) {?>
            <tr class="todo-data-row">
                <td>

                    <input type="checkbox" name="finished" <?=($todo->finished) ? "checked" : ""?>>
                </td>
                <td>
                    <?=$todo->todoname?>
                </td>
                <td>
                    <?php

    $link = '<a href="Router.php?page=todomodify&id=#id"><i class="fas fa-edit"></i></a>';
    $href = $todo->id;
    $new_href = '#id';

    $new_link = str_replace($new_href, $href, $link);

    echo $new_link;

    ?></td>
                <td>
                    <?php

    $link = '<a href="Router.php?page=tododelete&id=#id"><i class="fas fa-eraser"></i></i></a>';
    $href = $todo->id;
    $new_href = '#id';

    $new_link = str_replace($new_href, $href, $link);

    echo $new_link;

    ?></td>
            </tr>
            <?php }?>
            <tr class="form-row">
                <td><input type="submit" name="submit" value="submit"></td>
                <td colspan="3"><input type="text" name="todo"> </td>

            </tr>
        </tbody>
    </table>
</form>