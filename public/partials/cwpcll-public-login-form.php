<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$pass = get_option("cwpcll_user_pass");

function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if(isset($_POST['user_email']) && isset($_POST['user_pass'])
    && isset($_POST['cwpcll_login_check']) && $_POST['cwpcll_login_check']=='true'
    && !empty($_POST['user_email']) && !empty($_POST['user_pass']) && $_POST['user_pass']==$pass)
{
    $_SESSION['cwpcll_logged'] = true;
    global $wpdb;
    $table_name = $wpdb->prefix . "cwpcll_logs";
    $e = $_POST['user_email'];
    $i = get_client_ip_env();
    $c = date('Y-m-d H:i:s');
    $sql = "INSERT INTO $table_name (email,ip,created)VALUES ('$e','$i','$c')";
    $wpdb->get_results($sql);
}
if(!isset($_SESSION['cwpcll_logged']) || $_SESSION['cwpcll_logged']!=true)
{
    $selector = get_option("cwpcll_blur_selector");
?>
<div class="cwpcll-login-form">
    <form method="post" action="">
        <input class="cwpcll-email" type="email" name="user_email" placeholder="Your email" required>
        <input class="cwpcll-pass" type="password" name="user_pass" placeholder="Your password" required>
        <input type="hidden" name="cwpcll_login_check" value="true">
        <button class="cwpcll-submit" type="submit">Login</button>
    </form>
</div>

<script type="application/javascript">
    $=jQuery;
    var s = "<?=$selector?>";
    $(document).ready(function(){
        $(s).css({"position":"relative"});
        $html = "<div style='position:absolute;top:0;left:0;width:100%;height:100%;background: #ffffffb3;z-index:999'></div>";
        $(s).append($html);
    })
</script>

<?php }?>