@extends('layouts.app')
@section('content')
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>
<h2>Chat Messages</h2>
<!-- <p>{{$sender}}</p>
<p>{{$reciever}}</p> -->
@foreach($messages as $msg)
    @if($msg->sender_id == Auth::user()->id)
    <div class="container">
    @php
    $avatar = findUserAvatar($msg->sender_id);
    @endphp
      <img src="{{$avatar}}" alt="Avatar" style="width:100%;">
      <p>{{$msg->content}}</p>
      <p>{{findUserName($msg->sender_id)}}</p>
    </div>
    @else
    @php
    $avatar = findUserAvatar($msg->sender_id);
    @endphp
    <div class="container darker">
    <img src="{{$avatar}}" alt="Avatar" class="right" style="width:100%;">
      <p>{{$msg->content}}</p>
      <p>{{findUserName($msg->reciever_id)}}</p>
    </div>
    @endif
@endforeach
<form method="POST" action="/messages" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <input type="text" class="form-control" name="content" placeholder="enter your message here">
</div>
<input type="hidden" name="senderId" value="{{$sender}}">
<input type="hidden" name="influencer" value="{{$reciever}}">
<button type="submit" class="btn btn-primary">Send</button>
<a href="/influencers" class="btn btn-primary">Back to all influencers</a>
</form>


@endsection