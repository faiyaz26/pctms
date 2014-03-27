<?php
use LaravelBook\Ardent\Ardent;
class Contest extends Ardent {
	protected $fillable = [];

	public static $rules = array(
		'contest_name' => 'required' ,
		'contest_date' => 'required|date_format:Y-m-d',
		'contest_standing_url' => 'required'
	);
}