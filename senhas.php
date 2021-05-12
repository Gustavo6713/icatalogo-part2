<?php

echo md5(123456);

echo "<br /><br />";

echo sha1("123456");

echo "<br /><br />";

echo password_hash("123456", PASSWORD_DEFAULT);