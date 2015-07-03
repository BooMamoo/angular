<?php namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Rooms extends Model {
	protected $table = 'rooms';

	public function card()
	{
		return $this->hasMany('\App\Cards', 'room_id');
	}

	public function log()
	{
		return $this->hasManyThrough('App\Logs', 'App\Cards', 'room_id', 'card_id');
	}

}
