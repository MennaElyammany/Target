<!-- <div class="user-bio">
<div class="d-flex user">
<div class="user_img" style="pointer-events: none;">
<div class="img rounded-circle" style="background-image: url('https://scontent-msp1-1.cdninstagram.com/v/t51.2885-19/s150x150/47581718_1158734870962740_2292173665908817920_n.jpg?_nc_ht=scontent-msp1-1.cdninstagram.com&amp;_nc_ohc=07ITu0InFu8AX8h5PFn&amp;oh=140b4dc89b2d12f4225f6932181acd04&amp;oe=5EB73EAC'), url(https://scontent-msp1-1.cdninstagram.com/v/t51.2885-15/e35/p1080x1080/83066510_586560035528729_4452343128190283384_n.jpg?_nc_ht=scontent-msp1-1.cdninstagram.com&amp;_nc_cat=1&amp;_nc_ohc=RGyhtIIeGaoAX-o0h-i&amp;oh=f8bc257611d8ff29e8d53abb43086d21&amp;oe=5ED0B426), url(https://scontent-msp1-1.cdninstagram.com/v/t51.2885-15/e35/81139041_208719503497213_7211188555750322612_n.jpg?_nc_ht=scontent-msp1-1.cdninstagram.com&amp;_nc_cat=101&amp;_nc_ohc=jmgQQ9nbIswAX_O5wKf&amp;oh=da2653fdbc44dbb574d33cc381cb7ab4&amp;oe=5ED7EF36), url(https://scontent-msp1-1.cdninstagram.com/v/t51.2885-15/e35/p1080x1080/81900413_124629689035445_4573402201772993334_n.jpg?_nc_ht=scontent-msp1-1.cdninstagram.com&amp;_nc_cat=105&amp;_nc_ohc=ybtbChiKbmoAX-7NnzL&amp;oh=b46307e27e95f59be414929593c465f5&amp;oe=5ED8F19B), url('/image-not-found.jpg');"></div></div><div class="user-info pr-3 ml-3"><div class="user-info_unlock" style="pointer-events: none;">
    <div class="d-flex no-selection">
    <p class="font-weight-bold text-secondary social-name text-truncate mb-0" style="max-width: 123px; float: left;">@schu...</p>
    <span><i class="fas fa-check-circle ml-2 text-info user_status"></i></span>
    </div>
<p class="font-weight-bold text-muted real-name mb-0"></p>
</div>
<div class="user-info_description" style="pointer-events: none;">
<p class="text-muted block-with-text">Be confident and be kind to your body. ✨1 million youtube best friends👇🏼✨</p>
</div>
</div>
</div>
<div class="d-flex justify-content-around num_info py-3 px-0">
<div class="text-center my-auto">
<span class="text-uppercase">210K</span>
<p class="mb-0 text-uppercase text-center text-muted">FOLLOWERS</p>
</div>
<div class="text-center my-auto">
<span class="text-uppercase">13.1%</span>
<p class="mb-0 text-uppercase text-center text-muted">ENGAGEMENT</p>
</div>
<div class="d-none"><div class="quality_score_block text-center text-white d-inline-block card border-0 pt-1 px-3 d-none">
<span class="text-white quality-score-grade"></span>
<p class="text-uppercase text-white small mb-0">of 100</p>
</div>
</div>
</div>
<small class="text-muted">
<p class="mb-1 text-truncate">
<span><i class="fas fa-tag mr-1"></i>
<span class="mr-2">Plus Size</span>
</span>
<span><i class="fas fa-tag mr-1"></i><span class="mr-2">Fashion</span>
</span></p><p class="mb-0 text-truncate"><i class="fas fa-map-marker-alt mr-1"></i>
<span class="mr-2">California, United States</span>
</p></small></div> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body> 
    <div class="container">
    <h1>List of influencers</h1>
    Filter:
    <a href="/influencers/?category_id=1">Fashion|</a>
    <a href="/influencers/?category_id=2">Singers|</a>
    <a href="/influencers">Reset</a>
    <hr>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Name</th>
            <th>Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach($influencers as $influencer)
            <tr>
                <td>{{ $influencer->name}}</td>
                <td>{{ $influencer->category_id}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$influencers->links()}}

    </div>
    
</body>
</html>




