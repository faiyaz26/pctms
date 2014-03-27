<?php
use LaravelBook\Ardent\Ardent;
class Season extends Ardent {
	protected $fillable = [];
	public static $rules = array(
		'season_name' => 'required|unique:seasons'
	);
}