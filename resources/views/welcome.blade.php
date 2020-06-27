<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>

<script>
    getContent('/api/users/');

    $("body").on('click', '.page-link', function () {
        getContent('/api/users?page=' + $(this).text());
    });

    $("body").on('click', '.delete-row', function () {
        deleteRow($(this).data('url'));
        getContent('/api/users/');
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
                '<td>' + obj.user_id + '</td>\n' +
                '<td>' + obj.first_name + '</td>\n' +
                '<td>' + obj.last_name + '</td>\n' +
                '<td>' + obj.email + '</td>\n' +
                '<td>' + obj.created_at + '</td>\n' +
                '<td>\n' +
                '<button type="button" class="btn btn-warning">Show</button>\n' +
                '<button type="button" class="btn btn-info">Edit</button>\n' +
                '<button type="button" class="btn btn-danger delete-row"  data-url="/api/users/' + obj.user_id + '">Delete</button>\n' +
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
    <h2>Users list</h2>
    <p>Table users</p>
    <div id="alert-message" style="display: none" class="alert"></div>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="task-list">
        </tbody>
    </table>
    <ul class="pagination" id="task-pagination">
        {{--        <li class="page-item"><a class="page-link" href="#">1</a></li>--}}
        {{--        <li class="page-item active"><a class="page-link" href="#">2</a></li>--}}
        {{--        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
    </ul>
    {{--    <table class="table">--}}
    {{--        <thead class="thead-light">--}}
    {{--        <tr>--}}
    {{--            <th>Firstname</th>--}}
    {{--            <th>Lastname</th>--}}
    {{--            <th>Email</th>--}}
    {{--        </tr>--}}
    {{--        </thead>--}}
    {{--        <tbody>--}}
    {{--        <tr>--}}
    {{--            <td>John</td>--}}
    {{--            <td>Doe</td>--}}
    {{--            <td>john@example.com</td>--}}
    {{--        </tr>--}}
    {{--        <tr>--}}
    {{--            <td>Mary</td>--}}
    {{--            <td>Moe</td>--}}
    {{--            <td>mary@example.com</td>--}}
    {{--        </tr>--}}
    {{--        <tr>--}}
    {{--            <td>July</td>--}}
    {{--            <td>Dooley</td>--}}
    {{--            <td>july@example.com</td>--}}
    {{--        </tr>--}}
    {{--        </tbody>--}}
    {{--    </table>--}}
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
</body>
</html>
