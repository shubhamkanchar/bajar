@extends('layouts.home')

@section('content')
    <livewire:home.blog :slug="$slug ?? null" />
@endsection


