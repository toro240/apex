@extends('layouts.app')

@section('content')
    @include('layouts.commonHeader')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Change Group') }}</div>
                    <div class="card-body">
                        @error('message')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror

                        <form method="POST" action="{{ route('group.doChange') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col">
                                    <select name="groupId" class="form-control">
                                        @foreach($groupMembers as $groupMember)
                                        <option value="{{ $groupMember->group_id }}" @if( session('group_id') == $groupMember->group_id ) selected @endif>
                                            {{ $groupMember->group->name }}
                                        </option>
                                        @endforeach
                                    </select>

                                    @error('group_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8">
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
