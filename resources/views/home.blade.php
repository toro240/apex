@inject('taskConstants', 'App\Models\Task')
@php
    $jsPass = 'js/home.js';
@endphp
@extends('layouts.app')

@section('content')
    @include('layouts.commonHeader')
    <div class="container" style="padding-bottom: 80px">
        @if(!is_null($taskSearchCriteria))
        <button style="position: sticky; top:10px; z-index: 1;" type="button" class="btn btn-primary btn-block mt-3" data-toggle="modal" data-target="#searchTaskModal">{{ __('Search Tasks') }}</button>
        @endif
        @if(!$isJoinedGroup)
            <div class="container py-4">
                <div class="alert alert-warning" role="alert">
                    You're not join Group... Wait until invited or <a href="{{ route('group.create') }}" class="link-primary">Create Group</a>.
                </div>
            </div>
        @endif
        <div id="tasks" class="row">
            @foreach($tasks as $i => $task)
            <div class="col-sm-4 accordion mt-3" id="{{ __('task' . $task->id) }}">
                <div class="card @if($task->isLimitOver) border-danger @endif">
                    <div id="{{ __('heading' . $i) }}" class="card-header">
                        <h5 class="card-title @if($task->isLimitOver) text-danger @endif">{{ $task->subject }}</h5>
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="{{ __('#collapse' . $i) }}" aria-controls="{{ __('#collapse' . $i) }}">
                            Show Detail!
                        </button>
                    </div>
                    <div id="{{ __('collapse' . $i) }}" class="collapse" aria-labelledby="{{ __('heading' . $i) }}" data-parent="{{ __('#task' . $task->id) }}">
                        <div class="card-body">

                            @if(!is_null($task->map))
                            <div class="row">
                                <div class="col-md-4">
                                    Map
                                </div>
                                <div class="col-md-6">
                                    {{ $taskConstants::MAP[$task->map] }}
                                </div>
                            </div>
                            <hr />
                            @endif

                            @if(!is_null($task->legend))
                            <div class="row">
                                <div class="col-md-4">
                                    Legend
                                </div>
                                <div class="col-md-6">
                                    {{ $taskConstants::LEGEND[$task->legend] }}
                                </div>
                            </div>
                            <hr />
                            @endif

                            @if(!is_null($task->limited_at))
                            <div class="row @if($task->isLimitOver) text-danger @endif">
                                <div class="col-md-4">
                                    Limited At
                                </div>
                                <div class="col-md-6">
                                    {{ $task->limited_at->isoFormat('YYYY年MM月DD日(ddd)') }}
                                </div>
                            </div>
                            <hr />
                            @endif

                            {!! nl2br(e($task->contents)) !!}
                            <hr />
                            <div class="row">
                                <div class="col d-flex justify-content-start">
                                    <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-primary">Edit</a>
                                </div>

                                <div class="col d-flex justify-content-end">
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#taskRemoveModal"
                                            data-task-subject="{{ $task->subject }}"
                                            data-is-me-target="{{ $task->isMeTarget }}"
                                            data-is-another-target="{{ $task->isAnotherTarget }}"
                                            data-remove-me-action="{{ route('task.removeMe', ['id' => $task->id]) }}"
                                            data-remove-action="{{ route('task.destroy', ['id' => $task->id]) }}"
                                    >
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>

        <div style="position: fixed; bottom: 30px; right: 30px;">
            <a href="{{ route('task.create') }}" class="btn btn-lg btn-danger rounded-circle" role="button" aria-pressed="true">
                {{ __('+') }}
            </a>
        </div>

        @if(!is_null($taskSearchCriteria))
        <div class="modal fade" id="searchTaskModal" tabindex="-1" aria-labelledby="searchTaskModal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <form id="remove-form" method="GET" action="{{ route('home') }}">
                        @csrf
                        <input type="hidden" name="isSearched" value="1">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Search Tasks') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="task-modal-body" class="modal-body">
                            <div class="form-group row">
                                <label for="modal-subject" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>

                                <div class="col-md-6">
                                    <input id="modal-subject" name="subject" type="text" class="form-control" autocomplete="modal-subject" autofocus value="{{ $taskSearchCriteria->getSubject() }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="modal-map" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>


                                <div class="col-md-6">
                                    @foreach($taskConstants::MAP as $i => $map)
                                        <div class="form-check form-check-inline">
                                            <input id="{{ __('modal-map' . $i) }}" type="checkbox" class="form-check-input" name="map[]" value="{{ $i }}" @if(in_array($i, $taskSearchCriteria->getMaps())) checked @endif>
                                            <label class="form-check-label" for="{{ __('modal-map' . $i) }}">{{ $map }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="modal-legend" class="col-md-4 col-form-label text-md-right">{{ __('Legend') }}</label>


                                <div class="col-md-6">
                                    @foreach($taskConstants::LEGEND as $i => $legend)
                                        <div class="form-check form-check-inline">
                                            <input id="{{ __('modal-legend' . $i) }}" type="checkbox" class="form-check-input" name="legend[]" value="{{ $i }}" @if(in_array($i, $taskSearchCriteria->getLegends())) checked @endif>
                                            <label class="form-check-label" for="{{ __('modal-legend' . $i) }}">{{ $legend }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="modal-contents" class="col-md-4 col-form-label text-md-right">{{ __('Contents') }}</label>

                                <div class="col-md-6">
                                    <input id="modal-contents" type="text" class="form-control" autocomplete="modal-contents" autofocus name="contents" value="{{ $taskSearchCriteria->getContents() }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="modal-limited-at" class="col-md-4 col-form-label text-md-right">{{ __('Limited At') }}</label>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col">
                                            <input id="modal-limited-at-from" type="text" class="form-control" placeholder="2021-01-01(From)" autocomplete="modal-limited-at" name="limitedAtFrom" autofocus value="{{ $taskSearchCriteria->getLimitedAtFrom() }}">
                                        </div>

                                        <div class="col">
                                            <input id="modal-limited-at-to" type="text" class="form-control" placeholder="2021-01-01(To)" autocomplete="modal-limited-at" name="limitedAtTo" autofocus value="{{ $taskSearchCriteria->getLimitedAtTo() }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="modal-member" class="col-md-4 col-form-label text-md-right">{{ __('Target User') }}</label>

                                <div class="col-md-6">
                                    @foreach($targetUsers as $i => $targetUser)
                                        <div class="form-check form-check-inline">
                                            <input id="{{ __('modal-member' . $i) }}" type="checkbox" class="form-check-input" name="targetUser[]" value="{{ $targetUser->user->id }}" @if(in_array($targetUser->user->id, $taskSearchCriteria->getTargetUsers())) checked @endif>
                                            <label class="form-check-label" for="{{ __('modal-member' . $i) }}">{{ $targetUser->user->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="modal-sort" class="col-md-4 col-form-label text-md-right">{{ __('Sort') }}</label>

                                <div class="col-md-6">
                                    <select id="modal-sort" class="form-control" name="sort">
                                        @foreach($taskConstants::SORT as $key => $sort)
                                            <option value="{{ $key }}" @if($taskSearchCriteria->getSort() == $key) selected @endif>
                                                {{ $sort['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col d-flex justify-content-end">
                                <button id="search-tasks" type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        <div class="modal fade" id="taskRemoveModal" tabindex="-1" aria-labelledby="taskRemoveModal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="task-modal-title" class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="task-modal-body" class="modal-body"></div>
                    <div class="modal-footer">
                        <div class="col d-flex justify-content-start">
                            <form id="remove-me-form" method="POST" action="">
                                @csrf
                                <button id="task-remove-me" type="submit" class="btn btn-success mr-1">
                                    {{ __('RemoveMe') }}
                                </button>
                            </form>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <form id="remove-form" method="POST" action="">
                                @csrf
                                <button id="task-remove" type="submit" class="btn btn-danger">
                                    {{ __('Remove') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
