

<?php
$licentiecode = "mylicense";
$txtbestand   = file_get_contents("");
if ($licentiecode == $txtbestand) {
} else {
   
   
}
if (!isset($_SERVER["HTTP_REFERER"])) {
    die();
}
ob_start();
require_once "complex/configuration.php";
require_once "complex/init.php";
if (!($user->LoggedIn()) || !($user->notBanned($odb))) {
    die();
}
function hiddenString($str, $start = 1, $end = 1)
{
    $aquvgiwuit    = "len";
    $lswpeoo       = "len";
    ${$aquvgiwuit} = strlen($str);
    return substr($str, 0, $start) . str_repeat("*", $len - ($start + $end)) . substr($str, ${$lswpeoo} - $end, $end);
}
date_default_timezone_set("Europe/London");
$checkOnlines = $odb->query("SELECT * FROM `login_history` WHERE `status` = 'success' ORDER BY `id` DESC LIMIT 10;");
while ($ripx = $checkOnlines->fetch(PDO::FETCH_BOTH)) {
    $userInfoData = $odb->query("SELECT * FROM `users` WHERE `username` = '" . $ripx["username"] . "'");
    $lrsmpcghx    = "planInfoData";
    $userInfo     = $userInfoData->fetch(PDO::FETCH_BOTH);
    $diffOnline   = time() - $userInfo["activity"];
    $countOnline  = $odb->prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username  AND {$diffOnline} < 60");
    $countOnline->execute(array(
        ":username" => $ripx["username"]
    ));
    $onlineCount = $countOnline->fetchColumn(0);
    $djmfxrrkjyw = "tonutukdce";
    $wnvafklx    = "rank";
    if ($onlineCount == "1") {
        $status = "<td><span class=\"badge badge-pill badge-success ml-auto\" style=\"color: #fff;box-shadow: 1px 1px 15px #03c10d ;background-color:#03c10d;\">Online</span></td>";
    } else {
       $status = "<td><span class=\"badge badge-pill badge-danger ml-auto\" style=\"color: #fff;box-shadow: 1px 1px 15px #f5365c ;background-color:#f5365c;\">Offline</span></td>";
    }
    $userInfoDatao  = $odb->query("SELECT * FROM `users` WHERE `username` = '" . $userInfo["username"] . "'");
    $userInfoo      = $userInfoDatao->fetch(PDO::FETCH_BOTH);
    $avhhlwovqnqh   = "ip2";
    ${$djmfxrrkjyw} = "custom";
    $pexpire        = $userInfoo["expire"];
    ${$lrsmpcghx}   = $odb->query("SELECT * FROM `plans` WHERE `id` = '" . $userInfo["membership"] . "'");
    $planInfo       = $planInfoData->fetch(PDO::FETCH_BOTH);
    
	if ($userInfo["rank"] == 69) {
        $rank = "<bb class=\"text-danger\"><strong> 😼 Admin</strong></bb>";
        $fotox = "<img src=\"admin.png\" alt=\"user-img\" class=\"img-circle\" width=\"40\" height=\"40\"/>";
    } elseif ($userInfo["rank"] == 15) {
        $rank  = "<bb style=\"color: #aa65cc!important;\"><strong>💎Support</strong></bb>";
        $fotox = "<img src=\"admin.png\" alt=\"user-img\" class=\"img-circle\" width=\"40\" height=\"40\"/>";
    } elseif ($planInfo["vip"] == "1") {
        $gxxbmeop        = "rank";
        $scrnlursi       = "gxxbmeop";
        ${${$scrnlursi}} = "<bb style=\"color:#0284db;\"><strong>💀 VIP User</strong></bb>";
        $fotox           = "<img src=\"avatar-user.png\" alt=\"user-img\"\x20\x63\x6c\x61\x73\x73\x3d\x22\x69\x6d\x67-c\x69\x72\x63\x6c\x65\x22\x20\x77\x69\x64t\x68\x3d\"40\"\x20\x68\x65\x69\x67\x68\x74\x3d\x22\x34\x30\x22/>";
    } elseif ($userInfo["expire"] > time()) {
        $rank  = "<bb class=\"text-success\">&#9889; Paid User</bb>";
        $fotox = "<img src=\"usernormal.png\" alt=\"\x75\x73\x65\x72-i\x6d\x67\x22\x20\x63\x6c\x61\x73\x73\x3d\x22\x69\x6d\x67-\x63\x69\x72\x63\x6c\x65\x22\x20\x77\x69\x64\x74\x68\x3d\x22\x34\x30\" height=\"40\"/>";
    } else {
        $rank  = "<bb style=\"text-primary;\">&#9785; Free User</bb>";
        $fotox = "<img src=\"\x66\x72\x65\x65\x2e\x70n\x67\x22\x20\x61\x6c\x74\x3d\x22\x75\x73\x65\x72-\x69\x6d\x67\x22\x20\x63l\x61\x73\x73\x3d\x22\x69\x6d\x67-\x63\x69\x72\x63\x6c\x65\x22\x20\x77\x69\x64\x74\x68=\"40\" height=\"\x34\x30\x22/\x3e";
    }
	
	
    $custom          = explode(".", $ripx["ip"]);
    $ip1             = $custom[0];
    ${$avhhlwovqnqh} = ${$tonutukdce}[1];
    $ip3             = $custom[2];
    $ip4             = $custom[3];
    $realIP          = "&#215;Encrypted&#215;";
    if ($userInfoo["rank"] == 69) {
        $realIP = "B.O.S.S";
    }
    if ($userInfoo["rank"] == 15) {
        $realIP = "1.3.3.7";
    }
    if ($ripx["platform"] == "Iphone") {
        $platform = "<td><img src=\"apple.png\" title=\"Apple\"></td>";
    } elseif ($ripx["platform"] == "PC") {
        $platform = "<td><img src=\"windows.png\" title=\"Windows\"></td>";
    } else {
        $platform = "<td><img src=\"android.png\" title=\"Android\"></td>";
    }
	
	if($row["country"] == "IE") {
$country = "<td><img src=\"ie.png\" title=\"IE\"></td>";
} elseif($row["country"] == "Firefox") {
$country = "<td><img src=\"firefox.png\" title=\"Firefox\"></td>";
} elseif($row["country"] == "Opera") {
$country = "<td><img src=\"opera.png\" title=\"Opera\"></td>";
} else { 
$country = "<td><img src=\"crome.png\" title=\"Crome\"></td>";
}

if ($ripx["hide"] == "off"){
$username = substr_replace($ripx["username"], "***", -5, -2);    
}
if ($ripx["hide"] == "on"){
$username = "👻👻👻👻";
$realIP = "👻👻👻👻";    
}
$system = $ripx["method"];

    echo "\n    <tr class=\"text-center\"\x20s\x74\x79\x6c\x65\x3d\"font-size: 12px;\">" . $status . "<td><span>" . $username . "</span></td><td> ". $fotox ." </td><td>" . ${$wnvafklx} . "</td><td><span>" . _ago($ripx["date"]) . " ago</span></td>" . $platform .  "</tr>\n";
}
?>