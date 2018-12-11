<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('template/images/icons/favicon.ico') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/css/main.css') }}">
    <!--===============================================================================================-->

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-form-title" style="background-image: url({{ asset('template/images/bg-01.jpg') }});">
                <span class="login100-form-title-1">
                    Test Todo
                </span>
            </div>

            <form class="login100-form validate-form ajax" action="{{ route('todo.store') }}" method="post">
                <div class="wrap-input100 m-b-26">
                    <span class="label-input100">Add Todo</span>
                    <input class="input100" type="text" name="todo" placeholder="Enter Todo" id="input_todo">
                    <span class="focus-input100"></span>
                </div>
                <div class="container-login100-form-btn" style="padding-bottom: 25px">
                    <button class="login100-form-btn">
                        Add Todo
                    </button>
                </div>

                <div class="row">
                    @foreach($items as $item)
                        <div class="flex-sb-m w-full p-b-30">
                            <div class="contact100-form-checkbox">
                                <input class="input-checkbox100 todo" id="todo-{{ $item->id }}" type="checkbox" value="{{ $item->id }}">
                                <label class="label-checkbox100" for="todo-{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="container-login100-form-btn" style="padding-bottom: 25px">
                    <a class="login100-form-btn" style="color: white;" id="remove-todo">
                        Remove Selected Todo
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!--===============================================================================================-->
<script src="{{ asset('template/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('template/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('template/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('template/js/main.js') }}"></script>

<script>
    $('form.ajax').on('submit', function(event){
        event.preventDefault();
        let formData = {
            _token : $('meta[name="csrf-token"]').attr('content'),
            todo   : $('input[name=todo]').val()
        };

        $.ajax({
            url    : $(this).attr('action'),
            method : "POST",
            data   : formData,
            type   : 'json',
            success: function (data) {
                $('.row').append(data);
                $('#input_todo').val('');
            }
        });

        return false;
    });

    $('#remove-todo').click(function () {
        let todos_id = $('.todo:checkbox:checked').map(function () {
            return this.value;
        }).get();

        if (typeof todos_id !== 'undefined' && todos_id.length > 0) {
            let formData = {
                _token  : $('meta[name="csrf-token"]').attr('content'),
                todos_id : todos_id
            };

            $.ajax({
                url    : '{{ route('todo.destroy') }}',
                method : "POST",
                data   : formData,
                type   : 'json',
                success: function (data) {
                    location.reload()
                }
            });
        }

        return false;
    });

</script>

</body>
</html>