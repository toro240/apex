@extends('layouts.app')

@section('content')
    @include('layouts.commonHeader')
    <div class="container">
        @if(!$isJoinedGroup)
            <div class="container py-4">
                <div class="alert alert-warning" role="alert">
                    You're not join Group... Wait until invited or <a href="{{ route('group.create') }}" class="link-primary">Create Group</a>.
                </div>
            </div>
        @endif
        HOME
    </div>
@endsection
