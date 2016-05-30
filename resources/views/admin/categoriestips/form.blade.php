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
<link href="{!! asset('css/pingpong_style.css') !!}" rel="stylesheet" type="text/css">
<style>

</style>
<div class="form-horizontal">
	{!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['admin.categoriestips.update', $model->id]]) !!}
	<input id="id" type="hidden" value="{{$model->id}}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
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
	    {!! Form::label('coverImage', 'Cover Image:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-3">
			<div class="pdfTypeTitle">Icon Preview 200x200</div>
			@if(isset($model->icon_path))
				<div id="coverImagePDP" style="background-image: url('{{$model->icon_path}}'); background-size: contain; background-repeat: no-repeat;"></div>
			@else
				<div id="coverImagePDP">
					Preview of Cover Image on PDP 200x200 pixels
				</div>
			@endif

	    </div>
		
		<div class="col-sm-3">
			<div id="coverImageDropzone">
				Drag a <strong>single image</strong> here <br>
				or <br>
				Click here to open a File Picker
			</div>
		</div>

	</div>
	
	<div style="display:none" class="form-group">
	    {!! Form::label('icon_path', '', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::hidden('icon_path', null, ['class' => 'form-control']) !!}
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
<div id="noDZPreview"></div>


@section('script')
<!-- 3rd party libraries for Form Advanced Elements -->
	<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
	<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript" charset="utf-8"></script-->
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="{!! asset('scripts/dropzone.js') !!}" type="text/javascript" charset="utf-8"></script>
    <script src="{!! asset('scripts/admin_categories_edit.js') !!}" type="text/javascript" charset="utf-8"></script>

@stop
