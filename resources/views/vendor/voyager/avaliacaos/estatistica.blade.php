@extends('vendor.voyager.master')

@section('page_title', __('voyager::generic.viewing').' '.$dataType->getTranslatedAttribute('display_name_plural'))

@section('page_header')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ $dataType->getTranslatedAttribute('display_name_plural') }} das Unidades de Saúde e Hospitais
    </h1>
{{--    @can('add', app($dataType->model_name))--}}
{{--        <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-success btn-add-new">--}}
{{--            <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>--}}
{{--        </a>--}}
{{--    @endcan--}}
{{--    @can('delete', app($dataType->model_name))--}}
{{--        @include('voyager::partials.bulk-delete')--}}
{{--    @endcan--}}
{{--    @can('edit', app($dataType->model_name))--}}
{{--        @if(isset($dataType->order_column) && isset($dataType->order_display_column))--}}
{{--            <a href="{{ route('voyager.'.$dataType->slug.'.order') }}" class="btn btn-primary btn-add-new">--}}
{{--                <i class="voyager-list"></i> <span>{{ __('voyager::bread.order') }}</span>--}}
{{--            </a>--}}
{{--        @endif--}}
{{--    @endcan--}}
    @include('voyager::multilingual.language-selector')
</div>
@stop
@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                {!! $chart_ubs->container() !!}
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart_ubs->script() !!}
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i>{{ $dataType->getTranslatedAttribute('display_name_plural') }} dos Hospitais
        </h1>
    </div>
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                {!! $chart_hpt->container() !!}
            </div>
        </div>
    </div>
    {!! $chart_hpt->script() !!}


@stop


