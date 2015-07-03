@extends('template')

@section('content')

	<div class="card-panel teal">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab col s3"><a href="#name" class="active name"> Name </a></li>
				<li class="tab col s3"><a href="#day" class="day"> Day </a></li>
				<li class="tab col s3"><a href="#check" class="day"> Check </a></li>
			</ul>
		</div>

		<ul class="collection">

			<div id="name" class="col s12">
				@foreach($cards as $card)

					<a href="{{ url('listName') }}?id={{ $card->id }}" class="collection-item" id="{{ $card->id }}">{{ $card->name }}

						@if(!empty($card->lastLog))
							<?php
								$date = new DateTime($card->lastLog->access);
							?>

							<span class="new badge"> {{ $date->format('d-m-Y') }} {{ $date->format('H:i:s') }} </span>

						@endif
					</a>

				@endforeach

			</div>

			<div id="day" class="col s12">
				@foreach($days as $day)

					<a href="{{ url('listDay') }}?day={{ date('d-m-Y', strtotime($day->access)) }}" class="collection-item" id="{{ date('d-m-Y', strtotime($day->access)) }}">
						{{ date('d-m-Y', strtotime($day->access)) }}

						<span class="new badge"> {{ $day->card->name }} </span>
					</a>

				@endforeach
			</div>

			<div id="check" class="col s12">
				@foreach($checks as $check)

					<a href="{{ url('listCheck') }}?day={{ date('d-m-Y', strtotime($check['date(access)'])) }}" class="collection-item" id="{{ date('d-m-Y', strtotime($check['date(access)'])) }}">
						{{ date('d-m-Y', strtotime($check['date(access)'])) }}

						<span class="badge"> {{ $check['count(distinct card_id)'] }} </span>
					</a>

				@endforeach
			</div>
		</ul>
	</div>

@endsection
