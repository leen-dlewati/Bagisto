{{-- <h1> hi </h1> --}}

@extends('admin::layouts.content')

@section('page_title')
    {{"Add City"}}
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.cities.store') }}" @submit.prevent="onSubmit" enctype="multipart/form-data">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="window.location = '{{ route('cities.admin.index') }}'"></i>

                        {{"Add City"}}
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

                    {!! view_render_event('bagisto.admin.catalog.attribute.create_form_accordian.general.before') !!}

                    <accordian :title="'{{ __('admin::app.catalog.attributes.general') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.attribute.create_form_accordian.general.controls.before') !!}

                            <div class="control-group" :class="[errors.has('code') ? 'has-error' : '']">
                                <label for="name" class="required">{{"Name"}}</label>
                                <input type="text" v-validate="'required'" class="control" id="name" name="name" value="{{ old('name') }}"  data-vv-as="&quot;{{ __('admin::app.catalog.attributes.code') }}&quot;" v-code/>
                                <span class="control-error" v-if="errors.has('code')">@{{ errors.first('code') }}</span>
                            </div>

                            <div class="control-group">
                                <label for="type" class="required">{{"Country"}}</label>
                                <select class="control" id="country" name="country">
                                    @foreach (core()->countries() as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {!! view_render_event('bagisto.admin.catalog.attribute.create_form_accordian.general.controls.after') !!}

                        </div>
                    </accordian>

                    


                </div>
            </div>

        </form>
    </div>
@stop


{{-- @push('scripts')
    <script type="text/x-template" id="options-template">
        <div>

            <div class="control-group" v-if="show_swatch">
                <label for="swatch_type">{{ __('admin::app.catalog.attributes.swatch_type') }}</label>
                <select class="control" id="swatch_type" name="swatch_type" v-model="swatch_type">
                    <option value="dropdown">
                        {{ __('admin::app.catalog.attributes.dropdown') }}
                    </option>

                    <option value="color">
                        {{ __('admin::app.catalog.attributes.color-swatch') }}
                    </option>

                    <option value="image">
                        {{ __('admin::app.catalog.attributes.image-swatch') }}
                    </option>

                    <option value="text">
                        {{ __('admin::app.catalog.attributes.text-swatch') }}
                    </option>
                </select>
            </div>

            <div class="control-group">
                <span class="checkbox">
                    <input type="checkbox" class="control" id="default-null-option" name="default-null-option" v-model="isNullOptionChecked" >

                    <label class="checkbox-view" for="default-null-option"></label>
                    {{ __('admin::app.catalog.attributes.default_null_option') }}
                </span>
            </div>

            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th v-if="show_swatch && (swatch_type == 'color' || swatch_type == 'image')">{{ __('admin::app.catalog.attributes.swatch') }}</th>

                            <th>{{ __('admin::app.catalog.attributes.admin_name') }}</th>

                            @foreach (app('Webkul\Core\Repositories\LocaleRepository')->all() as $locale)

                                <th>{{ $locale->name . ' (' . $locale->code . ')' }}</th>

                            @endforeach

                            <th>{{ __('admin::app.catalog.attributes.position') }}</th>

                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="row in optionRows">
                            <td v-if="show_swatch && swatch_type == 'color'">
                                <swatch-picker :input-name="'options[' + row.id + '][swatch_value]'" :color="row.swatch_value" colors="text-advanced" show-fallback />
                            </td>

                            <td v-if="show_swatch && swatch_type == 'image'">
                                <div class="control-group" :class="[errors.has('options[' + row.id + '][swatch_value]') ? 'has-error' : '']">
                                    <input type="file" v-validate="'size:600'" accept="image/*" :name="'options[' + row.id + '][swatch_value]'"/>
                                    <span class="control-error" v-if="errors.has('options[' + row.id + '][swatch_value]')">The image size must be less than 600 KB</span>
                                </div>
                            </td>

                            <td>
                                <div class="control-group" :class="[errors.has(adminName(row)) ? 'has-error' : '']">
                                    <input type="text" v-validate="'required'" v-model="row['admin_name']" :name="adminName(row)" class="control" data-vv-as="&quot;{{ __('admin::app.catalog.attributes.admin_name') }}&quot;"/>
                                    <span class="control-error" v-if="errors.has(adminName(row))">@{{ errors.first(adminName(row)) }}</span>
                                </div>
                            </td>

                            @foreach (app('Webkul\Core\Repositories\LocaleRepository')->all() as $locale)
                                <td>
                                    <div class="control-group" :class="[errors.has(localeInputName(row, '{{ $locale->code }}')) ? 'has-error' : '']">
                                        <input type="text" v-validate="getOptionValidation(row, '{{ $locale->code }}')"  v-model="row['locales']['{{ $locale->code }}']" :name="localeInputName(row, '{{ $locale->code }}')" class="control" data-vv-as="&quot;{{ $locale->name . ' (' . $locale->code . ')' }}&quot;"/>
                                        <span class="control-error" v-if="errors.has(localeInputName(row, '{{ $locale->code }}'))">@{{ errors.first(localeInputName(row, '{!! $locale->code !!}')) }}</span>
                                    </div>
                                </td>
                            @endforeach

                            <td>
                                <div class="control-group" :class="[errors.has(sortOrderName(row)) ? 'has-error' : '']">
                                    <input type="text" v-validate="'required|numeric'" :name="sortOrderName(row)" class="control" data-vv-as="&quot;{{ __('admin::app.catalog.attributes.position') }}&quot;"/>
                                    <span class="control-error" v-if="errors.has(sortOrderName(row))">@{{ errors.first(sortOrderName(row)) }}</span>
                                </div>
                            </td>

                            <td class="actions">
                                <i class="icon trash-icon" @click="removeRow(row)"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="button" class="btn btn-lg btn-primary mt-20" id="add-option-btn" @click="addOptionRow(false)">
                {{ __('admin::app.catalog.attributes.add-option-btn-title') }}
            </button>
        </div>
    </script>

    <script>
        $(document).ready(function () {
            $('#type').on('change', function (e) {
                if (['select', 'multiselect', 'checkbox'].indexOf($(e.target).val()) === -1) {
                    $('#options').parent().addClass('hide')
                } else {
                    $('#options').parent().removeClass('hide')
                }
            })
        });


        Vue.component('option-wrapper', {

            template: '#options-template',

            inject: ['$validator'],

            data: function() {
                return {
                    optionRowCount: 1,
                    optionRows: [],
                    show_swatch: false,
                    swatch_type: '',
                    isNullOptionChecked: false,
                    idNullOption: null
                }
            },

            created: function () {
                var this_this = this;

                $(document).ready(function () {
                    $('#type').on('change', function (e) {
                        if (['select'].indexOf($(e.target).val()) === -1) {
                            this_this.show_swatch = false;
                        } else {
                            this_this.show_swatch = true;
                        }
                    });
                });
            },

            methods: {
                addOptionRow: function (isNullOptionRow) {
                    const rowCount = this.optionRowCount++;
                    const id = 'option_' + rowCount;
                    let row = {'id': id, 'locales': {}};

                    @foreach (app('Webkul\Core\Repositories\LocaleRepository')->all() as $locale)
                        row['locales']['{{ $locale->code }}'] = '';
                    @endforeach

                    row['notRequired'] = '';

                    if (isNullOptionRow) {
                        this.idNullOption = id;
                        row['notRequired'] = true;
                    }

                    this.optionRows.push(row);
                },

                removeRow: function (row) {
                    if (row.id === this.idNullOption) {
                        this.idNullOption = null;
                        this.isNullOptionChecked = false;
                    }

                    const index = this.optionRows.indexOf(row);
                    Vue.delete(this.optionRows, index);
                },

                adminName: function (row) {
                    return 'options[' + row.id + '][admin_name]';
                },

                localeInputName: function (row, locale) {
                    return 'options[' + row.id + '][' + locale + '][label]';
                },

                sortOrderName: function (row) {
                    return 'options[' + row.id + '][sort_order]';
                },

                getOptionValidation: (row, localeCode) => {
                    if (row.notRequired === true) {
                        return '';
                    }

                    return ('{{ app()->getLocale() }}' === localeCode) ? 'required' : '';
                }
            },


            watch: {
                isNullOptionChecked: function (val) {
                    if (val) {
                        if (! this.idNullOption) {
                            this.addOptionRow(true);
                        }
                    } else if(this.idNullOption !== null && typeof this.idNullOption !== 'undefined') {
                        const row = this.optionRows.find(optionRow => optionRow.id === this.idNullOption);
                        this.removeRow(row);
                    }
                }
            }
        })
    </script>
@endpush --}}
