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
		<h3 class="panel-title">{!! $title or 'All Challenges' !!} ({!! $challenges->count() !!})</h3>
	</div>
	  <div class="panel-body">
		  <div class="btn-toolbar" role="toolbar" aria-label="...">
			  <div class="btn-group pull-right" role="group" aria-label="...">

				  <a href="{!! route('admin.challenges.create') !!}" class="btn btn-primary">Add New</a>
			  </div>
		  </div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Title</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>

			@foreach ($challenges as $challenge)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $challenge->title !!}</td>
					<td>{!! $challenge->created_at !!}</td>
					<td class="text-center actions">
						<div class="btn-group">

							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.challenges.destroy', $challenge->id]]) !!}

								<a href="{!! route('admin.challenges.edit', $challenge->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip">Edit</a>
								<!-- button type="submit" class="btn btn-sm btn-default" title="Delete" data-toggle="tooltip">Delete</button -->
								@include('admin::partials.modal', ['data' => $challenge, 'name' => 'challenges'])
								
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
			{!! $challenges !!}
		</div>
	</div>
</div>
@stop