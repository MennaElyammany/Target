@extends('layouts.app')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Twwets</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $tweet)
    <tr>
      
      <td>{{$tweet->text}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
@endsection