@extends('app')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    Profile User
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="text-center mb-4">
                        <img src="{{ auth()->user()->photo
                            ? asset('uploads/'.auth()->user()->photo)
                            : 'https://ui-avatars.com/api/?name='.auth()->user()->name }}"
                             class="rounded-circle"
                             width="120"
                             height="120"
                             style="object-fit:cover;">
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name"
                                   value="{{ auth()->user()->name }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email"
                                   value="{{ auth()->user()->email }}"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Foto Profil</label>
                            <input type="file" name="photo" class="form-control">
                        </div>

                        <button class="btn btn-primary btn-block">
                            Update Profile
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection
