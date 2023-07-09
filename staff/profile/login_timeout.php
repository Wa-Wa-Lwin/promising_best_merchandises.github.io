<?php

include('connect.php');

// Login timeout function //

function getloginattempt($type, $connnection)
{
	date_default_timezone_set('Asia/Yangon');
    $ip = $_SERVER['REMOTE_ADDR'];
    
    if ($type == "GET") {
        $getip = "SELECT * FROM loginattempt WHERE IP= '$ip'";
        $getipresult = $connnection->query($getip);

        if ($getipresult->num_rows > 0) {
            $row = mysqli_fetch_assoc($getipresult);
            $time = round((strtotime($row["AttemptTime"]) - time()), 0);
            if ($row["Attempt"] > 10) {
                return 5000;
            } else {
                if ($time <= 0) {
                    return 0;
                } else {
                    return abs($time);
                }
            }
        } else {
        	$time = new DateTime();
            $time = $time->format('Y-m-d H:i:s');
            $insertattempt = "INSERT INTO loginattempt (IP, AttemptTime) VALUES ('$ip', '$time')";
            if ($connnection->query($insertattempt) === TRUE) {
                return 0;
            }
        }
    } else if ($type == "FAIL") {
        $getip = "SELECT * FROM loginattempt WHERE IP = '$ip'";
        $getipresult = $connnection->query($getip);
        if ($getipresult->num_rows > 0) {
            $row = mysqli_fetch_assoc($getipresult);
            if ($row["Attempt"] < 2) {

            	addattempttime($row["IP"], $row["Attempt"], "0S", $connnection);
            } elseif ($row["Attempt"] < 4) {
            	addattempttime($row["IP"], $row["Attempt"], "1M", $connnection);
            } else {
            	addattempttime($row["IP"], $row["Attempt"], "5M", $connnection);
            }
        }
    } else if ($type == "SUCCESS") {
        $deleteattempt = "DELETE FROM loginattempt WHERE IP = '$ip'";
        // "UPDATE loginattempt SET attempt= 0 WHERE ip= '$ip'";
        $rundeleteattempt = mysqli_query($connnection, $deleteattempt);
    }
}
function waitingtime($loginattempt)
{
    if ($loginattempt > 3600) {
    	$message = 'Please wait ' . $loginattempt / 3600 % 3600 . ' hours to login due to last failed attempt.';
    	echo "<script>window.alert('$message')</script>";
    } else if ($loginattempt > 60) {
    	$message = 'Please wait ' . $loginattempt / 60 % 60 . ' minutes to login due to last failed attempt.';
    	echo "<script>window.alert('$message')</script>";
    } else if ($loginattempt > 0 && $loginattempt < 60) {
    	$message = 'Please wait ' . $loginattempt  . ' seconds to login due to last failed attempt.';
    	echo "<script>window.alert('$message')</script>";
    }
}

function addattempttime($ip, $attempt, $waiting, $connnection) {
	$time = new DateTime();
	$time = $time->add(new DateInterval('PT' . $waiting));
	$time = $time->format('Y-m-d H:i:s');
	$newattempt = $attempt + 1;
    $insertattempt = "UPDATE loginattempt SET Attempt= '$newattempt', AttemptTime = '$time'  WHERE IP = '$ip'";
    $runinsertattempt = mysqli_query($connnection, $insertattempt);
}

// Function end //
