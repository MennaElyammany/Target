@extends('layouts.app')
@section('content')
            <section class="mt-0">
            <div class="container-fluid">
            <div class="row" style="Packground-color:#f3f9fb;">
            <div class="col-lg-12">
            <div id="carousel" class="container">
                <div id="carouselContent" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner mt-3" role="listbox">
                        <div class="carousel-item active text-center p-4">
                        <h1  style="margin-top:100px; margin-bottom:30px;" class="text-center text">Find your influencers</h1>
            <p class="text-center text paragraph-size"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod. <br> Sociis natoque penatibus et magnis.</p>
                        </div>
                        <div class="carousel-item text-center p-4">
                        <h1  style="margin-top:100px; margin-bottom:30px;" class="text-center text">Find your influencers</h1>
            <p class="text-center text paragraph-size"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod. <br> Sociis natoque penatibus et magnis.</p>
                            
                        </div>
                        <div class="carousel-item text-center p-4">
                        <h1  style="margin-top:100px; margin-bottom:30px;" class="text-center text">Find your influencers</h1>
            <p class="text-center text paragraph-size"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod. <br> Sociis natoque penatibus et magnis.</p>
                            
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselContent" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselContent" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>


            <div><br><br><br></div> 
            </div>
            @guest
            <div class="mx-auto mb-5">
            <a class="btn text-light btn-lg mr-3" style="background-color:#112d4e;width:250px;" href="{{ route('register',['role'=>'Influencer']) }}">Register As Influencer</a>
            <a class="btn text-light  btn-lg" style="background-color:#F23C84;width:250px;" href="{{ route('register',['role'=>'Client']) }}">Register As Client</a>
</div>
            @endguest


            </div>

            </div>
            </div>
            </section>
        <div id="footer" class=" footer container-fluid p-5">
                <div class="row">
                                <div class="row">
                                                <div class=" col-lg-4">
                                                                <div class="ml-3 p">
                                                                                <h6 class="footer-target">Target</h6>
                                                                                <br><i class="fab fa-instagram"></i>



                                
                                                                </div>
                                                               
                                
                                                        </div>
                                                        <div class="col-lg-4">
                                                                <div>
                                                                                <h6>Contact Info</h6>
                                                                                <br>
                                                                                <p>Address: <br>Street Name, City , Country</p>   
                                                                                <p>Telephone: <br>+0983928378</p>
                                                                                <p>Email: <br>email@email.com</p>
                                
                                                                </div>
                                                                
                                
                                                        </div>
                                                        <div class="col-lg-4">
                                                                <div>
                                                                                <h6>Quick Links</h6>
                                                                                <br>
                                                                                <a class="text-dark mb-5" href="">About</a>
                                                                                <br>
                                                                                <a class="text-dark mb-5" href="">Terms of use</a>
                                                                                <br>
                                                                                <a class="text-dark mt-5" href="">Contacts</a>
                                
                                                                </div>
                                                               
                                                                  
                                                        </div>
        

                                </div>

                        </div>

                        </div>

                        

        

                </div>

        </div>
@endsection 
