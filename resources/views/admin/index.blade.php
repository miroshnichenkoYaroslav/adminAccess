@extends('layouts.admin')

@section('content')
    <div class="container">
        @component('components.linkToAdmin', ['url' => '/page1', 'linkName' => 'Go To Page1'])
        @endcomponent
        @component('components.linkToAdmin', ['url' => '/page2', 'linkName' => 'Go To Page2'])
        @endcomponent
        <users-table-component></users-table-component>
    </div>
@endsection

@push('scripts')
    <script>
    </script>
@endpush
