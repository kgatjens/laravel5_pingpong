@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Campaign
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('admin.campaigns.edit', $campaign->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('admin.campaigns.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $campaign->id !!}</td>
            </tr>

			<tr>
                <td><b>Title</b></td>
                <td>{!! $campaign->title !!}</td>
            </tr>			<tr>
                <td><b>Description</b></td>
                <td>{!! $campaign->description !!}</td>
            </tr>			<tr>
                <td><b>CoverImage</b></td>
                <td>{!! $campaign->coverImage !!}</td>
            </tr>			<tr>
                <td><b>SlideImage</b></td>
                <td>{!! $campaign->slideImage !!}</td>
            </tr>			<tr>
                <td><b>VideoURL</b></td>
                <td>{!! $campaign->videoURL !!}</td>
            </tr>			<tr>
                <td><b>Price</b></td>
                <td>{!! $campaign->price !!}</td>
            </tr>			<tr>
                <td><b>MetaDescription</b></td>
                <td>{!! $campaign->metaDescription !!}</td>
            </tr>			<tr>
                <td><b>OgTitle</b></td>
                <td>{!! $campaign->ogTitle !!}</td>
            </tr>			<tr>
                <td><b>OgSitename</b></td>
                <td>{!! $campaign->ogSitename !!}</td>
            </tr>			<tr>
                <td><b>OgDesciption</b></td>
                <td>{!! $campaign->ogDesciption !!}</td>
            </tr>			<tr>
                <td><b>OgImage</b></td>
                <td>{!! $campaign->ogImage !!}</td>
            </tr>			<tr>
                <td><b>OgType</b></td>
                <td>{!! $campaign->ogType !!}</td>
            </tr>			<tr>
                <td><b>TwCard</b></td>
                <td>{!! $campaign->twCard !!}</td>
            </tr>			<tr>
                <td><b>TwTitle</b></td>
                <td>{!! $campaign->twTitle !!}</td>
            </tr>			<tr>
                <td><b>TwSite</b></td>
                <td>{!! $campaign->twSite !!}</td>
            </tr>			<tr>
                <td><b>TwDescription</b></td>
                <td>{!! $campaign->twDescription !!}</td>
            </tr>			<tr>
                <td><b>TwCreator</b></td>
                <td>{!! $campaign->twCreator !!}</td>
            </tr>			<tr>
                <td><b>TwImage</b></td>
                <td>{!! $campaign->twImage !!}</td>
            </tr>			<tr>
                <td><b>Mkt_scripts</b></td>
                <td>{!! $campaign->mkt_scripts !!}</td>
            </tr>			<tr>
                <td><b>Campaign_status_id</b></td>
                <td>{!! $campaign->campaign_status_id !!}</td>
            </tr>			<tr>
                <td><b>Report_entity_id</b></td>
                <td>{!! $campaign->report_entity_id !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $campaign->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop