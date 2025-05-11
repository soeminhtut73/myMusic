@extends('adminlte::page')

@section('title', 'All Posts')

@section('content_header')
    <h1>Posts</h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="align-middle text-center">#</th>
                        <th class="align-middle text-center">Image</th>
                        <th class="align-middle text-center">Post Title</th>
                        <th class="align-middle text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $index => $post)
                        <tr>
                            <td class="align-middle text-center">{{ $index + 1 }}</td>
                            <td class="align-middle text-center">
                                <img src="{{ asset('storage/' . $post->post_image) }}"
                                     alt="Post Image"
                                     class="img-thumbnail"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            </td>
                            <td class="align-middle text-center">{{ $post->title }}</td>
                            <td class="align-middle text-center">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No posts available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $posts->links() }}
            </div>

        </div>
    </div>
@endsection