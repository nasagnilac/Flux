<?php if (!defined('FLUX_ROOT')) exit; 
$title = Flux::message('ServerStatusTitle');
$cache = FLUX_DATA_DIR.'/tmp/ServerStatus1.cache';

if (file_exists($cache) && (time() - filemtime($cache)) < (Flux::config('ServerStatusCache') * 60)) {
    $serverStatus1 = unserialize(file_get_contents($cache));
}
else {
    $serverStatus1 = array();
    foreach (Flux::$loginAthenaGroupRegistry as $groupName => $loginAthenaGroup) {
        if (!array_key_exists($groupName, $serverStatus1)) {
            $serverStatus1[$groupName] = array();
        }

        $loginServerUp = $loginAthenaGroup->loginServer->isUp();

        foreach ($loginAthenaGroup->athenaServers as $athenaServer) {
            $serverName = $athenaServer->serverName;
            //print_r($loginAthenaGroup->connection); echo "<br/><br/>";

            $sql = "SELECT COUNT(char_id) AS players_online FROM {$athenaServer->charMapDatabase}.char WHERE online > 0";
            $sth = $loginAthenaGroup->connection->getStatement($sql);
            $sth->execute();
            $res = $sth->fetch();
            
            $sqlpeak = "SELECT value FROM mapreg WHERE varname = '$\peakonline' LIMIT 0 , 1";
            $sthpeak = $loginAthenaGroup->connection->getStatement($sqlpeak);
            $sthpeak->execute();
            $peakresult = $sthpeak->fetch();
            
            $sqlwoestatus = "SELECT value FROM mapreg WHERE varname = '$\woeStatus' LIMIT 0 , 1";
            $sthwoestatus = $loginAthenaGroup->connection->getStatement($sqlwoestatus);
            $sthwoestatus->execute();
            $woestatusresult = $sthwoestatus->fetch();

            $serverStatus1[$groupName][$serverName] = array(
                'loginServerUp' => $loginServerUp,
                'charServerUp' => $athenaServer->charServer->isUp(),
                'mapServerUp' => $athenaServer->mapServer->isUp(),
                'playersOnline' => intval($res ? $res->players_online : 0),
                'peakPlayersOnline' => intval($peakresult ? $peakresult->value : 0),
                'woeStatus' => intval($woestatusresult ? $woestatusresult->value : 0)
            );
        }
    }
    
    $fp = fopen($cache, 'w');
    if (is_resource($fp)) {
        fwrite($fp, serialize($serverStatus1));
        fclose($fp);
    }
}

?> 

<?php 
    $online = 'Server Online';
    $offline = 'Server Offline';
    $woeon = '<div class="green">On</div>';
    $woeoff = '<div class="red">Off</div>';
    $i = 0;
    foreach ($serverStatus1 as $privServerName => $gameServers):
        foreach ($gameServers as $serverName => $gameServer):
        if ($gameServer['loginServerUp']) { $loginserver[$i] = 1; } else { $loginserver[$i] = 0; } 
        if ($gameServer['charServerUp']) { $charserver[$i] = 1; } else { $charserver[$i] = 0; } 
        if ($gameServer['mapServerUp']) { $mapserver[$i] = 1; } else { $mapserver[$i] = 0; } 
        $online_player[$i] = $gameServer['playersOnline'];
        $peak_online_player[$i] = $gameServer['peakPlayersOnline'];
        $woe_status[$i] = $gameServer['woeStatus']; 
        endforeach; 
    $i++;
    endforeach; 
?>
<div class="onlinestatus">
    <div class="server-1">
        <div class="players"><?php echo $online_player[0]; ?></div>
        <div class="login"><?php if ( $mapserver[0] ) { echo $online; } else { echo $offline; } ?></div>
        <div class="woeStatus"><?php if ( $woe_status[0] ) { echo $woeon; } else { echo $woeoff; } ?></div>
    </div>
    <div class="server-1">
        <div class="players"><?php echo $online_player[1]; ?></div>
        <div class="login"><?php if ( $mapserver[1] ) { echo $online; } else { echo $offline; } ?></div>
        <div class="woeStatus"><?php if ( $woe_status[1] ) { echo $woeon;  } else { echo $woeoff; } ?></div>
    </div>
</div>

    
