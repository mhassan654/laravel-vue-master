{{-- {{$categories}} --}}
<section class="banner_sec">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="row">
                    @if ($categories->count() > 0)
                    @foreach ($categories as $cat)
                    <div class="col-12 col-md-4 col-lg-4">
                        <a href="">
                            <div class="banner_box">
                                <i class="fab fa-laravel"></i>
                                <h3 class="banner_box_h3">{{$cat['categoryName']}}</h3>
                                <p>The Toptal Blog is the top hub for developers.</p>
                            </div>
                        </a>
                    </div>
                    @endforeach

                    @endif



                </div>
            </div>
        </div>
    </div>
</section>
