<?php namespace App\Http\Controllers;

use DB;
use Carbon;
use App\Cards;
use App\Logs;
use App\Rooms;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ListController extends Controller {

	public function index($room)
	{
		$cards = Cards::with("lastLog")->where('room_id', '=', $room)->get();
		$test = Cards::with("lastLog")->where('room_id', '=', $room)->skip(0)->take(5)->get();
		dd($test);
		$days = Logs::with("card")->where('room_id', '=', $room)->where("logs.access", "=", function($query) {
			$query->select(DB::raw('MAX(tmp.access)'))->from('logs as tmp')->whereRaw('date(logs.access) = date(tmp.access)');
		})->orderBy('access')->get();

		$checks = Logs::where('room_id', '=', $room)->select(DB::raw('date(access) as d, count(distinct card_id) as c'))->groupBy('d')->get(); 
		
		$room = Rooms::where('id', '=', $room)->get();

		return compact("cards", "days", "checks", "room");
	}

	public function name($room, $page)
	{
		$pagelen = 15;
		$total_row = Cards::select(DB::raw('COUNT(*) as count'))->where('room_id', '=', $room)->get();
		$total_page = ceil((int)($total_row[0]->count) / $pagelen);
		$start = ($page - 1) * $pagelen;
		$cards = Cards::with("lastLog")->where('room_id', '=', $room)->skip($start)->take($pagelen)->get();

		$room = Rooms::where('id', '=', $room)->get();
		$status = true;

		return compact("cards", "room", "total_page", "status");
	}

	public function day($room, $page)
	{
		$pagelen = 15;
		$total_row = Logs::select(DB::raw('COUNT(DISTINCT date(access)) as count'))->where('room_id', '=', $room)->get();
		$total_page = ceil((int)($total_row[0]->count) / $pagelen);
		$start = ($page - 1) * $pagelen;
		// $days = Logs::with("card")->where("logs.access", "=", function($query) use ($room) {
		// 	$query->select(DB::raw('MAX(tmp.access)'))->from('logs as tmp')->whereRaw('date(logs.access) = date(tmp.access)')->where('tmp.room_id', '=', $room);
		// })->orderBy('access')->skip($start)->take($pagelen)->get();

		$days = Logs::with("card")->where("logs.access", "=", function($query) use ($room) {
			$query->select(DB::raw('MAX(tmp.access)'))->from('logs as tmp')->whereRaw('logs.date = tmp.date')->where('tmp.room_id', '=', $room);
		})->orderBy('access')->skip($start)->take($pagelen)->get();

		$room = Rooms::where('id', '=', $room)->get();
		$status = true;

		return compact("days", "room", "total_page", "status");
	}

	public function check($room, $page)
	{
		$pagelen = 15;
		$total_row = Logs::select(DB::raw('COUNT(DISTINCT date(access)) as count'))->where('room_id', '=', $room)->get();
		$total_page = ceil((int)($total_row[0]->count) / $pagelen);
		$start = ($page - 1) * $pagelen;
		$checks = Logs::where('room_id', '=', $room)->select(DB::raw('date(access) as d, count(distinct card_id) as c'))->groupBy('d')->skip($start)->take($pagelen)->get();
		
		$room = Rooms::where('id', '=', $room)->get();
		$status = true;

		return compact("checks", "room", "total_page", "status");
	}

	public function room()
	{
		$rooms = Rooms::all();
		$status = true;
		return compact("rooms", "status");
	}

	public function listName($id, $room, $page)
	{ 
		$pagelen = 20;
		$total_row = Logs::select(DB::raw('COUNT(*) as count'))->where('room_id', '=', $room)->where('card_id', '=', $id)->get();
		$total_page = ceil((int)($total_row[0]->count) / $pagelen);
		$start = ($page - 1) * $pagelen;
		$shows = Logs::with("room")->where('room_id', '=', $room)->where('card_id', '=', $id)->skip($start)->take($pagelen)->get();
		$name = Cards::with('log')->find($id)->name;
		$card_id = Cards::where('id', '=', $id)->get();
		$card_id = $card_id[0]->card_id;

		$status = true;
;
		return compact("shows", "name", "card_id", "total_page", "status");
	}

	public function listDay($day, $room, $page)
	{
		$pagelen = 20;
		$day = Carbon::parse($day)->format('Y-m-d');
		$startDate = date("Y-m-d H:i:s", strtotime($day));
		$stopDate = date("Y-m-d H:i:s", strtotime($day . " 23:59:59"));
		$total_row = Logs::select(DB::raw('COUNT(*) as count'))->where('room_id', '=', $room)->whereBetween('access', array($startDate, $stopDate))->get();
		$total_page = ceil((int)($total_row[0]->count) / $pagelen);
		$start = ($page - 1) * $pagelen;
		$shows = Logs::with(array("card", "room"))->where('room_id', '=', $room)->whereBetween('access', array($startDate, $stopDate))->orderBy('access')->skip($start)->take($pagelen)->get();

		$status = true;

		return compact("shows", "day", "total_page", "status");
	}

	public function listCheck($day, $room, $page)
	{
		$pagelen = 20;
		$day = Carbon::parse($day)->format('Y-m-d');
		$startDate = date("Y-m-d H:i:s", strtotime($day));
		$stopDate = date("Y-m-d H:i:s", strtotime($day . " 23:59:59"));
		$total_row = Cards::select(DB::raw('COUNT(*) as count'))->where('room_id', '=', $room)->get();
		$total_page = ceil((int)($total_row[0]->count) / $pagelen);
		$start = ($page - 1) * $pagelen;
		$cards = Cards::with("room")->where('room_id', '=', $room)->skip($start)->take($pagelen)->get();
		$shows =  Logs::with("card")->where('room_id', '=', $room)->whereBetween('access', array($startDate, $stopDate))->groupBy('card_id')->get();

		$status = true;

		return compact("shows", "day", "cards", "status", "total_page");
	}
}
