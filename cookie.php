<?php
echo "Welcome to the world of cookies<br/>";
//cookies | sessions
//syntax to set a cookie
//echo time();
setcookie("category", "Books", time()+ 86400, "/" );
echo "The cookie is set <br/>";


?>