@extends('layouts.master')
@section('title', 'Download Link')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Download Link') }}</div>

                    <div class="card-body">
                        <p>Share this link with others to allow them to download the file:</p>
                        <p><a href="{{ $downloadLink }}">{{ $downloadLink }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
