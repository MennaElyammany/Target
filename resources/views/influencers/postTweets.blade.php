@extends('layouts.app')
@section('content')
<!-- <p>hiii</p> -->
<form method="POST" action="/sendTweet" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <input type="text" class="form-control" name="status" placeholder="enter your tweet here :)">
</div>
<button type="submit" class="btn btn-primary">Send</button>
<a href="/influencers" class="btn btn-primary">Back to all influencers</a>
</form>
@endsection