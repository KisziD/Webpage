<?php foreach($message as $m){?>
<p class="Error">
    <?php echo $m;?>
</p>
<?php }?>
<form method="post" action="">
    <table cellspacing="0" cellpadding="0" class="table">
        <thead>
            <tr class="head-row">
                <th>Finished</th>
                <th>Item</th>
          
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todos as $todo) { ?>
            <tr class="todo-data-row">
                <td>
                    
                    <input type="checkbox" name="finished" <?= ($todo->finished) ? "checked" : "" ?>>
                </td>
                <td>
                    <?= $todo->todoname  ?>     <i class="fas fa-edit"></i>
                </td>
                
            </tr>
            <?php } ?>
            <tr class="form-row">
                <td><input type="submit" name="submit" value="submit"></td>
                <td><input type="text" name="todo"> </td>
           
            </tr>
        </tbody>
    </table>
</form>