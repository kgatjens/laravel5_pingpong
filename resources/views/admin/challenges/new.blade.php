@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link href="{!! asset('lib/css/jquery.tagit.css', true) !!}" rel="stylesheet" type="text/css">
<link href="{!! admin_asset('css/style.css', true) !!}" rel="stylesheet" type="text/css">
<style>

</style>
<div class="form-horizontal">
	{!! Form::open(['files' => true, 'route' => 'admin.challenges.store']) !!}
	<div class="form-group">
		{!! Form::label('title', 'Title:', ['class' => 'col-md-2 control-label']) !!}
		<div class="col-sm-9">
			{!! Form::text('title', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('description', 'Description:', ['class' => 'col-md-2 control-label']) !!}
		<div class="col-sm-9">

			{!! Form::textarea('description', null, ['class' => 'form-control', 'id'=>'description']) !!}
			{!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
		</div>
	</div>
	<div class="form-group">
		<label class="col-md-2 control-label"></label>
		<div class="col-sm-9">
			{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		</div>
	</div>
	{!! Form::close() !!}
</div>


@section('script')
		<!-- 3rd party libraries for Form Advanced Elements -->

<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript" charset="utf-8"></script-->
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="{!! asset('lib/js/tag-it.js', true) !!}" type="text/javascript" charset="utf-8"></script>

@stop