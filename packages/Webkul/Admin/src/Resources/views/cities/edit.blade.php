@php
    $allLocales = app('Webkul\Core\Repositories\LocaleRepository')->all();
@endphp

@extends('admin::layouts.content')

@section('page_title')
    {{"Edit City"}}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.cities.update', $city->id) }}" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('cities.admin.index') }}'"></i>

                        {{"Edit City"}}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{"Save City"}}
                    </button>
                </div>
            </div>

            <div class="page-content">
                <div class="form-container">
                    @csrf()

                    <input name="_method" type="hidden" value="PUT">

                    {!! view_render_event('bagisto.admin.catalog.attribute.edit_form_accordian.general.before', ['city' => $city]) !!}

                    <accordian :title="'{{ __('admin::app.catalog.attributes.general') }}'" :active="true">
                        <div slot="body">
                            {!! view_render_event('bagisto.admin.catalog.attribute.edit_form_accordian.general.controls.before', ['city' => $city]) !!}

                            <div class="control-group">
                                <label for="name">{{"Name"}}</label>
                                <input type="text" class="control" id="name" name="name" value="{{ old('name') ?: $city->name }}"/>
                                
                            </div>

                            <div class="control-group">
                                @php
                                    $selectedOption = old('country') ?: $city->country_id;
                                @endphp

                                <label for="country">{{"Country"}}</label>

                                <select class="control" id="country" name="country">
                                    @foreach (core()->countries() as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>

                                {{-- <input type="hidden" name="type" value="{{ $attribute->type }}"/> --}}
                            </div>

                            {!! view_render_event('bagisto.admin.catalog.attribute.edit_form_accordian.general.controls.after', ['city' => $city]) !!}
                        </div>
                    </accordian>
@endsection