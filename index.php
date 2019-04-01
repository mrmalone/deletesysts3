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

error_reporting(E_ALL | E_STRICT); 
date_default_timezone_set("Europe/Bucharest"); // Daca te muti din Romania schimba si fusul :D

// Load required files
require_once("config.php");

// Load framework library
require_once("TeamSpeak3/TeamSpeak3.php");

// Initialize
TeamSpeak3::init();

// Load the actual code
include_once("check.php");