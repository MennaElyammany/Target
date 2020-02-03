@extends('layouts.app')
@section('content')

<br><br><br><br><br>

@foreach($media_url_list as $media_url_item)
<div> 
   <img src="{{$media_url_item->media_url}}" width="200px" class="mb-3 ml-5" >
</div>
@endforeach