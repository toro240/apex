@php
    $jsPass = 'js/groups/groupCreate.js';
@endphp
@extends('layouts.app')

@section('content')
    @include('layouts.commonHeader')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Group') }}</div>
                    <div class="card-body">
                        @error('message')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <form method="POST" action="{{ route('group.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if(empty(app('request')->old('userName')))
                                <div class="form-group row user-name">
                                    <label for="user-name" class="col-md-4 col-form-label text-md-right user-name-label">{{ __('Invite User Name') }}</label>

                                    <div class="col">
                                        <input type="text" class="input-user-name form-control @error('userName.0') is-invalid @enderror" name="userName[]" value="{{ old('userName.0') }}" autocomplete="user-name" autofocus>

                                        @error('userName.0')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-primary add-user-name-btn">＋</button>
                                    </div>
                                </div>
                            @else
                                @foreach(app('request')->old('userName') as $i => $userNames)
                                    <div class="form-group row user-name">
                                        <label for="user-name" class="col-md-4 col-form-label text-md-right user-name-label">
                                        @if ($loop->first)
                                            {{ __('Invite User Name') }}
                                        @endif
                                        </label>

                                        <div class="col">
                                            <input type="text" class="input-user-name form-control @error('userName.' . $i) is-invalid @enderror" name="userName[]" value="{{ old('userName.' . $i) }}" autocomplete="user-name" autofocus>

                                            @error('userName.' . $i)
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col">
                                            @if ($loop->first)
                                                <button type="button" class="btn btn-primary add-user-name-btn">＋</button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif



                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
