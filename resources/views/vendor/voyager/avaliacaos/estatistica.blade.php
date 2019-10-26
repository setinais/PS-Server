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
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $chart->script() !!}
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="{{ $dataType->icon }}"></i> Usuarios que avaliaram
        </h1>
    </div>
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
{{--                {!! $chart->container() !!}--}}
            </div>
        </div>
    </div>
{{--    {!! $chart->script() !!}--}}
    <style>
        .estrelas input[type=radio] {
            display: none;
        }
        .estrelas label i.fa:before {
            content:'\f005';
            color: #FC0;
        }
        .estrelas input[type=radio]:checked ~ label i.fa:before {
            color: #CCC;
        }
        .estrelas>label:hover ~ label{
            color: #FC0;
        }

    </style>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <div class="estrelas">
        <input type="radio" id="cm_star-empty" name="fb" value="" checked/>
        <label for="cm_star-1"><i class="fa"></i></label>
        <input type="radio" id="cm_star-1" name="fb" value="1"/>
        <label for="cm_star-2"><i class="fa"></i></label>
        <input type="radio" id="cm_star-2" name="fb" value="2"/>
        <label for="cm_star-3"><i class="fa"></i></label>
        <input type="radio" id="cm_star-3" name="fb" value="3"/>
        <label for="cm_star-4"><i class="fa"></i></label>
        <input type="radio" id="cm_star-4" name="fb" value="4"/>
        <label for="cm_star-5"><i class="fa"></i></label>
        <input type="radio" id="cm_star-5" name="fb" value="5"/>
    </div>
@stop


