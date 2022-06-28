<?php
function scan_dir($dir) {
    $ignored = array('.', '..');
    $files = array();    
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false;
}

$files = scan_dir('/var/log/ansible');
# Too many logfiles = bad
$files = array_slice($files,0, 40);

$links = "";
foreach ($files as $log) {
  $time=date ("Y-m-d H:i", filemtime("/var/log/ansible/".$log));
  $log=str_replace(".log", "", $log);
  $links.="<a href='?ip=".$log."'>".$log."</a> (".$time.")<br>";
}


   if(filter_var($_GET["ip"], FILTER_VALIDATE_IP) !== false)
   {
     $logoutput="<pre><code class=\"language-ini\">".shell_exec("cat /var/log/ansible/".$_GET["ip"].".log")."</code></pre>";
   } else {
     $_GET["ip"] = "unknown host:";
     $logoutput="Please select a log file";
   }

?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Viewer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/styles/default.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
  <style>
    body {
      padding: 10px;
      font-family: Monospace;
    }
    details {
        border: 1px solid #aaa;
        border-radius: 4px;
	padding: .5em .5em 0;
        max-height: 30%;
    }
    
    summary {
        font-weight: bold;
        margin: -.5em -.5em 0;
        padding: .5em;
	max-height: 30%;
        display: block;
    }
    details:not([open]) summary::before {
	content: "›";
    } 
    details[open] {
        padding: .5em;
    }
    
    details[open] summary {
        border-bottom: 1px solid #aaa;
        margin-bottom: .5em;
    }

  </style>
  </head>
  <body>
   <details>
   <summary>	
   Available logs:
   </summary>
   <?=$links?>
   </details>
   <hr>
   <h2>Logs for <?=$_GET["ip"]?></h2>
   <hr>
   <?=$logoutput?>
   <br/>	
   <b onclick="window.location.reload(true)" style="color: blue;"><u>Reload</u></b>
   <script>hljs.highlightAll();</script>
   <hr>
   (c) 2022 Gian Klug
  </body>
</html>

