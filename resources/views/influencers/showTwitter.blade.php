@extends('layouts.app')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Tweets</th>
    </tr>
  </thead>
  <tbody>
  @foreach($tweets as $tweet)
    <tr>
      
      <td>{{$tweet}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
@endsection