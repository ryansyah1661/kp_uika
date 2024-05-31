@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Donations</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Image</th>
                @if (Auth::user()->is_admin)
                    <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($donations as $donation)
                <tr>
                    <td>{{ $donation->id }}</td>
                    <td>{{ $donation->status }}</td>
                    <td><img src="{{ Storage::url('public/blogs/').$donation->image_path }}" width="100"></td>
                    @if (Auth::user()->is_admin)
                        <td>
                            @if ($donation->status == 'pending')
                                <form action="{{ route('donations.approve', $donation) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">Approve</button>
                                </form>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
