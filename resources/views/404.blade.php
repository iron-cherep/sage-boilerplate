@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('К сожалению, вы пытаетесь зайти на страницу, которой не существует.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif
@endsection
