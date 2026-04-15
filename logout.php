<?php
session_start();
session_unset();
session_destroy();

// Prevent cached version of the page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

if(ini_get(option:"session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(name:session_name(),value:'',expires_or_options:time()-4200,
    path:$params["path"],domain:$params["domain"],
    secure:$params["secure"],httponly:$params["httponly"]
);
}

header("Location: login.php");
exit;
?>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
        history.go(0);
    };
</script>