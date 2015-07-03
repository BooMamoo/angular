@extends('template')

@section('content')
	
	<div class="show blue-grey lighten-5">
	
		<p class="text-form teal-text center"> {{ $day }}'s Logs </p>

		<table class="hoverable">

			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>First Access</th>
					<th class="center">Check</th> 
				</tr>    
			</thead>				

			<?php
				$count = 1;
			?>

			<tbody>

				@foreach($shows as $show)
					@while($show->card_id != $count)
				
						<tr>
							<td> {{ $cards[$count - 1]->id }} </td>
							<td> {{ $cards[$count - 1]->name }} </td>
							<td> No information </td>
							<td class="center"><a class="waves-effect waves-light btn red">Absent</a> </td>
						</tr>

						<?php
							
							$count++;

						?>

					@endwhile
						
						<?php

							$date = new DateTime($show->access);	

						?>

						<tr>
							<td> {{ $show->card->id }} </td>
							<td> {{ $show->card->name }} </td>
							<td> {{ $date->format('H:i:s') }} </td>
							<td class="center"><a class="waves-effect waves-light btn green">Present</a> </td>
						</tr>

						<?php
							$count++;
						?>

				@endforeach

			</tbody>  
   
		</table>

	</div>


	<a href="{{ url('list') }}" class="waves-effect waves-light btn right"><i class="mdi-file-cloud left"></i> Back </a>

@endsection

