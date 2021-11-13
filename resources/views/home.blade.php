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
        <div style="position: fixed; bottom: 60px; right: 30px;">
            <a href="{{ route('task.create') }}" class="btn btn-lg btn-danger rounded-circle" role="button" aria-pressed="true">
                {{ __('+') }}
            </a>
        </div>
    </div>
@endsection
