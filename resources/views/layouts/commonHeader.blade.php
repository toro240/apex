<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            TASKS
        </a>
        <div class="dropdown">
            <button id="group-menu" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                @if(isset($groupName))
                {{ $groupName }}
                @else
                {{ __('Group Menu') }}
                @endif
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="group-menu">
                @if(isset($groupName))
                <a class="dropdown-item" href="{{ route('group.change.index') }}">Change Group</a>
                @endif
                <a class="dropdown-item" href="{{ route('group.create') }}">Create Group</a>
                @if(isset($groupName))
                <a class="dropdown-item" href="{{ route('group.edit', ['id' => session('group_id')]) }}">Edit Group</a>
                @endif
            </div>
        </div>
    </div>
</nav>

