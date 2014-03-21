<?php
use LaravelBook\Ardent\Ardent;
class ContestAnnouncement extends Ardent {
	protected $fillable = [];
	protected $table = "contest_announcement";

	public static $rules = array(
		'contest_name' => 'required' ,
		'contest_datetime' => 'required|date_format:Y-m-d H:i'
	);
}