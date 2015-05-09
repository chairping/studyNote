<?php

namespace Carbon;

use Closure;
use DateTime;
use DateTimeZone;
use DateInterval;
use DatePeriod;

class Carbon extends DateTime
{
    
	public function __construct($time = null, $tz = null) {
		!$time && $time = 'now';
		!$tz && $tz = date_default_timezone_get();    
		parent::__construct();
	}

	

}




