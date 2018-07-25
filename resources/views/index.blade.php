{{-- layout --}}
@extends('layouts.default')

{{-- Additional Css --}}
@section('additionalCss')
@endsection

{{-- Additional JavaScript --}}
@section('additionalJs')
@endsection

{{-- titleSuffix --}}
@section('titleSuffix', 'index')

{{-- Content --}}
@section('content')
    <div class="container">
        <div id="app"></div>
    </div>
@endsection