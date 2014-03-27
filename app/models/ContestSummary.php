<?php
use LaravelBook\Ardent\Ardent;
class ContestSummary extends Ardent {
	protected $fillable = [];
	protected $table = "contest_summary";

	public static $rules = array(
		
	);

	public function contest(){
		return $this->belongsTo('Contest');
	}
}