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

// Detalii despre server
$cfg['host'] = '';  // ip ts3
$cfg['query'] = 10011;  // portul de query
$cfg['voice'] = 9988; // portul ts3 server
$cfg['serverinstance'] = 3; // ID server
$channelradacina = array('499','542','497');  // canalele parinte unde sunt atasate sub-channel-urile

// Detalii despre query
$cfg["user"] = ''; // user query
$cfg["pass"] = ''; // pass query

// Detalii referitoare BD
$mysql['host'] = 'localhost'; 
$mysql['user'] = 'root';
$mysql['pass'] = '';
$mysql['db'] = '';

// Setari stergerea canalelor
$zile = '5'; // nr de zile pentru inactivitate
$maxInactivity = ($zile * 24 * 60 * 60); 
$minChecks = 1; // A NU SE SCHIMBA ! EVENTUAL e-mail contact@evorule.com