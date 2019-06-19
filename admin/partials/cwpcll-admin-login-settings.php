<?php
$s = get_option("cwpcll_blur_selector");
$p = get_option("cwpcll_user_pass");
?>

<style>
    .cwpcll{
        padding-right:20px;
    }
    .cwpcll button, .cwpcll input{
        padding: 5px 15px;
        margin-bottom:1em;
        margin-right: 1em;
    }
</style>
<h2>Settings</h2>
<hr>
<div class="cwpcll">
    <p>Use the following shortcode into your page or post</p>
    <p><strong>[cwpcll-login]</strong></p>
    </br>
    <h4>Configure Blur</h4>
    <hr>

    <form method="post">
        <p>Enter CSS ID/Class/Tag</p>
        <input style="width:300px;" type="text" name="selector" placeholder="Enter a id or class" value="<?=$s?>"></br>
        <p>Enter Login Password</p>
        <input style="width:300px;" type="text" name="cwpcll_user_pass" placeholder="Enter a password" value="<?=$p?>"></br>
        <input type="hidden" value="true" name="selector_check">
        <button type="submit" class="clear-logs">Save</button>
    </form>

    </br>
    <h4>For logs clear</h4>
    <hr>
    <form method="post">
        <input type="hidden" value="true" name="clear_check">
        <button class="clear-logs">Clear Logs</button>
    </form>
</div>
