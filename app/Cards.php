<?php namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Cards extends Model {
	protected $table = 'cards';

	public function log()
	{
		return $this->hasMany('\App\Logs', 'card_id');
	}

	public function room()
	{
		return $this->belongsTo('\App\Rooms', 'room_id');
	}

	public function lastLog()
	{
		return $this->hasOne('\App\Logs', 'card_id')->orderBy('access', 'desc');
	}

}
