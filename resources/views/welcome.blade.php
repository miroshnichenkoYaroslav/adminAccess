@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-center">
            @if (Route::has('login'))
                <div class="links">
                    @auth
                        @component('components.linkToAdmin', ['url' => route('admin'), 'linkName' => 'Admin Cabinet'])
                        @endcomponent
                    @else
                        <h1>
                            Please login
                        </h1>
                    @endauth
                </div>
            @endif
        </div>
    </div>
@endsection
