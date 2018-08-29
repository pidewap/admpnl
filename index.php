<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/file/bootstrap.min.css">
  <link rel="stylesheet" href="/file/signin.css">
    <script src="/file/jquery.min.js"></script>
    <script src="/file/bootstrap.min.js"></script>

</head>
<body>
<?php
error_reporting(0);
session_start();
require_once 'ys.php';

if (isset($_GET['logout']))logout('login-ys-2016');
authorize('login-ys-2016');
echo '
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#">Admin</a>
</div>
<div id="navbar" class="collapse navbar-collapse">
<ul class="nav navbar-nav">
<li><a href="/">Home</a></li>
<li><a href="?config=1">Seting</a></li>
<li><a href="?main=1">Main File</a></li>
<li><a href="?music=1">Search File</a></li>
<li><a href="?download=1">Download File</a></li>
<li><a href="?cat=toplist">Category File</a></li>
<li><a href="?uset=1">User</a></li>
<li><a href="?logout=1">Logout</a></li>
</ul>
</div>
</div>
</nav>
';
//
if (isset($_GET['config'])) {
if (isset($_POST['saveconfig'])) {
include("config/config.php");
echo (update_config($_POST['config'], $config)) ? "
<div class='container'>
<div class='starter-template'><center>Configuration have been saved!, Please <a href='?config=1'>klik here</a> to view</center></div></div>" : "<div class='container'><div class='starter-template'><center>Please check your CHMOD!</center></div>
";
} else {
include("config/config.php");
echo "
<div class='container'>
<div class='starter-template'>
<form method='post'>
<div class='form-group'>
<label class='pwd'>WAP title (ex: BeLagu):</label>
<input type='text' class='form-control' name='config[wap]' value='".$config['wap']."'>
</div>

<div class='form-group'>
<label class='pwd'>ADS Direct Link (download page):</label>
<input type='text' class='form-control' name='config[direct]' value='".$config['direct']."'>
</div>

<div class='form-group'>
<label class='pwd'>Main list file (/):</label>
<input type='text' class='form-control' name='config[main]' value='".$config['main']."'>
</div>

<div class='form-group'>
<label class='pwd'>Search result file (/music):</label>
<input type='text' class='form-control' name='config[music]' value='".$config['music']."'>
</div>

<div class='form-group'>
<label class='pwd'>Single video file (/download):</label>
<input type='text' class='form-control' name='config[download]' value='".$config['download']."'>
</div>

<div class='form-group'>
<label class='pwd'>toplist.html:</label>
<input type='text' class='form-control' name='config[toplist]' value='".$config['toplist']."'>
</div>

<div class='form-group'>
<label class='pwd'>dangdut.html:</label>
<input type='text' class='form-control' name='config[dangdut]' value='".$config['dangdut']."'>
</div>


<div class='form-group'>
<label class='pwd'>kpop.html:</label>
<input type='text' class='form-control' name='config[kpop]' value='".$config['kpop']."'>
</div>

<div class='form-group'>
<label class='pwd'>jpop.html:</label>
<input type='text' class='form-control' name='config[jpop]' value='".$config['jpop']."'>
</div>

<div class='form-group'>
<label class='pwd'>cpop.html:</label>
<input type='text' class='form-control' name='config[cpop]' value='".$config['cpop']."'>
</div>

<div class='form-group'>
<label class='pwd'>india.html:</label>
<input type='text' class='form-control' name='config[india]' value='".$config['india']."'>
</div>

<div class='form-group'>
<label class='pwd'>anime.html:</label>
<input type='text' class='form-control' name='config[anime]' value='".$config['anime']."'>
</div>

<div class='form-group'>
<label class='pwd'>indo.html:</label>
<input type='text' class='form-control' name='config[indo]' value='".$config['indo']."'>
</div>

<div class='form-group'>
<label class='pwd'>malay.html:</label>
<input type='text' class='form-control' name='config[malay]' value='".$config['malay']."'>
</div>
<button type='submit' name='saveconfig' class='btn btn-default'>Save</button>
</form>
</div>
</div>
";
}
}
if (isset($_GET['main'])) {
  include("config/config.php");
echo '<div class="container">
<div class="starter-template"><center><h1>MAIN FILE</h1></center>
<div class="form-group">
<form class="pure-form pure-form-stacked" action="'.$config['main'].'" method="post">';
  include 'api/main.php';
  echo '</div><button class="btn btn-default" type="submit">Save file</button>
            </form></div>
</div>';
                
}
  if (isset($_GET['music'])) {
  include("config/config.php");
echo '<div class="container">
<div class="starter-template"><center><h1>MUSIC FILE</h1></center>
<div class="form-group">
<form class="pure-form pure-form-stacked" action="'.$config['music'].'" method="post">';
  include 'api/music.php';
  echo '</div><button class="btn btn-default" type="submit">Save file</button>
            </form></div>
</div>';
                
}
  if (isset($_GET['download'])) {
  include("config/config.php");
echo '<div class="container">
<div class="starter-template"><center><h1>DOWNLOAD FILE</h1></center>
<div class="form-group">
<form class="pure-form pure-form-stacked" action="'.$config['download'].'" method="post">';
  include 'api/download.php';
  echo '</div><button class="btn btn-default" type="submit">Save file</button>
            </form></div>
</div>';
                
}
  if (isset($_GET['cat'])) {
  include("config/config.php");
    if($_GET['cat'] == 'toplist'){
      $urlpost = $config['toplist'];
    }
    if($_GET['cat'] == 'dangdut'){
      $urlpost = $config['dangdut'];
    }
    if($_GET['cat'] == 'kpop'){
      $urlpost = $config['kpop'];
    }
    if($_GET['cat'] == 'jpop'){
      $urlpost = $config['jpop'];
    }
    if($_GET['cat'] == 'cpop'){
      $urlpost = $config['cpop'];
    }
    if($_GET['cat'] == 'india'){
      $urlpost = $config['india'];
    }
    if($_GET['cat'] == 'anime'){
      $urlpost = $config['anime'];
    }
    if($_GET['cat'] == 'indo'){
      $urlpost = $config['indo'];
    }
    if($_GET['cat'] == 'malay'){
      $urlpost = $config['malay'];
    }
echo '<div class="container">
<div class="starter-template"><center><h1>CATEGORY FILE</h1><br><a href="?cat=toplist">toplist</a> | <a href="?cat=kpop">kpop</a> | <a href="?cat=jpop">jpop</a> | <a href="?cat=cpop">cpop</a> | <a href="?cat=dangdut">dangdut</a> | <a href="?cat=anime">anime</a> | <a href="?cat=india">india</a> | <a href="?cat=indo">indo</a> | <a href="?cat=malay">malay</a></center>
<div class="form-group">
<form class="pure-form pure-form-stacked" action="'.$urlpost.'" method="post">';
  include 'api/cat.php';
  echo '</div><button class="btn btn-default" type="submit">Save file</button>
            </form></div>
</div>';
                
}
//////////////////////////////
elseif (isset($_GET['uset'])) {
if (isset($_POST['saveconfig'])) {
include("config/admin.php");
echo (update_config($_POST['admin'], $admin)) ? "
<div class='container'>
<div class='starter-template'><center>Configuration have been saved!, Please <a href='?uset=1'>klik here</a> to view</center></div></div>" : "<div class='container'>
<div class='starter-template'><center>Please check your CHMOD!</center></div>
"; } else {
include("config/admin.php");
echo "
<div class='container'>
<div class='starter-template'>
<form method='post'>

<div class='form-group'>
<label class='pwd'>Username:</label>
<input type='text' class='form-control' name='admin[user]' value='".$admin['user']."'>
</div>

<div class='form-group'>
<label class='pwd'>Password:</label>
<input type='text' class='form-control' name='admin[password]' value='".$admin['password']."'>
</div>

<div class='form-group'>
<label class='pwd'>Site: [".$admin['site']."]</label>
<select class='form-control' name='admin[site]'>
  <option value='ON'>ON</option>
  <option value='OFF'>OFF</option>
</select>
</div>
<button type='submit' name='saveconfig'class='btn btn-default'>Save</button>
</form>
</div>
</div>
";
}
}
///////////////////////////////
else {
include 'include/readme';
}
///////////////////////////////


