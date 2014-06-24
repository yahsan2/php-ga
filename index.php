<?php
include('src/autoload.php');

$filname = isset($_GET['filname'])? '../'.$_GET['filname'] : 'blank.gif';
$title = isset($_GET['title'])? $_GET['title'] : 'Open Email';
$url = isset($_GET['url'])? $_GET['url'] : '/?utm_medium=open_email';

use UnitedPrototype\GoogleAnalytics;

// Initilize GA Tracker
$tracker = new GoogleAnalytics\Tracker('UA-xxxxxxx-x', 'example.com');

// Assemble Visitor information
// (could also get unserialized from database)
$visitor = new GoogleAnalytics\Visitor();
$visitor->setIpAddress($_SERVER['REMOTE_ADDR']);
$visitor->setUserAgent($_SERVER['HTTP_USER_AGENT']);
$visitor->setScreenResolution('1024x768');

// Assemble Session information
// (could also get unserialized from PHP session)
$session = new GoogleAnalytics\Session();

// Assemble Page information
$page = new GoogleAnalytics\Page($url);
$page->setTitle($title);

// Track page view
$tracker->trackPageview($page, $session, $visitor);

$fp = fopen($filname, "r");
$imgdat = fread($fp, filesize($filname));
fclose($fp);
header('Content-type: image/jpeg');
echo $imgdat;
 ?>