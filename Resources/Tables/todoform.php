<?php foreach ($message as $m) {?>
<p class="Error">
    <?php echo $m; ?>
</p>
<?php }?>

<script>

    function modify(id,finished) {
        var url  = "/Router.php?page=modify_todo&id="+id+ "&finished="+(finished ? 1 : 0) ;
        var xhr  = new XMLHttpRequest()
        xhr.open('GET', url, true)
        xhr.onload = function () {
            /*
            var users = JSON.parse(xhr.responseText)
            var content = `<table class="table" width="75%">`

            users.forEach(function(element) {
                content += `<tr><td>${element}</td></tr>`
            });

            content += `</table>`

            document.querySelector("#tartalom").innerHTML = content;
            */
        }
        xhr.send(null);
    }
</script>

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

                    <input type="checkbox" onclick="modify(<?=$todo->id?>, this.checked);" name="finished" <?=($todo->finished) ? "checked" : ""?>>
                </td>
                <td>
                    <?=$todo->todoname?>
                </td>
                <td>
                    <a href="Router.php?page=todomodify&id=<?=$todo->id?>"><i class="fas fa-edit"></i></a>
                </td>
                <td>
                    <a href="Router.php?page=tododelete&id=<?=$todo->id?>"><i class="fas fa-eraser"></i></i></a>
                </td>
            </tr>
            <?php }?>
            <tr class="form-row">
                <td><input type="submit" name="submit" value="submit"></td>
                <td colspan="3"><input type="text" name="todo"> </td>

            </tr>
        </tbody>
    </table>
</form>