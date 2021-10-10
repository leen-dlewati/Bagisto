@extends('admin::layouts.content')

@section('page_title')
    {{"cities"}}
@stop

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1>{{"cities"}}</h1>
            </div>

            <div class="page-action">
                <a href="{{ route('admin.cities.create') }}" class="btn btn-lg btn-primary">
                    {{"Add City"}}
                </a>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.catalog.attributes.list.before') !!}

        <div class="page-content">
            {!! app('Webkul\Admin\DataGrids\CityDataGrid')->render() !!}
            
        </div>

        {!! view_render_event('bagisto.admin.catalog.attributes.list.after') !!}
    </div>
@stop
