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
	{!! Form::open(['files' => true, 'route' => 'admin.tips.store']) !!}
	<input id="id" type="hidden" value=""/>

	<div class="form-group">
	    {!! Form::label('title', 'Title:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('title', null, ['class' => 'form-control']) !!}
	        {!! $errors->first('title', '<div class="text-danger">:message</div>') !!}
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
	    {!! Form::label('link', 'Link:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('link', null, ['class' => 'form-control']) !!}
	        {!! $errors->first('link', '<div class="text-danger">:message</div>') !!}
	    </div>
	</div>


	<div class="form-group">
        {!! Form::label('coverImage', 'Image:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-3">
            <div class="pdfTypeTitle">Image Preview 200x57</div>
            @if(isset($model->media_path))
                <div id="coverImagePDP" style="width: 200px; height: 57px; background-image: url('{{$model->media_path}}'); background-size: contain; background-repeat: no-repeat;"></div>
            @else
                <div id="coverImagePDP">
                    Preview of Image 200x57 pixels
                </div>
            @endif

        </div>
        
        <div class="col-sm-3">
            <div id="coverImageTipDropzone">
                Drag a <strong>single image</strong> here <br>
                or <br>
                Click here to open a File Picker
            </div>
        </div>

    </div>
	<div style="display:none" class="form-group">
	{!! Form::label('media_path', 'Icon:', ['class' => 'col-md-2 control-label']) !!}
		<div class="col-sm-9">
			{!! Form::hidden('media_path', null, ['class' => 'form-control']) !!}
		</div>
	</div>
	<div class="form-group">
        {!! Form::label('categories_id', 'Category:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            <select name="categories_id" id="categories_id">
                <option value="" selected>-- none --</option>
                @foreach($categories as $cat)
                    @if(isset($myCategory))
                        @if (in_array($id, $myCategory))
                            <option value="{{$cat->id}}" selected>{!! $cat->title !!}</option>
                        @else
                            <option value="{{$cat->id}}">{!! $cat->title !!}</option>
                        @endif
                    @else
                        <option value="{{$cat->id}}">{!! $cat->title !!}</option>
                    @endif
                @endforeach
            </select>
            {!! $errors->first('categories_id', '<div class="text-danger">:message</div>') !!}
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
	<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>
	<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js" type="text/javascript" charset="utf-8"></script-->
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="{!! asset('scripts/dropzone.js') !!}" type="text/javascript" charset="utf-8"></script>
    <script src="{!! asset('scripts/admin_tips_edit.js') !!}" type="text/javascript" charset="utf-8"></script>

@stop