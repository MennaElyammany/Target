@extends('layouts.app')
@section('content')

<br><br><br><br><br>

@foreach($media_url_list as $media_url_item)
<div> 
   <img src="{{$media_url_item->media_url}}" >
</div>
@endforeach