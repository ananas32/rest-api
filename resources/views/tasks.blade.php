@extends('layouts.app')
@section('content')

<script>
    getContent('/api/tasks/');

    $("body").on('click', '.page-link', function () {
        getContent('/api/tasks?page=' + $(this).text());
    });

    $("body").on('click', '.delete-row', function () {
        deleteRow($(this).data('url'));
        getContent('/api/tasks/');
    });

    function getContent(url) {
        $.ajax({
            type: "GET",
            url: url,
            success: function (response) {
                var data = response.data;
                var html = renderTable(data);
                $('#task-list').html(html);
                var html = renderPagination(response.last_page, response.path, response.current_page);
                $('#task-pagination').html(html);
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    function renderTable(data) {
        var html = '';
        for (var item in data) {
            var obj = data[item];
            html = html + '<tr>\n' +
                '<td>' + obj.id + '</td>\n' +
                '<td>' + obj.user_id + '</td>\n' +
                '<td>' + obj.title + '</td>\n' +
                '<td>' + obj.status + '</td>\n' +
                '<td>' + obj.created_at + '</td>\n' +
                '<td>\n' +
                '<a href="/tasks/'+obj.id+'" type="button" class="btn btn-warning">Show</a>\n' +
                '<a href="/tasks/'+obj.id+'/edit" type="button" class="btn btn-info">Edit</a>\n' +
                '<button type="button" class="btn btn-danger delete-row"  data-url="/api/tasks/' + obj.id + '">Delete</button>\n' +
                '</td>\n' +
                '</tr>';
        }
        return html;
    }

    function renderPagination(lastPage, path, currentPage) {
        var html = '';
        for (var i = 1; i <= lastPage; i++) {
            var activeClass = '';
            if (i === currentPage) {
                activeClass = 'active';
            }
            html = html + '<li class="page-item ' + activeClass + '"><a class="page-link" href="#">' + i + '</a></li>';
        }
        return html;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function deleteRow(url) {
        $.ajax({
            type: "DELETE",
            url: url,
            success: function (response) {
                alert(response.status, response.message, 3000);
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    function alert(status, message, time) {
        $('#alert-message').addClass('alert-'+status).text(message).show();
        setTimeout(
            function () {
                $('#alert-message').removeClass('alert-'+status).text('').hide();
            }, time
        );
    }

    function editRow() {

    }

    function showRow() {

    }
</script>

<div class="container">
    <h2>Tasks list</h2>
    <a href="/tasks/create" type="button" class="btn btn-success">Create Task</a>
    <p>Table tasks</p>
    <div id="alert-message" style="display: none" class="alert"></div>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>User id</th>
            <th>Title</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="task-list">
        </tbody>
    </table>
    <ul class="pagination" id="task-pagination">
    </ul>
</div>

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

</div>
@endsection
