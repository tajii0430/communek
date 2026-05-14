@extends('layouts.barangay')

@php

<h2>Chat with Resident</h2>

<div class="chat-body">

    @foreach($messages as $message)

    <div class="message {{ $message->sender_id == auth()->id() ? 'mine' : 'support' }}">

        {{ $message->message }}

    </div>

    @endforeach

</div>

<form action="/send-message" method="POST">

    @csrf

    <input type="hidden" name="receiver_id" value="{{ $resident->id }}">

    <input type="text" name="message">

    <button type="submit">
        Send
    </button>

</form>

@endsection