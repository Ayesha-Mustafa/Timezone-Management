@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Record</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('records.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="task_name">Task Name</label>
                            <input type="text" class="form-control" id="task_name" name="task_name" required>
                        </div>

                        <div class="form-group">
                            <label for="task_description">Task Description</label>
                            <textarea class="form-control" id="task_description" name="task_description" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        fetch('/user/timezone', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ timezone: timezone })
        });
    });
</script>
