<?php namespace App\Http\Controllers;

use App\Cards;
use App\Logs;
use App\Rooms;
use File;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FormController extends Controller {

	public function index()
	{
		$rooms = Rooms::all();
		return compact("rooms");
	}

	public function store_card(Request $request)
	{
		$valid = Validator::make($request->all(), [
			'file' => 'required|mimes:csv,txt'
		]);

		if ($valid->fails())
		{
			$error = $valid->errors()->all();
			return $error;
		}



		if($request->hasFile('file'))
		{
			$files = $request->file('file');
			$mime = $files->getClientMimeType();
			$path = $files->getRealPath();
			$room = $request->input('room');

			if($room == 1)
			{
				if($mime == "text/plain")
				{
					$contents = file($files->getRealPath());

					for($i = 1 ; $i < count($contents) ; $i++)
					{
						$tmp = preg_split("/\s+/", $contents[$i]);
						$query = Cards::where('room_id', '=', $room)->where('card_id', '=', $tmp[2])->where('name', '=', $tmp[1])->get();
			
						if($query->isEmpty())
						{
							$card = new Cards;
							$card->card_id = (int)($tmp[2]);
							$card->name = $tmp[1];
							$card->room_id = $room;
							$card->save();
						}
					}

					return "true";
				}
				else if($mime == "text/csv")
				{
					$open = fopen($path, "r");
					$tmp = 0;

					while(!empty($data = fgetcsv($open))) 
					{
						if($tmp != 0)
						{
							$card = Cards::where('room_id', '=', $room)->where('card_id', '=', $data[2])->where('name', '=', $data[1])->get();

							if($card->isEmpty())
							{
								$card = new Cards;
								$card->card_id = (int)($data[2]);
								$card->name = $data[1];
								$card->room_id = $room;
								$card->save();
							}				
						}

						$tmp = 1;
					}

					fclose($open);

					return "true";
				}	
			}
			else if($room == 2)
			{
				$open = fopen($path, "r");
				$tmp = 0;

				while(!empty($data = fgetcsv($open))) 
				{
					if($tmp != 0)
					{
						$card = Cards::where('room_id', '=', $room)->where('card_id', '=', $data[0])->where('name', '=', $data[1])->get();

						if($card->isEmpty())
						{
							$card = new Cards;
							$card->card_id = (int)($data[0]);
							$card->name = $data[1];
							$card->room_id = $room;
							$card->save();
						}				
					}

					$tmp = 1;
				}

				fclose($open);

				return "true";
			}
			
		}
	
		return "Error";
	}

	public function store_log(Request $request)
	{
		$valid = Validator::make($request->all(), [
			'file' => 'required|mimes:txt'
		]);

		if ($valid->fails())
		{
			$error = $valid->errors()->all();
			return $error;
		}

		if($request->hasFile('file'))
		{
			$files = $request->file('file');
			$mime = $files->getClientMimeType();
			$path = $files->getRealPath();
			$room = $request->input('room');

			if($room == 1)
			{
				if($mime == "text/plain")
				{
					$contents = file($files->getRealPath());

					for($i = 1 ; $i < count($contents) ; $i++)
					{
						$tmp = preg_split("/\s+/", $contents[$i]);

						$date = $tmp[3]. " " .$tmp[4];
						$date = str_replace('/', '-', $date);
						$date = date("Y-m-d H:i:s", strtotime($date));
						$log = Logs::where('access', '=', $date)->get();

						if($log->isEmpty())
						{
							$query = Cards::where('card_id', '=', $tmp[2])->where('room_id', '=', $room)->get();

							$log = new Logs;
							$log->card_id = $query[0]->id;
							$log->room_id = $room;
							$log->access = $date;
							$log->save();
						}
					}

					return "true";
				}
				else if($mime == "text/csv")
				{
					$open = fopen($path, "r");
					$tmp = 0;

					while(!empty($data = fgetcsv($open))) 
					{
						if($tmp != 0)
						{
							$data[3] = str_replace('/', '-', $data[3]);
							$date = date("Y-m-d H:i:s", strtotime($data[3]));
							$log = Logs::where('access', '=', $date)->get();
							
							if($log->isEmpty())
							{
								$query = Cards::where('card_id', '=', $data[2])->where('room_id', '=', $room)->get();

								$log = new Logs;
								$log->card_id = $query[0]->id;
								$log->room_id = $room;
								$log->access = $date;
								$log->save();
							}			
						}

						$tmp = 1;
					}

					fclose($open);

					return "true";
				}	
			}
			else if($room == 2)
			{
				$contents = file($files->getRealPath());			

				for($i = 1 ; $i < count($contents) ; $i++)
				{
					$tmp = explode("\t", $contents[$i]);

					$log = Logs::where('access', '=', $tmp[9])->get();

					if($log->isEmpty())
					{
						if($tmp[2] != '00000000')
						{
							$query = Cards::where('card_id', '=', $tmp[2])->where('room_id', '=', $room)->get();

							$log = new Logs;
							$log->card_id = $query[0]->id;
							$log->room_id = $room;
							$log->access = $tmp[9];
							$log->save();
						}
					}
				}

				return "true";
			}
		}

		return "Error";
	}
}