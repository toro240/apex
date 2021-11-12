<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="dropdown">
            <button id="group-menu" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                @if(isset($groupName))
                {{ $groupName }}
                @else
                {{ __('Group Menu') }}
                @endif
            </button>
            <div class="dropdown-menu" aria-labelledby="group-menu">
                <a class="dropdown-item" href="{{ route('group.change') }}">Change Group</a>
                <a class="dropdown-item" href="#">Create Group</a>
                @if(isset($groupName))
                <a class="dropdown-item" href="#">Edit Group</a>
                @endif
            </div>
        </div>
    </div>
</nav>

