@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Current Tasks -->
        @if (count($activities) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    News Feed
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Time</th>
                            <th>Actor</th>
                            <th>Task</th>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ date('F j, Y, g:i a', strtotime($activity['time'])) }}</div>
                                    </td>
                                    <td class="table-text"><div>{{ $activity['actor'] }}</div></td>
                                    <td class="table-text"><div>{{ $activity['name'] }}</div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@stop

@push('javascript')
    <script>
        var stream = require('getstream');
        var client = stream.connect('pnxvxrvwvbs9', null, '35427');
        var user1 = client.feed('user', '1', '{{ $token }}');

        console.log(user1)

        function callback(data) {
            console.log(data);
        }
        function successCallback() {
            console.log('now listening to changes in realtime');
        }
        function failCallback(data) {
            alert('something went wrong, check the console logs');
            console.log(data);
        }

        user1.subscribe(callback).then(successCallback, failCallback);
    </script>
@endpush