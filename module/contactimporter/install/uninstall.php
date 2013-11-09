<?php
Phpfox::getLib('phpfox.database')->query("UPDATE " . Phpfox::getT('menu') . " SET is_active = 0 WHERE menu_id = 64;");
?>