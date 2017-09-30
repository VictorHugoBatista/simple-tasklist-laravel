@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @include('commons.errors')
                </div>
            </div>

            <form action="{{ url('task') }}" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name</label>
                    <div class="col-sm-6">
                        <input name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button class="btn btn-default">Add task</button>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    @if(0 < $tasks->count())
        <div class="panel panel-default">
            <div class="panel-heading">
                Current tasks
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                   <thead>
                        <tr>
                            <th>Name</th>
                            <th>&nbsp;</th>
                        </tr>
                   </thead>
                   <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->name }}</td>
                                <td>
                                    <form action="{{ url('task/' . $task->id) }}" method="post">
                                        <button class="btn btn-danger">Delete</button>
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                   </tbody>
               </table>
            </div>
        </div>
    @endif
@endsection
