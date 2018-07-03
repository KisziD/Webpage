<?php session_start();?>


<div id="tartalom">
</div>

<script>
var url  = "/Router.php?page=get_todo";
var xhr  = new XMLHttpRequest()
xhr.open('GET', url, true)
xhr.onload = function () {
	var users = JSON.parse(xhr.responseText)
	var content = `<table class="table" width="75%">`

    users.forEach(function(element) {
        content += `<tr><td>${element}</td></tr>`
    });

    content += `</table>`

    document.querySelector("#tartalom").innerHTML = content;
}
xhr.send(null);
</script>