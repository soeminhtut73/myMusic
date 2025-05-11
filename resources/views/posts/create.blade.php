@extends('adminlte::page')

@section('title', 'Create Post')

@section('content_header')
    <h1>Create Post</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image Upload --}}
                <div class="mb-3">
                    <label for="post_image" class="form-label">Post Image</label>
                    
                    <div class="input-group">
                        <div class="input-group-text"><i class="fas fa-image"></i></div>
                        <input type="file" name="post_image" id="post_image"
                            class="form-control-file @error('post_image') is-invalid @enderror"
                            required>

                        @error('post_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Submit Post
                </button>
            </form>
        </div>
    </div>
@endsection