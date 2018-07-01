<?php 
/* ============= WebBuilderConf.php =========== */
require('WebBuilderDBConf.php');
// Configuration of the WebBuilder
$WebBuilderConf = array(
  // General
  'SiteName' => 'LightReader',
  'DebugMode' => true,  // true or false
  'RefreshDico' => false,  // true or false
  'DeveloperEmail' => '',
  'DefaultLang' => 'en',
  'DefaultMode' => '0',
  'AvailableModes' => array('0'),
  'TimeZone' => 'Asia/Tokyo',
  'AccessStat' => false, // If true, creates the access table in DB when 
                        // setupDB and log access automatically
  'UserLogin' => true, // If true, creates the user login table in DB
                       // when setupDB
  // Header
  'BaseURL' => 'http://your.website.net/LightReader/',
  'MetaDescription' => 'Main page of LightReader',
  'MetaKeywords' => 'WebBuilder, PHP, MySQL, JavaScript, framework',
  'MetaViewportWidth' => 'device-width',
  'IncludeCSS' => array('index.css', 'Animate/animate.css'),
  'IncludeJS' => array('index.js'),
  // Database connection informations
  'DB_servername' => $DB_servername,
  'DB_username' => $DB_username,
  'DB_password' => $DB_password,
  'DB_dbname' => $DB_dbname,
  // BigBrother function
  'DBBigBrother' => false, // true or false
  // Database model
  'DBModel' => array( 'tables' => array(
    'LightReaderToRead' => array(
      'Reference' => 'INT UNSIGNED AUTO_INCREMENT PRIMARY KEY',
      'Url' => 'TEXT character set utf8 collate utf8_bin'
      ),
    'LightReaderFilter' => array(
      'Reference' => 'INT UNSIGNED AUTO_INCREMENT PRIMARY KEY',
      'Filter' => 'TEXT character set utf8 collate utf8_bin',
      'DivTgt' => 'TEXT character set utf8 collate utf8_bin',
      'UrlSrc' => 'TEXT character set utf8 collate utf8_bin'
      )
    )),
  // Login table for user login
  'DBModelLogin' => array( 'tables' => array(
    'WBLogin' => array(
      'Reference' => 'INT UNSIGNED AUTO_INCREMENT PRIMARY KEY',
      'Login' => 'TEXT character set utf8 collate utf8_bin',
      'Hash' => 'TEXT character set utf8 collate utf8_bin'
      )
    )
  ),
  // Statistic table for access logger
  'DBModelStat' => array( 'tables' => array(
    'WBAccessTracker' => array(
      'Reference' => 'INT UNSIGNED AUTO_INCREMENT PRIMARY KEY',
      'DateTime' => 'DATETIME NOT NULL',
      'RefererIP' => 'TEXT character set utf8 collate utf8_bin',
      'HTTP_REFERER' => 
        'TEXT character set utf8 collate utf8_bin',
      'HTTP_USER_AGENT' => 
        'TEXT character set utf8 collate utf8_bin',
      'REQUEST_URI' => 
        'TEXT character set utf8 collate utf8_bin',
      'City' => 'TEXT character set utf8 collate utf8_bin',
      'Region' => 'TEXT character set utf8 collate utf8_bin',
      'Country' => 'TEXT character set utf8 collate utf8_bin',
      'LongLat' => 'TEXT character set utf8 collate utf8_bin',
      'Robot' => 'BOOL NOT NULL DEFAULT false'
      )
    )
  ),
  // Models for DB editor
  'DBEditor' => array(
  'LightReaderFilter' => array (
      'Reference' => 'Reference',
      'Filter' => 'Text',
      'DivTgt' => 'Text',
      'UrlSrc' => 'Text'
    ))
);
  
?>
