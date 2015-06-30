@extends('main')

@section('content')
    <div id="chatContainer" style="position:absolute;bottom:0px;right:0px;margin-bottom: 0px;">
        <div id="chatTopBar" class="rounded"></div>
        <div id="chatLineHolder"></div>

        <div id="chatUsers" class="rounded"></div>
        <div id="chatBottomBar" class="rounded">
            <div class="tip"></div>

            <div class="form-group">
            {!! Form::open(['id' => 'loginForm']) !!}
                <div class="col-sm-9">
                {!! Form::input('text', 'name', null, ['id' => 'name', 'class' => 'rounded', 'maxlength' => '16']) !!}
                {!! Form::email('email', '', ['id' => 'email', 'class' => 'rounded']) !!}
                </div>
                {!! Form::submit('Login', ['class' => 'blueButton']) !!}
            {!! Form::close() !!}
            </div>
            {!! Form::open(['id' => 'submitForm']) !!}
                {!! Form::input('text', 'chatText', null, ['id' => 'chatText', 'class' => 'rounded', 'maxlength' => '255']) !!}
                {!! Form::submit('Submit', ['class' => 'blueButton']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            chat.init();
        });

        var chat = {
            // data contains the variables for use in the class
            data: {
                lastID      :   0,
                noActivity  :   0
            },

            // Init binds event listeners and sets up timers
            init: function() {
                // Using the defaultText jQuery plugin
                $('#name').defaultText('Nickname');
                $('#email').defaultText('Email (Gravatars are Enabled)');

                // Converting the #chatLineHolder dive into a jScrollPane and saving the plugin's API in chat.data
                chat.data.jspAPI = $('#chatLineHolder').jScrollPane({
                    verticalDragMinHeight:  12,
                    verticalDragMaxHeight:  12
                }).data('jsp');

                var working = false;

                $('#loginForm').submit(function() {
                    if(working) return false;
                    working = true;

                    $.tzPOST({{ route('login') }}, $(this).serialize(), function(r) {
                        working = false;

                        if(r.error) {
                            chat.displayError(r.error);
                        }
                        else chat.login(r.name, r.gravatar);
                    });

                    return false;
                });

                $('#submitForm').submit(function(){
                    var text = $('#chatText').val();

                    if(text.length == 0){
                        return false;
                    }

                    if(working) return false;
                    working = true;

                    var tempID = 't'+Math.round(Math.random()*1000000),
                            params = {

                            };
                });
            }
        }
    </script>
@stop
