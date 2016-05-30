@extends('admin::layouts.master')

@section('content')
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong>
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
  <div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">{!! $title or 'All Categories' !!} ({!! $categories->count() !!})</h3>
	</div>
	  <div class="panel-body">
		  <div class="btn-toolbar" role="toolbar" aria-label="...">
			  <div class="btn-group pull-right" role="group" aria-label="...">

				  <a href="{!! route('admin.categoriestips.create') !!}" class="btn btn-primary">Add New</a>
			  </div>
		  </div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Title</th>
			<th>Icon</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>

			@foreach ($categories as $category)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $category->title !!}</td>
					<td><div id="coverImagePDP" style="height: 50px; width: 50px; background-image: url('{!! $category->icon_path !!}'); background-size: contain; background-repeat: no-repeat;"></div></td>
					<td>{!! $category->created_at !!}</td>
					<td class="text-center actions">
						<div class="btn-group">

							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.categoriestips.destroy', $category->id]]) !!}

								<a href="{!! route('admin.categoriestips.edit', $category->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip">Edit</a>
								<!-- button type="submit" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip">Delete</button -->
								@if ($category->getcanDeleteAttribute($category->id))
									@include('admin::partials.modal', ['data' => $category, 'name' => 'categoriestips'])
								@else
									<button type="button" disabled class="btn btn-sm btn-default disabled" title="You can't delete a category with Tips associated to it">Delete</button>
								@endif
								
							{!! Form::close() !!}

						</div>
					</td>
				</tr>
				<?php $no++; ?>
			@endforeach
		</tbody>
	</table>
	<div class="panel-footer">
		<div class="text-center">
			{!! $categories !!}
		</div>
	</div>
</div>
@stop