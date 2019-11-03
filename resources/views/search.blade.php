@extends('layouts.app')

@section('content')
    <algolia-search token="{{ config('scout.algolia.key') }}" identification="{{ config('scout.algolia.id') }}"></algolia-search>
@endsection