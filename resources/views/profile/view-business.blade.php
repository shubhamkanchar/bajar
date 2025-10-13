@extends('layouts.profile-layout')

@section('content')
    <livewire:user.view-business-profile :uuid="$uuid" />
@endsection


