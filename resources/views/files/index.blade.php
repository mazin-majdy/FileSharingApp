@extends('layouts.master')
@section('title', 'Home')
@section('content')

    <x-alert :msg="$msg" :type="$type" />
    @if (!$files->count())
        <p class="alert alert-warning">No Files</p>
    @endif

    <a href="{{ route('upload') }}" class="btn btn-outline-success mb-2">Upload <i class="fa-solid fa-plus"></i></a>
    <table class="table table-hover">
        <thead class="table-secondary">
            <tr>
                <td>File Name</td>
                <td>File Extension</td>
                <td>File Unique Identifier</td>
                <td>Uploaded At</td>
                <td>Number of downloads</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{ $file->name }}</td>
                    <td>{{ strtoupper(substr(strstr($file->path, '.'), 1)) }}</td>
                    <td>{{ $file->unique_identifier }}</td>
                    <td>{{ $file->created_at->diffForHumans() }}</td>
                    <td>{{ $file->total_downloads }}</td>
                    <td>
                        <a href="{{ route('files.download', $file->id) }}" class="btn btn-primary"><i
                                class="fa-solid fa-link"></i></a>
                        <button class="btn-delete btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        <form action="{{ route('files.delete', $file->id) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    {{ $files->withQueryString()->links() }}

@endsection


@push('scripts')
    <x-delete-btn />
@endpush
