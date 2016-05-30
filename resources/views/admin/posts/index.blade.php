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
		<h3 class="panel-title">{!! $title or 'All Posts' !!} ({!! $posts->count() !!})</h3>
	</div>
	  <div class="panel-body">
		  <div class="btn-toolbar" role="toolbar" aria-label="...">
			  <div class="btn-group pull-right" role="group" aria-label="...">

				  <a href="{!! route('admin.posts.create') !!}" class="btn btn-primary">Add New</a>
			  </div>
		  </div>
	</div>
	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>Title</th>
			<th>Subtitle</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>

			@foreach ($posts as $post)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $post->title !!}</td>
					<td>{!! $post->subtitle !!}</td>
					<td>{!! $post->created_at !!}</td>
					<td class="text-center actions">
						<div class="btn-group">

							{!! Form::open(['method' => 'DELETE', 'route' => ['admin.posts.destroy', $post->id]]) !!}

								<a href="{!! route('admin.posts.edit', $post->id) !!}" class="btn btn-sm btn-default" title="Edit" data-toggle="tooltip">Edit</a>
								@include('admin::partials.modal', ['data' => $post, 'name' => 'posts'])
								
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
			{!! $posts !!}
		</div>
	</div>
</div>
@stop