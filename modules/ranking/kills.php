<?php if (!defined('FLUX_ROOT')) exit;$title    = 'Kills Ranking';$sqlpvp = "SELECT `pvpladder`.`kills`, `pvpladder`.`streaks`, `pvpladder`.`deaths`, `char`.`name`, `char`.`class`, `char`.`base_level`, `char`.`job_level`, `char`.`account_id`, `char`.`online`, `login`.`sex` FROM `pvpladder` LEFT JOIN `char` ON `char`.`char_id` = `pvpladder`.`char_id` LEFT JOIN `login` ON `login`.`account_id` = `char`.`account_id` WHERE `login`.`state` = '0' ORDER BY `pvpladder`.`kills` DESC, `pvpladder`.`streaks` DESC, `pvpladder`.`deaths` DESC, `char`.`base_exp` DESC LIMIT 0,20"; $sthpvp = $server->connection->getStatement($sqlpvp);$sthpvp->execute();$pvpladder = $sthpvp->fetchAll();?>