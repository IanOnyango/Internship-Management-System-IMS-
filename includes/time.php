<?php

/**
* 
*/
class TimeManager
{
	
	function __construct()
	{
		include_once("../database/constants.php");
	}

	public function calculateTime($time,$action){

		// Calculate difference between current 
		// time and given timestamp in seconds 
		$diff	 = time() - $time; 
						
		// Time difference in seconds 
		$sec	 = $diff; 
						
		// Convert time difference in minutes 
		$min	 = round($diff / 60 ); 
						
		// Convert time difference in hours 
		$hrs	 = round($diff / 3600); 
						
		// Convert time difference in days 
		$days	 = round($diff / 86400 ); 
						
		// Convert time difference in weeks 
		$weeks	 = round($diff / 604800); 
		
		// Convert time difference in months 
		$mnths	 = round($diff / 2600640 ); 
		
		// Convert time difference in years 
		$yrs	 = round($diff / 31207680 );

		// Check for seconds 
		if($sec <= 60) { 
			echo "$action less than a minute ago"; 
		} 
		
		// Check for minutes 
		else if($min <= 60) { 
			if($min==1) { 
				echo "$action one minute ago"; 
			} 
			else { 
				echo "$action $min minutes ago"; 
			} 
		} 
		
		// Check for hours 
		else if($hrs <= 24) { 
			if($hrs == 1) { 
				echo "$action an hour ago"; 
			} 
			else { 
				echo "$action $hrs hours ago"; 
			} 
		} 
		
		// Check for days 
		else if($days <= 7) { 
			if($days == 1) { 
				echo "$action Yesterday"; 
			} 
			else { 
				echo "$action $days days ago"; 
			} 
		} 
		
		// Check for weeks 
		else if($weeks <= 4.3) { 
			if($weeks == 1) { 
				echo "$action a week ago"; 
			} 
			else { 
				echo "$action $weeks weeks ago"; 
			} 
		} 
		
		// Check for months 
		else if($mnths <= 12) { 
			if($mnths == 1) { 
				echo "$action a month ago"; 
			} 
			else { 
				echo "$action $mnths months ago"; 
			} 
		} 
		
		// Check for years 
		else { 
			if($yrs == 1) { 
				echo "$action one year ago"; 
			} 
			else { 
				echo "$action $yrs years ago"; 
			} 
		} 
	}

	public function processTime($time){

		// Calculate difference between current 
		// time and given timestamp in seconds 
		$diff	 = time() - $time; 
						
		// Time difference in seconds 
		$sec	 = $diff; 
						
		// Convert time difference in minutes 
		$min	 = round($diff / 60 ); 
						
		// Convert time difference in hours 
		$hrs	 = round($diff / 3600); 
						
		// Convert time difference in days 
		$days	 = round($diff / 86400 ); 
						
		// Convert time difference in weeks 
		$weeks	 = round($diff / 604800); 
		
		// Convert time difference in months 
		$mnths	 = round($diff / 2600640 ); 
		
		// Convert time difference in years 
		$yrs	 = round($diff / 31207680 );

		// Check for seconds 
		if($sec <= 60) { 
			echo "less than a min"; 
		} 
		
		// Check for minutes 
		else if($min <= 60) { 
			if($min==1) { 
				echo "one min ago"; 
			} 
			else { 
				echo "$min min ago"; 
			} 
		} 
		
		// Check for hours 
		else if($hrs <= 24) { 
			if($hrs == 1) { 
				echo "an hour ago"; 
			} 
			else { 
				echo "$hrs hours ago"; 
			} 
		} 
		
		// Check for days 
		else if($days <= 7) { 
			if($days == 1) { 
				echo "Yesterday"; 
			} 
			else { 
				echo "$days days ago"; 
			} 
		} 
		
		// Check for weeks 
		else if($weeks <= 4.3) { 
			if($weeks == 1) { 
				echo "a week ago"; 
			} 
			else { 
				echo "$weeks weeks ago"; 
			} 
		} 
		
		// Check for months 
		else if($mnths <= 12) { 
			if($mnths == 1) { 
				echo "a month ago"; 
			} 
			else { 
				echo "$mnths months ago"; 
			} 
		} 
		
		// Check for years 
		else { 
			if($yrs == 1) { 
				echo "one year ago"; 
			} 
			else { 
				echo "$yrs years ago"; 
			} 
		} 
	}

}
//$t = new TimeManager();
//echo $t->loginTime("15423678");

?>