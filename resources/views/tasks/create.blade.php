@php
    $jsPass = 'js/tasks/create.js';
@endphp
@extends('layouts.app')

@section('content')
    @include('layouts.commonHeader')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Task') }}</div>
                    <div class="card-body">
                        @error('message')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <form method="POST" action="{{ route('task.store') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>

                                <div class="col-md-6">
                                    <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required autocomplete="subject" autofocus>

                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="map" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>

                                <div class="col-md-6">
                                    <select id="map" name="map" class="form-control">
                                        <option value="">
                                            {{ __('---') }}
                                        </option>
                                        @foreach($maps as $key => $map)
                                        <option value="{{ $key }}">
                                            {{ $map }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('map')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="legend" class="col-md-4 col-form-label text-md-right">{{ __('Legend') }}</label>

                                <div class="col-md-6">
                                    <select id="legend" name="legend" class="form-control">
                                        <option value="">
                                            {{ __('---') }}
                                        </option>
                                        @foreach($legends as $key => $legend)
                                        <option value="{{ $key }}">
                                            {{ $legend }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('legend')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contents" class="col-md-4 col-form-label text-md-right">{{ __('Contents') }}</label>

                                <div class="col-md-6">
                                    <textarea id="contents" name="contents" class="form-control" rows="5" required></textarea>

                                    @error('contents')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="limited-at" class="col-md-4 col-form-label text-md-right">{{ __('Limited At') }}</label>

                                <div class="col-md-6">
                                    <input id="limited-at" type="text" class="form-control @error('limitedAt') is-invalid @enderror" name="limitedAt" value="{{ old('limitedAt') }}" autocomplete="limited-at" autofocus>

                                    @error('limitedAt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="target-user" class="col-md-4 col-form-label text-md-right">{{ __('Target User') }}</label>
                                <div class="col">
                                    @if(empty(app('request')->old('targetUser')))
                                    <div class="row multiple-form-field mb-3">
                                        <div class="col">
                                            <select id="target-user" name="targetUser" class="form-control">
                                                <option value="">
                                                    {{ __('---') }}
                                                </option>
                                                @foreach($targetUsers as $key => $targetUser)
                                                    <option value="{{ $key }}">
                                                        {{ $targetUser->user->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('targetUser.0')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-primary add-input-btn">＋</button>
                                            <button type="button" class="btn btn-danger remove-input-btn" disabled>ー</button>
                                        </div>
                                    </div>
                                    @else
                                    @foreach(app('request')->old('targetUser') as $i => $targetUser)
                                    <div class="row multiple-form-field mb-3">
                                        <div class="col">
                                            <select id="target-user" name="targetUser" class="form-control">
                                                <option value="">
                                                    {{ __('---') }}
                                                </option>
                                                @foreach($targetUsers as $key => $targetUser)
                                                    <option value="{{ $key }}">
                                                        {{ $targetUser->user->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('userName.' . $i)
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <button type="button" class="btn btn-primary add-input-btn">＋</button>
                                            <button type="button" class="btn btn-danger remove-input-btn" disabled>ー</button>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>

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
