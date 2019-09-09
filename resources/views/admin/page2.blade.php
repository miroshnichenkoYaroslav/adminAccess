@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Page 2</h1>
        @component('components.linkToAdmin', ['url' => '/admin', 'linkName' => 'Go To Admin'])
        @endcomponent
    </div>
@endsection
