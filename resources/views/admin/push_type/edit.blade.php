@extends('admin::layouts.master')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Push Type
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.push_type.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('admin.push_type.form', ['model' => $push_type])
        </div>
    </div>

@stop