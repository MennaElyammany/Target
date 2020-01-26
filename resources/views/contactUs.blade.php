@extends('layouts.app')
@section('content')
            <div class="container">
    <h1> Leave Us a Message</h1>
    <div class="progress" style="height: 1px;">
            <div class="progress-bar " role="progressbar" style="width: 25%; background-color:#d8b5b5;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          </div>
          <br>
          <div class="container">
              <form name="contact_us" id="contact_us" >
                      <div class="form-group form-row">
                            <div class="col">
                                    <label for="Name">Name*</label>
                                    <input type="text"  minlength=5 class="form-control rounded-pill" id="Name" name="Name"required>
                            </div>
                            <div class="col">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control  rounded-pill" name="email"id="email" required> 
                            </div>
                    </div>
                    <div class="form-group">
                    <label for="subject">Subject*</label>
                    <input type="text" class="form-control rounded-pill" id="subject" name="subject" required>
                  </div>
                  <div class="form-group">
                        <label for="message">Message*</label>
                        <textarea class="form-control rounded" id="message" rows="5" name="message" required></textarea>
                      </div>
                      <button type="submit" style="background-color:#d8b5b5;" class="btn rounded-pill">send message</button>
              </form>
          </div>
          <div class="alert alert-success" role="alert" style="display: none;" id="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p id="thanksP"></p>
                <hr>
                <p class="mb-0">Menna Osama-Mohamed Ibrahim</p>
              </div>
          <script src="../javaScript/contact_us.js"></script>
@endsection