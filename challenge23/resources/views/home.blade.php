@extends('layouts.app')
@section('title', 'Blog')
@section('pageTitle', 'Clean Blog')
@section('pageSubtitle', 'A Blog Theme By Start Bootstrap')
@section('background', 'blog-background')
@section('home-link', 'active')

@section('home')
    <div class="homeCont">
        <div class="wrapper">
            <div class="homeBox">
                <h2>Lorem Ipsum</h2>
                <p>Cillum laborum tempor laborum non dolore duis ipsum fugiat consectetur reprehenderit ipsum ipsum ex.</p>
                <p class="postedBy">Posted by <span>John Doe</span></p>
            </div>
            <div class="homeBox">
                <h2>Lorem Ipsum 2</h2>
                <p>Cillum laborum tempor laborum non dolore duis ipsum fugiat consectetur reprehenderit ipsum ipsum ex.</p>
                <p class="postedBy">Posted by <span>John Doe</span> in another boring news</p>
            </div>
            <div class="homeBox">
                <h2>Lorem Ipsum 3</h2>
                <p>Veniam amet ad laborum excepteur ullamco consequat in adipisicing Lorem cillum excepteur. Commodo labore non sit ullamco minim dolore velit irure incididunt quis exercitation anim dolore non. Ut ex nostrud nostrud irure. Dolor ea sint mollit nisi excepteur laboris mollit ut occaecat excepteur Lorem.</p>
                <p class="postedBy">Posted by <span>Jane Doe</span></p>
            </div>
            <div class="homeBox">
                <h2>Lorem Ipsum 4</h2>
                <p>Mollit aute dolore proident consectetur exercitation ex.</p>
                <p class="postedBy">Posted by <span>Missy Doe</span></p>
            </div>
            <div class="btnCont">
                <button>Older posts -></button>
            </div>
        </div>
    </div>
@endsection