<?php namespace App;
 
use Illuminate\Database\Eloquent\Model;
use Carbon;

class Logs extends Model {
	protected $table = 'logs';

	public function card()
	{	
		return $this->belongsTo('\App\Cards', 'card_id');
	}

	public function room()
	{
		return $this->belongsTo('\App\Rooms', 'room_id');
	}

	public function getAccessAttribute()
	{
		$date = New Carbon($this->attributes['access'], 'Asia/Bangkok');
    		return $date->toIso8601String();
	}

}
