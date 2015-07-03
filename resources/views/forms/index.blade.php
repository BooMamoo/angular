@extends('template')

@section('link')

	<link rel="stylesheet" href="{{ asset('/css/form.css') }}">

@endsection

@section('content')
	
	<ul class="collapsible" data-collapsible="accordion">
		<li>
			<div class="collapsible-header"><i class="mdi-image-filter-drama"></i> Form upload user's id </div>
			<div class="collapsible-body">
				<p class="form">
					<div class="form-card">
						<div class="file-field input-field">
							<input class="file-path validate" type="text"/>

							<div class="btn">
								<span>File</span>
								<input type="file" name="cardFile" class="card">
							</div>
						</div>

						<button class="btn waves-effect waves-light right btn-card" type="submit" name="action">
							Submit <i class="mdi-content-send right"></i>
						</button>
					</div>
				</p>
			</div>
		</li>


		<li>
			<div class="collapsible-header"><i class="mdi-maps-place"></i> Form upload access logs </div>
			<div class="collapsible-body">
				<p class="form">
					<div class="form-log">
						<div class="file-field input-field">
							<input class="file-path validate" type="text"/>

							<div class="btn">
								<span>File</span>
								<input type="file" name="logFile" class="log">
							</div>
						</div>

						<button class="btn waves-effect waves-light right btn-log" type="submit" name="action">
							Submit <i class="mdi-content-send right"></i>
						</button>
					</div>
				</p>
			</div>
		</li>
	</ul>

@endsection

@section('script')

	$("button.btn-card").on("click", function() {
		var tmp = $(".card")[0].files
		var formData = new FormData()
		formData.append("cardFile", tmp[0])

		$.ajax( {
			method: "POST",
			url: "{{ url('store/card') }}",
			contentType: false,
			processData: false,
			data: formData,
			success: function(data) {
				if(data == "true")
				{
					Materialize.toast("Success", 2000)
				}
				else
				{
					Materialize.toast(data[0], 2000)
				}
				
				$("input").val("")	
			}
		})
	})

	$("button.btn-log").on("click", function() {
		var tmp = $(".log")[0].files
		var formData = new FormData()
		formData.append("logFile", tmp[0])
		console.log(formData)

		$.ajax( {
			method: "POST",
			url: "{{ url('store/log') }}",
			contentType: false,
			processData: false,
			data: formData,
			success: function(data) {
				if(data == "true")
				{
					Materialize.toast("Success", 2000)
				}
				else
				{
					Materialize.toast(data[0], 2000)
				}
				
				$("input").val("")	
			}
		})
	})

@endsection
