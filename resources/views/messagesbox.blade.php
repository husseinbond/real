<!-- resources/views/chat.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chats</div>

                <div class="panel-body">
                   
                </div>
                <div class="panel-footer">
        <chat-form :from="{{Auth::user()->id}}"  :to="{{$id}}"></chat-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection