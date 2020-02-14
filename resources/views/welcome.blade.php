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
                                <h1 style="margin-top:100px; margin-bottom:30px;" class="text-center text">TARGET TAKES
                                    IT TO THE NEXT LEVEL</h1>
                                <p class="text-center text paragraph-size"> Increase your revenues with influencer
                                    marketing. <br>With Target you save time and maximize impact by finding the right
                                    influencer</p>
                            </div>
                            <div class="carousel-item text-center p-4">
                                <h1 style="margin-top:100px; margin-bottom:30px;" class="text-center text">FIND YOUR
                                    INFLUENCERS</h1>
                                <p class="text-center text paragraph-size"> Set up fully customised influencer marketing
                                    campaigns using our advanced targeting tools and market expertise </p>

                            </div>
                            <div class="carousel-item text-center p-4">
                                <h1 style="margin-top:100px; margin-bottom:30px;" class="text-center text">FREE
                                    SUBSCRIPTION</h1>
                                <p class="text-center text paragraph-size"> ONLY PAY FOR THE CONTENT YOU
                                    LOVE.<br>ON-DEMAND.</p>

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
                <a class="btn text-light btn-lg mr-3" style="background-color:#112d4e;width:250px;"
                    href="{{ route('register',['role'=>'Influencer']) }}">Register As Influencer</a>
                <a class="btn text-light  btn-lg" style="background-color:#F23C84;width:250px;"
                    href="{{ route('register',['role'=>'Client']) }}">Register As Client</a>
            </div>
            @endguest


        </div>

    </div>
    </div>
</section>


<div class="container border-top">
    <center>
        <img src="{{asset('goal.png')}}" width='45'>
    </center>
    <div class="row my-5">
        <div class="col-lg-6 col-sm-12 col-md-6 ">
            <image src={{asset('campaign1.png')}} class="img-fluid ">
        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 ">
            <h2 class="text-primary font-weight-bold">1 - CREATE A CAMPAIGN </h2>
            <p class="font-weight-bold "> It's free, no subscription fee... </p>
            <p> You only pay when you confirm post request</p>
            <br>
            <p class="font-weight-bold "> Find influencers by category... </p>
            <p> filter influencers with category that suits your brand</p>
            <br>
            <p class="font-weight-bold "> It's tailor-made... </p>
            <p> You can define every aspect of your campaign</p>

        </div>
    </div>

    <div class="row my-5">
        <div class="col-lg-6 col-sm-12 col-md-6 ">
            <image src={{asset('proposals.png')}} class="img-fluid">
        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 ">
            <h2 class="text-primary font-weight-bold">2 - SEND PROPOSALS TO INFLUENCERS </h2>

            <p class="font-weight-bold"> Discover the best matching influencers</p>
            <br>
            <p class="font-weight-bold"> Send product description to influencers</p>
            <br>
            <p class="font-weight-bold"> Preview, accept, negociate or decline proposals</p>

        </div>
    </div>

    <div class="row my-5">
        <div class="col-lg-6 col-sm-12 col-md-6 ">
            <image src={{asset('request.png')}} class="img-fluid">

        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 ">

            <h2 class="text-primary font-weight-bold">3 - GO LIVE</h2>
            <p class="font-weight-bold"> Your campaign gets published by the approved influencers</p>

            <p class="font-weight-bold"> Track the campaign status </p>

            <p class="font-weight-bold">Review the influencers</p>
        </div>
    </div>

    </div>
    <div id="footer" class=" footer container-fluid p-5">
        <div class="row">
            <div class="row">
                <div class=" col-lg-3">
                    <div class="ml-3 p">
                        <h6 class="footer-target"> Target</h6>





                    </div>


                </div>
                <div class="col-lg-5">
                    <div>
                        <h6>Contact Info</h6>
                        <br>
                        <p class="font-weight-bold">Address: <br><span class="font-weight-light">1 Mahmoud Salamah, Kom
                                Ad
                                Dakah Gharb, Al Attarin, Alexandria Governorate,Egypt.</span> </p>
                        <p class="font-weight-bold">Telephone: <br><span class="font-weight-light">03 3906924</span></p>
                        <p class="font-weight-bold">Email: <br><span class="font-weight-light">info@Target.com</span>
                        </p>

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








@endsection
