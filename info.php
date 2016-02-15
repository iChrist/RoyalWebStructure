<?php
ini_set('upload_max_filesize','2');
ini_set('post_max_size','5');
echo "upload_max_filesize : ".ini_get('upload_max_filesize'), " , post_max_size: " , ini_get('post_max_size')."<br><br><hr>";
phpinfo();