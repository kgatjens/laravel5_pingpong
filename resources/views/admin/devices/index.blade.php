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
		<h3 class="panel-title">{!! $title or 'All Devices' !!} ({!! $devices->count() !!})</h3>
	</div>

	<table class="table table-stripped table-bordered">
		<thead>
			<th class="text-center">#</th>
			<th>OneSignal ID</th>
			<th>Created At</th>
			<th>Updated At</th>
		</thead>
		<tbody>

			@foreach ($devices as $device)
				<tr>
					<td class="text-center">{!! $no !!}</td>
					<td>{!! $device->onesignal_id !!}</td>
					<td>{!! $device->created_at !!}</td>
					<td>{!! $device->updated_at !!}</td>
				</tr>
				<?php $no++; ?>
			@endforeach
		</tbody>
	</table>
	<div class="panel-footer">
		<div class="text-center">
			{!! $devices !!}
		</div>
	</div>
</div>
@stop