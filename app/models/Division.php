<?php
use LaravelBook\Ardent\Ardent;
class Division extends Ardent {
	protected $fillable = [];
	public static $rules = array(
		'division_name' => 'required|unique:divisions'
	);
}