@extends('layouts.app')
@section('title', 'Contact me')
@section('pageTitle', 'Contact me')
@section('pageSubtitle', 'Have questions? I have answers!')
@section('background', 'contact-background')
@section('contact-link', 'active')

@section('contact')
    <div class="contactCont">
        <div class="wrapper">
            <form action="">
                <input type="text" name="name" placeholder="Name">
                <input type="email" name="email" placeholder="Email address">
                <input type="tel" name="phone" placeholder="Phone number">
                <textarea name="message" cols="30" rows="7" placeholder="Message"></textarea>
                <button type="submit">send</button>
            </form>
        </div>
    </div>
@endsection