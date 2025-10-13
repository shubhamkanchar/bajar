@extends('layouts.home')

@section('content')
    <livewire:home.page :slug="$slug ?? null" />
@endsection


