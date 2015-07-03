@extends('template')

@section('content')
	
	<div class="show blue-grey lighten-5">
	
		<p class="text-form teal-text center"> {{ $day }} 's Logs </p>

		<table class="hoverable">

			@if(!$shows->isEmpty())

				<thead>
					<tr>
						<th>Number</th>
						<th>ID</th>
						<th>Name</th>
						<th>Date</th>
						<th>Time</th> 
					</tr>    
				</thead>				

				<tbody>
					
					<?php
						$count = 1;
					?>

					@foreach($shows as $show)
				
						<?php

							$date = new DateTime($show->access);

						?>

						<tr>
							<td> {{ $count++ }} </td>
							<td> {{ $show->card_id }} </td>
							<td> {{ $show->card->name }} </td>
							<td> {{ $date->format('d-m-Y') }} </td>
							<td> {{ $date->format('H:i:s') }} </td>
						</tr>
				
					@endforeach

				</tbody>     
		</table>

			@else

				<p class="no-info center">No information</p>

			@endif
	</div>


	<a href="{{ url('list') }}" class="waves-effect waves-light btn right"><i class="mdi-file-cloud left"></i> Back </a>

@endsection

