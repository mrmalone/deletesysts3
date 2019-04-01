<?php

/**
 * 
 *  Author: Mr.Malone (contact@evorule.com)
 *  Date:  2019
 * 
 *  Summary of File:
 *  
 *      Sets the configuration values
 * 
 */


$ts3_ServerInstance = TeamSpeak3::factory('serverquery://' . $cfg['user'] . ':' . $cfg['pass'] . '@' . $cfg['host'] . ':' . $cfg['query'] . '/');
$ts3_VirtualServer = $ts3_ServerInstance->serverGetById($cfg['serverinstance']);

// Connect to the database
$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

foreach($ts3_VirtualServer->channelList() as $channel) {
    if($channel['pid'] == $channelradacina) {        
        
        $channelId = $channel->getId();
        $channelName = $channel['channel_name'];
        
        $stmt = $mysqli->prepare('INSERT IGNORE INTO channels (cid, emptySince, lastChecked, numEmptyChecks, channelName) values(?, now(), now(), 0, ?)');
        $stmt->bind_param('is', $channelId, $channelName);
        $stmt->execute();
        $stmt->close();        
        if($channel['total_clients']) {            
            $stmt = $mysqli->prepare('UPDATE channels SET emptySince=now(), lastChecked=now(), numEmptyChecks=0, channelName=? WHERE cid=?');
            $stmt->bind_param('si', $channelName, $channelId);            
            $stmt->execute();
            $stmt->close();            
        } else {            
            $stmt = $mysqli->prepare('SELECT UNIX_TIMESTAMP(now())-UNIX_TIMESTAMP(emptySince), numEmptyChecks FROM channels WHERE cid = ?');
            $stmt->bind_param('i', $channelId);
            $stmt->execute();            
            $stmt->bind_result($emptySince, $checks);            
            $stmt->fetch();
            $stmt->close();            
            if($emptySince > $maxInactivity && count($channel->subChannelList()) == 0 && $checks > $minChecks) {                
                $ts3_VirtualServer->channelDelete($channelId);                
                $stmt = $mysqli->prepare('DELETE FROM channels WHERE cid = ?');
                $stmt->bind_param('i', $channelId);
                $stmt->execute();
                $stmt->close();                
            } else {
                $stmt = $mysqli->prepare('UPDATE channels SET lastChecked=now(), numEmptyChecks=numEmptyChecks+1, channelName=? WHERE cid=?');
                $stmt->bind_param('si', $channelName, $channelId);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
}

$mysqli->close();
?>