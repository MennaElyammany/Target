@extends('layouts.app')
@section('content')

<br><br><br><br><br>
<div class="row mx-2">
@foreach($media_url_list as $media_url)
<div class="col-3 img-fluid mb-4"> 
<a href="{{$media_url}}">
   <img src="{{$media_url}}" class="img-fluid w-100"  class="mb-3 ml-5" >
</a>
</div>
@endforeach
</div>