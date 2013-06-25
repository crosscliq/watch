<?php 

$database = 'kiosk';
$username = 'root';
$password = 'F0rgetting01';
$hostname = 'localhost';




if (PHP_SAPI === 'cli') 
{ 

//lets connected to the database


try {
    $conn = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);	
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

//todo find a log file dynmically

$filename = 'f0:ae:51:00:04:ef-1372103575';

$array = explode('-', $filename);
$macAddress = $array[0];



// lets find the station we are taking in the database;

$stmt = $conn->prepare('SELECT * FROM lsf3y_mediamanager_stations WHERE uuid = :mac limit 1');
$stmt->execute(array('mac' => $macAddress));
$station = $stmt->fetch();






//TODO get the timezone from the database of where the station is location via mac address
/*if($station['timezone']) {
$timeZone = $station['timezone'];  
} else {
$timeZone = 'America/Denver';  
} */
$timeZone = 'America/Denver';
date_default_timezone_set($timeZone); 

//SHOULD WE use this last updated time? or should we  load the raw data table and sort by greatest time stamp by station id?
$lastUpdated = new DateTime($station['data_lastupdated']);

$file_timestamp = filemtime($filename);

//load the lines of the file into an array
$lines = file('f0:ae:51:00:04:ef-1372103575', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

//Shift off the first to lines of the new array because it  contains worthless copywrite
array_shift($lines);
array_shift($lines);


//group the lines of the file into  seconds groups
$seconds = array_chunk($lines, 9);

//drop the last line in the array, because it is most likely contain incomplete seconds data. we will process it next round anyway
array_pop($seconds);

//DO QUERY FROM DATABASE TO GET THE DATA


//loop the seconds generate timestamps and insert into the database. 
foreach ($seconds as $second) {

$secondOffest = array_shift($second);

		foreach ($second as $port)  {

		$data = str_getcsv($port);

		if(strpos($data[2], 'D')) {
			
			//port is disconnected
		} else {
			echo 'port is connected processing'."\n";


		$charging = 0;
		$attached = 0;
		$sync = 0;
		$states = explode(' ', trim($data[2]));

		foreach ($states as $state) {
			switch ($state) {
				case 'C':
					$charging = 1;
					break;
				case 'A':
					$attached = 1;
					break;	
				case 'S':
					$sync = 1;
					break;	
				default:
					# code...
					break;
			}

		}


		// TODO FIND A WAY TO NOT LOOP EVERYTHING AND JUST JUMP TO WHERE 
		$date = new DateTime();
		$date->setTimestamp($file_timestamp + $secondOffest);

		if($date >$lastUpdated) {
				echo 'data is new processing'."\n";
		
		$timestamp = $date->format("Y-m-d H:i:s");


		$portq = $conn->prepare('insert into lsf3y_mediamanager_stationsrawdata ( `charging`, `profile`, `station_id`, `timestamp`, `attached`, `usbport`, `states`, `sync`, `dev_id`, `dev_id2`) values ( :charging, :profile, :station_id, :timestamp, :attached, :usbport,  :states, :sync, :dev_id , :dev_id2  )');

		$portq->execute(
			array(
				'charging'=>$charging, 
				'profile'=>$data[1],
				'station_id'=>$station['station_id'],
				'timestamp'=>$timestamp,
				'attached'=>$attached,
				'usbport'=>$data[0],
				'states'=>$data[2],
				'sync'=>$sync,
				'dev_id'=>$data[7],
				'dev_id2'=>$data[8]
				  )
			);

		} else {
			//this  means that you just processed a record that was in the past, so we should probably ignore it, or do something useful
			
		}
			}// not disconnected
		}//ports

}






$updated = new DateTime();
//update last time the script ran
$portq = $conn->prepare('update lsf3y_mediamanager_stations set `data_lastupdated`= :data_lastupdated where `station_id`= :station_id');

		$portq->execute(
			array(
				'data_lastupdated'=>$updated->format("Y-m-d H:i:s"), 
				'station_id'=>$station['station_id']
				  )
			);

} 


?>