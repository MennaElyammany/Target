@extends('layouts.app')
@section('content')
<style>
.corner {
  border-radius: 25px;
  border: 2px solid grey;
  padding: 20px; 
  /* width: 200px;
  height: 150px;   */
  margin-top:70px;
  
}
.reciever{
    border-radius: 25px;
    border: 2px;
    padding: 20px; 
    margin:5px;
    background-color:#CAC1C1;
}
.sender{
    border-radius: 25px;
    border: 2px;
    padding: 20px; 
    margin:5px;
    background-color:#E3D9D9;
}
.input{
    border-radius: 25px ;
    border-color:grey;
    padding: 20px; 
    margin:5px;
}
</style>
<div class="row"style="margin-left:10px;">
    <div class="col-4 corner" >
    @foreach($conversations as $conv)
        <div  class="conv" id="{{$conv['reciever_id']}}" onclick="display(this.id,{{Auth::user()->id}})" style="margin:10px;border-radius:10px;border: 2px;padding:10px;background-color:grey;">
        <div style="display:flex;">
        <img src="{{$conv['reciever_avatar']}}"class="rounded-circle" style="width:60px;height:60px">
        <p style="margin:10px;">{{$conv['reciever_name']}}</p>
        </div>
        <p style="margin:5px;">{{$conv['content']}}</p>
        </div>
    @endforeach 
    </div>
    <div id="display"class="col-7 corner"style="margin-left:10px;">
    </div>
    <div id="sendMsg">
    <div>
</div>
@endsection
@section('scripts')
@csrf
<script>
function display(id,auth) {
  var display = document.getElementById("display");
  display.innerHTML = id;
  while (display.firstChild) {
        display.removeChild(display.firstChild);
            }
  var csrf=document.querySelector("input[name='_token']").getAttribute('value'); 
  $.ajax({
        type:'GET',
        url:'/messages/displayConversation/'+id,
        data:{
            '_token':csrf //pass CSRF
        },
        success:function(data){
            console.log("success");
            console.log(data);
            for(i = 0; i < data.length;i++){
            if(data[i]['reciever_id']==id){
                containerRec = document.createElement('div');
                containerRec.innerHTML = data[i]['content'];
                containerRec.classList.add("reciever");
                display.appendChild(containerRec);
            }
            else{
                containerSend = document.createElement('div');
                containerSend.innerHTML = data[i]['content'];
                containerSend.classList.add("sender");
                display.appendChild(containerSend);
            }
            }
            var input = document.createElement('input');
            input.setAttribute("type", "text");
            input.classList.add("input");
            display.appendChild(input);
            var sendBtn = document.createElement('button');
            sendBtn.classList.add("btn");
            sendBtn.classList.add("btn-primary");
            sendBtn.innerHTML = "Send";            
            display.appendChild(sendBtn);
            sendBtn.addEventListener('click',function(){
                var newMsg = document.createElement('div');
                newMsg.innerHTML = input.value;
                newMsg.classList.add("sender");
                display.insertBefore(newMsg,input);
                console.log("send clicked",input.value);
                $.ajax({
                    type:'POST',
                    url:'/messages/storeInfluencer/'+id+'/'+auth+'/'+input.value,
                    data:{
                    '_token':csrf //pass CSRF
                    },
                    success:function(data){
                        console.log("sucess",data);
                    },
                    error:function(){
                        console.log("error in btn send");
                    }
                    
                    });
            });
        },
        error:function(){
            console.log("error")
        }
        });
}
</script>
@endsection