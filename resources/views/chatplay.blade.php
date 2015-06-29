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