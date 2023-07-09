<?php

function AutoID($tableName,$fieldName,$prefix)
{ 
	include('connect.php');
	$noOfLeadingZeros = 6;
	$newID="";
	$sql="";
	$value=1;
	
	$sql="SELECT " . $fieldName . " FROM " . $tableName . " ORDER BY " . $fieldName . " DESC";
	
	$result = mysqli_query($dbconnect,$sql);
	$noOfRow=mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	
	if ($noOfRow<1)
	{		
		return $prefix . "000001";
	}
	else
	{
		$oldID=$row[$fieldName];	//Reading Last ID
		$oldID=str_replace($prefix,"",$oldID);	//Removing "Prefix"
		$value=(int)$oldID;	//Convert to Integer
		$value++;	//Increment
		$newID=$prefix . NumberFormatter($value,$noOfLeadingZeros);
		return $newID;
	}
}

function NumberFormatter($number,$n) 
{	
	return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

function CustomerID () {
	return AutoID("customers", "CustomerID", "CR-");
}

/*EXAMPLE USAGE

function RoleID () {
	return AutoID("staff_roles", "RoleID", "SR-");
}

function StaffID () {
	return AutoID("staffs", "StaffID", "SF-");
}

*/