@inject('taskConstants', 'App\Models\Task')
@php
    $jsPass = 'js/home.js';
@endphp
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
                                    {{ $task->limited_at->format('Y-m-d') }}
                                </div>
                            </div>
                            <hr />
                            @endif

                            {{ $task->contents }}
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
        <div style="position: fixed; bottom: 60px; right: 30px;">
            <a href="{{ route('task.create') }}" class="btn btn-lg btn-danger rounded-circle" role="button" aria-pressed="true">
                {{ __('+') }}
            </a>
        </div>

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
