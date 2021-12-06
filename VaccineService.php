<?php

class VaccineService {
	
	function restGet($params) {
		$type = array_shift($params);
		if ($type==='student') {
			// search booking record of a student
			$stid = array_shift($params);
			require_once 'db.php';
			
			$resultArray = array();
			$sql = "SELECT * FROM booking WHERE staffStudentId='$stid'";
			if ($dbresult=$conn->query($sql)) {
				// records retrieved
				while ( $row=$dbresult->fetch_object()  ) {
					$record = array();
					$record['bookingId'] = $row->bookingId;
					$record['staffStudentId'] = $row->staffStudentId;
					$record['staffStudentName'] = $row->staffStudentName;
					$record['campusId'] = $row->campusId;
					$record['scheduleDate'] = $row->scheduleDate;
					$record['timeSlotId'] = $row->timeSlotId;
					$record['bookingDateTime'] = $row->bookingDateTime;
					$resultArray[] = $record;
				}
				echo json_encode($resultArray);
			} else {
				$arr = array();
				$arr["status"] = "error";
				$arr["errcode"] = "101";
				$arr["errmsg"] = "SQL failed in retrieving booking record of students";
				echo json_encode($arr);
				exit;
			}			
		} elseif ($type==='campusBooking') {
			// search bookings in a campus
			$campusId = array_shift($params);
			require_once 'db.php';
			$resultArray = array();
			$sql = "SELECT * FROM booking WHERE campusId='$campusId'";
			if ($dbresult=$conn->query($sql)) {
				// records retrieved
				while ( $row=$dbresult->fetch_object()  ) {
					$record = array();
					$record['bookingId'] = $row->bookingId;
					$record['staffStudentId'] = $row->staffStudentId;
					$record['staffStudentName'] = $row->staffStudentName;
					$record['campusId'] = $row->campusId;
					$record['scheduleDate'] = $row->scheduleDate;
					$record['timeSlotId'] = $row->timeSlotId;
					$record['bookingDateTime'] = $row->bookingDateTime;
					$resultArray[] = $record;
				}
				echo json_encode($resultArray);
			} else {
				$arr = array();
				$arr["status"] = "error";
				$arr["errcode"] = "102";
				$arr["errmsg"] = "SQL failed in retrieving booking record in campus";
				echo json_encode($arr);
				exit;
			}			
		} 
	}
	
	function restPost($params) {
		$type = array_shift($params);
		if ($type==='booking') {
			$staffStudentId = array_shift($params);
			$staffStudentName = array_shift($params);
			$campusId = array_shift($params);
			$scheduleDate = array_shift($params);
			$timeSlotId = array_shift($params);
			
			require_once 'db.php';
			$sql = "INSERT INTO booking (staffStudentId, staffStudentName, campusId, scheduleDate, timeSlotId) VALUES ('$staffStudentId', '$staffStudentName', '$campusId', '$scheduleDate', $timeSlotId)";
			if ($dbresult=$conn->query($sql)) {
				echo "booking recorded";
				exit;
			} else {
				$arr = array();
				$arr["status"] = "error";
				$arr["errcode"] = "102";
				$arr["errmsg"] = "SQL failed to creat booking record";
				echo json_encode($arr);
				exit;
			}			
		}
	}
	
	function restPut($params) {
	}
	
	function restDelete($params) {
		$type = array_shift($params);
		if ($type==='booking') {
			$bookingId = array_shift($params);
			
			require_once 'db.php';
			$sql = "DELETE FROM booking where bookingId='$bookingId'";
			if ($dbresult=$conn->query($sql)) {
				echo "booking deleted";
				exit;
			} else {
				$arr = array();
				$arr["status"] = "error";
				$arr["errcode"] = "103";
				$arr["errmsg"] = "SQL failed to delete booking record";
				echo json_encode($arr);
				exit;
			}			
		}
	}
}








