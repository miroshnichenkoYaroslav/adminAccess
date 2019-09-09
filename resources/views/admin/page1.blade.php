@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-justify">
            Page 1
        </h1>
        @component('components.linkToAdmin', ['url' => '/admin', 'linkName' => 'Go To Admin'])
        @endcomponent
    </div>
@endsection
