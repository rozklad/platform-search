@extends('layouts/default')

{{-- Page title --}}
@section('title')
    {{ trans('sanatorium/search::general.page.title') }} ::
    @parent
@stop

{{-- Page description --}}
@section('meta-description')
    @parent
@stop


{{-- Partial Assets --}}
@section('assets')
    @parent
@stop

{{-- Meta general --}}
@section('meta-general')

@stop


{{-- Inline Styles --}}
@section('styles')
    @parent

@stop

{{-- Inline Scripts --}}
@section('scripts')
    @parent
@stop


@section('page')

    <h1>{{ trans('sanatorium/search::general.page.title') }}</h1>
    <p class="lead">{{ trans('sanatorium/search::general.search_results', ['term' => request()->get(trans('sanatorium/shop::general.search.input'))]) }}</p>

    @hook('search.results')


@stop
