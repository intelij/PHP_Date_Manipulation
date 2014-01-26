<?php

/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * PHP version 5
 *
 * LICENSE: FREE / Open Source
 * 
 * @author     Khululekani Mkhonza <k.mkhonza@yahoo.co.uk>
 * @copyright  2014
 * @link       http://demo.intelij.co.uk 
 * @link       http://github.com/intelij
 * Twitter	   @intelij	
 *
 */

class MeetingManager 
{

	private $date;
	
	public function __constructor($date) {
		$this->date = $date;
	}
	/*
	* 
	* Get the last day of the month
	*
	* @param: $date
	* @return date value -> Y-m-d
	*
	*/
	public function getLastDayOfMonth($date) {
		return $month_end = date("Y-m-d",strtotime('last day of this month', $date));
	}	
	
	/*
	* 
	* Get the last day of the month
	*
	* @param: $date
	* @return date value -> Y-m-d
	*
	*/
	public function getLastThurdayOfMonth($mytime) {
		return date("Y-m-d",strtotime('last Thursday of this month', $mytime));
	}
	
	/*
	* 
	* Check to see if the date falls on a weekend
	*
	* @param: $date
	* @return integer value -> true/false depending on whether it falls on a weekend or not. 
	*
	*/
	public function isDateWeekend($date) {
		return (date('N', strtotime($date)) >= 6);
	}
	
	public function getMeetingDate($date) {
		$meeting_date = date('Y-m-d', strtotime(date("Y-m-d", strtotime('first day of this month', $date)) . ' + 13 days'));
		if (MeetingManager::isDateWeekend($meeting_date)) {
			return MeetingManager::getNextMonday($meeting_date);
		}		
		return $meeting_date;
	}
	
	/*
	* 
	* Check to see if the date falls on a Friday
	*
	* @param: $date
	* @return integer value -> true/false depending on whether it falls on a weekend or not. 
	*
	*/
	public function isDateFriday($date) {
		return (date('N', strtotime($date)) == 5);
	}
	
	/*
	* 
	* Get next monday from date
	*
	* @param: $date
	* @return date format Y-m-d 
	*
	*/
	public function getNextMonday($date) {
		return date("Y-m-d",strtotime($date." next Monday "));
	}
	
	/*
	* 
	* Check to see if last date falls on a Friday
	*
	* @param: $date
	* @return integer value -> true/false depending on whether it falls on a weekend or not. 
	*
	*/	
	public function isLastDayOfMonthFriday($date) {
		$lastday = date("Y-m-d",strtotime('last day of this month', $date));		
		if (date('N', strtotime($lastday)) == 5) 
			$lastday = date("Y-m-d",strtotime('last Thursday of this month', $date));
		return $lastday;

	}	
	
	/*
	* 
	* If the testing day falls on a Friday, Saturday or Sunday then testing should be set for the previous Thursday.
	*
	* @param: $date
	* @return date value
	*
	*/	
	public function getTestingDay($date) {
		$testing_date = MeetingManager::getLastDayOfMonth($date);
		if (!MeetingManager::isDateWeekend($testing_date) && !MeetingManager::isDateFriday($testing_date)) {
			return $testing_date;
		}				
		return MeetingManager::getLastThurdayOfMonth($date);
	}

	public function getNewDate($newD) {
		return new DateTime($newD);
	}
	
	public function createCSV($stack) {
		$fp = fopen('meetingmanager.csv', 'w');
		
		foreach ($stack as $line)
		  {
		  fputcsv($fp,explode(',',$line));
		  }
	    fclose($fp);
	}
	
}

date_default_timezone_set('UTC');

$mm = new MeetingManager;
	
$stack = array("Month,Mid Month Meeting Date,End of Month Testing Date");	
for ($i=2; $i<=6; $i++) {
	$date = "2014-$i-01";
	$date = $mm->getNewDate($date);
	$month_date = date("F", strtotime($mm->getMeetingDate($date->getTimestamp())));
	$meeting_date = date("j F Y", strtotime($mm->getMeetingDate($date->getTimestamp())));
	$testing_date = date("j F Y", strtotime($mm->getTestingDay($date->getTimestamp())));
	
	array_push($stack, "$month_date,$meeting_date,$testing_date");
		 
	$mm->createCSV($stack);
}







