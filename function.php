<?php
  $country = $_POST['country'];
  $year = $_POST['year'];

    getCountryFy($country,$year);

    function getCountryFy($country,$selYear){
        $startedDate = '';
        $endedDate = '';
        if($country == 'IRE'){
            $fyStart = $selYear.'-1-1';
            $fyEnd = $selYear.'-12-31';
            $startedDate = getStartDate($fyStart);
            $endedDate =  getEndDate($fyEnd);
        }
        elseif($country == 'UK'){
            $fyStart = $selYear.'-4-6';
            $fyEnd = ($selYear+1).'-4-5';
            $startedDate = getStartDate($fyStart);
            $endedDate =  getEndDate($fyEnd);
        }
	    echo json_encode(array(
                 'start' => $startedDate,
	             'end' =>  $endedDate
        ));
    }

    function getStartDate($date){
    	$fyStartTimestamp = strtotime($date);
        $weekday= date("l", $fyStartTimestamp );
        if ($weekday == "Saturday"){
        	$startDate =  date('Y-m-d', strtotime($date. ' + 2 days'));
        	$financialYear = date("jS F Y", strtotime($startDate)).' ('.date("jS", strtotime($date)).' and '.date("jS", strtotime($date. ' + 1 days')).' '.date("M Y", strtotime($date)).' are Saturday and Sunday)';
        }
        elseif($weekday == "Sunday"){
        	$startDate = date('Y-m-d', strtotime($date. ' + 1 days'));
        	$financialYear = date("jS F Y", strtotime($startDate)).' ('.date("jS M Y", strtotime($date)).' is Sunday )';
        }
        else{
        	$financialYear = date("jS F Y", strtotime($date));
        }
        return $financialYear;    
    }

    function getEndDate($date){
    	$fyStartTimestamp = strtotime($date);
        $weekday= date("l", $fyStartTimestamp );
        if ($weekday == "Saturday"){
        	$startDate =  date('Y-m-d', strtotime($date. ' - 1 days'));
        	$financialYear = date("jS F Y", strtotime($startDate)).' ('.date("jS M Y", strtotime($date)).' is Saturday )';
        }
        elseif($weekday == "Sunday"){
        	$startDate = date('Y-m-d', strtotime($date. ' - 2 days'));
            $financialYear = date("jS F Y", strtotime($startDate)).' ('.date("jS", strtotime($date. ' - 1 days')).' and '.date("jS", strtotime($date)).' '.date("M Y", strtotime($date)).' are Saturday and Sunday)';
        }
        else{
        	$financialYear = date("jS F Y", strtotime($date));
        }
        return $financialYear;    
    }
?>