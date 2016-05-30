@extends($layout)

@section('content-header')
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
@stop

@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>
					{!! user()->count() !!}
				</h3>

				<p>
					All Users
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-users"></i>
			</div>
			<a href="{!! route('admin.users.index') !!}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>
					{!! HepC\Models\Posts::all()->count() !!}
				</h3>

				<p>
					All Posts
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-book"></i>
			</div>
			<a href="{!! route('admin.posts.index') !!}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>
					{!! HepC\Models\Tips::all()->count() !!}
				</h3>

				<p>
					All Tips
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-flag"></i>
			</div>
			<a href="{!! route('admin.tips.index') !!}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>
					{!! HepC\Models\Challenges::all()->count() !!}
				</h3>

				<p>
					All Challenges
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
			<a href="{!! route('admin.challenges.index') !!}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
	<!-- Left col -->
	<section class="col-lg-7 connectedSortable">


		<!-- post List -->
		<div class="box box-primary">
		<div class="box-header">
				<i class="ion ion-clipboard"></i>

				<h3 class="box-title">Latest 10 Post</h3>


			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<ul class="todo-list">
					@foreach(HepC\Models\Posts::all()->sortByDesc('created_at')->slice(0, 10) as $post)
					<li>
						<!-- todo text -->
						<a href="{!! route('admin.posts.edit', $post->id) !!}" style="width:100%; display: list-item;">
						<span class="text">{!! $post->title !!}</span>
						<!-- Emphasis label -->
						@if($post->access == 1)
							<small class="label label-success">Access: Open Access</small>
						@elseif($post->access == 2)
							<small class="label label-danger">Access: Gated</small>
						@endif
						<!-- General tools such as edit or delete-->
						</a>
					</li>
					@endforeach
					
				</ul>
			</div>
		</div>
		<!-- /.box -->

	</section>
	<!-- /.Left col -->
	<!-- right col (We are only adding the ID to make the widgets sortable)-->
	<section class="col-lg-5 connectedSortable">

		<!-- Calendar -->
		<div class="box box-solid bg-green-gradient">
			<div class="box-header">
				<i class="fa fa-calendar"></i>

				<h3 class="box-title">Calendar</h3>
				<!-- tools box -->
				<div class="pull-right box-tools">
					<!-- button with a dropdown -->
					<div class="btn-group">
						<button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i
							class="fa fa-bars"></i></button>
							<ul class="dropdown-menu pull-right" role="menu">
								<li><a href="#">Add new event</a></li>
								<li><a href="#">Clear events</a></li>
								<li class="divider"></li>
								<li><a href="#">View calendar</a></li>
							</ul>
						</div>
						<button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
					</div>
					<!-- /. tools -->
				</div>
				<!-- /.box-header -->
				<div class="box-body no-padding">
					<!--The calendar -->
					<div id="calendar" style="width: 100%"></div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

		</section>
		<!-- right col -->
	</div>
	<!-- /.row (main row) -->

			@stop

@section('script')
	<script src="{!! admin_asset('components/raphael/raphael-min.js') !!}"></script>
	<script src="{!! admin_asset('adminlte/js/plugins/morris/morris.min.js') !!}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{!! admin_asset('adminlte/js/AdminLTE/dashboard.js') !!}" type="text/javascript"></script>

@stop
