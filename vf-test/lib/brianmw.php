<?php
//namespace BrianMWHeaderXdayAdd;

class BrianMWHeaderXdayAdd extends SlimMiddleware {
	public function __construct(){}

	public function call()
	{
		$date = new DateTime();
		$dow = date_format("l", $date);

		return $this->app()->response()-withHeader('X-Day', $dow);
	}
}



