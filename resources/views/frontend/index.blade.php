@extends('frontend.layout.theme')
@section('content')
    <style>
        @media only screen and (max-width: 599px) {
            .btn-check:focus + .btn-dark, .btn-dark:focus {
                color: #fff;
                background-color: #2B70B7 !important;
                border-color: #1a1e21;
                box-shadow: 0 0 0 .25rem rgba(66,70,73,.5);
            }
            .quickteh-testi-iframe iframe {
                height: 200px !important;
            }
            .quicktech-row-error-fixed{
                --bs-gutter-x: 0 !important;
            }
            .ban-img{
                width:100% !important;
            }
            .quicktech-pp{
                padding-top: 70px;
            }
            .banner-inner img {
                border-radius: 4px;
                margin-bottom: 26px;
                height: 170px !important;
                width: 100% !important;
            }

            .quicktech-cat-img-size{
                height:250px !important;
            }
        }
        .quickteh-testi-iframe iframe{
            height:350px;
        }

        .banner-inner img {
            border-radius: 4px;
            margin-bottom: 26px;
            height: 240px;
            width: 91%;
            box-shadow: 0px 0px 5px -2px rgba(0,0,0,0.75);
        -webkit-box-shadow: 0px 0px 5px -2px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 5px -2px rgba(0,0,0,0.75);
        }
        .ban-down{
            margin-top:38px;
        }

        .hero__content{
            padding-left: 32px;
        }
    </style>

    <main>

        <!-- hero area start -->
      <section class="hero__area hero__height d-flex align-items-center grey-bg-2 p-relative quicktech-pp">
               <div id="carouselExampleFade" class="carousel slide carousel-fade w-100" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach ($sliders as $key => $slider )
    <div class="carousel-item quicktech-banner-img {{ $key == 0 ? 'active' : '' }}">
      <img src="{{ asset($slider->photo_name) }}" class="d-block w-100" alt="...">
    </div>
    @endforeach
  </div>
  <button class="carousel-control-prev" style="background-color:transparent;" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" style="background-color:transparent;" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

        </section>
        <!-- hero area end -->

        <!--about-->
        <section class="quicktech-about-area">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="section__title-wrapper text-center mb-45">
                            <h2 class="section__title bn-font"><span
                                    class="yellow-bg"> <img src="../../../assets/frontend/img/shape/yellow-bg-2.png"
                                        alt=""> ABOUT </span>
                            </h2>
                        </div>
                    </div>
                    <!--<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-4 col-6">-->
                    <!--    <div class="category__more mb-50 float-md-end fix">-->
                    <!--        <a href="{{ route('আমাদের সম্পর্কে') }}" class="link-btn">-->
                    <!--            <span class="bn-normal">Read More </span>-->

                    <!--            <i class="far fa-arrow-alt-circle-right"></i>-->
                    <!--        </a>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                <div style="margin-bottom:30px;" class="row gap">
                    <div class="col-lg-4">
                        <div class="quicktech-about-img">
                            <img class="w-100" src="{{ asset($about_tab->about_photo) }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="quicktech-about-text">
                            <p style="text-align:justify;">
                                {!! $about_tab->about_text !!}
                             </p>

                        <div class="category__more mb-50 float-md-end fix">
                            <a href="{{ route('আমাদের সম্পর্কে') }}" class="link-btn">
                                <span class="bn-normal">Read More </span>

                                <i class="far fa-arrow-alt-circle-right"></i>
                            </a>
                        </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--about-->

        <!-- category area start -->
        <section class="category__area pb-70">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8">
                        <div class="section__title-wrapper mb-45">
                            <h2 class="section__title bn-font"><span class="bn-normal">Favourite</span><br> <span
                                    class="yellow-bg"> <img src="../../../assets/frontend/img/shape/yellow-bg-2.png"
                                        alt="">Category </span>
                            </h2>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-4">
                        <div class="category__more mb-50 float-md-end fix">
                            <a href="#courses" class="link-btn">
                                <span class="bn-normal">All Course </span>

                                <i class="far fa-arrow-alt-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                    <section id="fav-category">
                        <div class="container">

                         <div class="row mt-5 new_slider">

                            @foreach ($fav_categories as $category)
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="category__item mb-30 transition-3 d-flex align-items-center justify-content-center position-relative mx-2" style="height: 157px">
                                        <div class="category__icon mr-30">
                                            <img style="height: 60px !important; width:60px;" src="{{ asset($category->image) }}" alt="" >
                                            <!--<i class="{{ $category->icon }}" style="color: #2b4eff;"></i>-->

                                        </div>
                                        <div class="category__content">
                                            <h4 class="category__title">{{ $category->name }}
                                            </h4>
                                           <p class="bn-normal" style="font-size: 15px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
    {{ $category->description }}</p>

                                        </div>
                                        <a href="{{ route('ক্যাটেগরি', ['id' => $category->id]) }}" class="bn-normal stretched-link"></a>
                                    </div>
                                </div>
                            @endforeach




                         </div>
                        </div>
                    </section>
                <!--<div class="row">-->
                    <!--style="padding: 30px 0px 30px 0px"-->
                <!--    @foreach ($fav_categories as $category)-->
                <!--        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">-->
                <!--            <div class="category__item mb-30 transition-3 d-flex align-items-center justify-content-center position-relative" style="height: 200px">-->
                <!--                <div class="category__icon mr-30">-->
                <!--                    <img src="{{ asset($category->image) }}" alt="" class="img-fluid" height="150" width="150">-->
                                    <!--<i class="{{ $category->icon }}" style="color: #2b4eff;"></i>-->

                <!--                </div>-->
                <!--                <div class="category__content">-->
                <!--                    <h4 class="category__title">{{ $category->name }}-->
                <!--                    </h4>-->
                <!--                    <p class="bn-normal" style="font-size: 15px;">{{ $category->description }}</p>-->
                <!--                </div>-->
                <!--                <a href="{{ route('ক্যাটেগরি', ['id' => $category->id]) }}" class="bn-normal stretched-link"></a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    @endforeach-->
                <!--</div>-->
            </div>
        </section>
        <!-- category area end -->

        <!-- banner area start -->
        <section class="banner__area" id="courses">
            <div class="container">
                <div class="row gapp">
                    @foreach ($front_ads as $front_ad)
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 rounded">
                            <a href="{{ $front_ad->link }}">
                                <img src="{{ asset($front_ad->image) }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- banner area end -->


        <!--course slider-->
      <!--new science part start-->
      @foreach($front_categories as $category)
        <section id="category-{{ $category->id }}">
            <div class="container">
             <div class="row mb-4">
                 <div class="col-lg-12">
                     <div class="impcr-head d-flex justify-content-between align-items-center text-center pb-2">
                        <h2 style="padding-top:16px;" class="section__title bn-font"><span class="bn-normal"></span><br> <span
                             class="yellow-bg">  <img src="../../../assets/frontend/img/shape/yellow-bg-2.png"
                                 alt="">{{ $category->name }} </span>
                        </h2>
                         <a class="quicktech-view" href="/categories/{{ $category->id }}"><i class="fas fa-long-arrow-alt-right"></i></a>
                     </div>
                 </div>
             </div>
             <!--<i class="fa-solid fa-chevron-left prevv"></i>-->
             <!--<i class="fa-solid fa-chevron-right nextt"></i>-->
             <div class="row mt-5 new_slider">

                @foreach($category->courses as $course)
                <div class="col-lg-4 quicktech-widt">
                    <div style="margin-left:10px;">

                        @include('frontend.include.course', ['course' => $course, 'owl'=> 1])

                    </div>
                </div>
                @endforeach




             </div>
             <!--<div class="row">-->
             <!--    <div class="col-lg-12">-->
             <!--        <div class="btn-see text-center">-->

             <!--        </div>-->
             <!--    </div>-->
             <!--</div>-->
            </div>
        </section>
      @endforeach
        <!--new science part end-->


        <!--course slider-->





        <!-- course area start -->
        <!--<section class="course__area mt-5 pb-120 grey-bg" id="courses">-->
        <!--    <div class="container">-->
        <!--        <div class="row align-items-end">-->
        <!--            <div class="col-xxl-5 col-xl-6 col-lg-6">-->
        <!--                <div class="section__title-wrapper mb-60">-->
        <!--                    <h2 class="section__title bn-normal">খুজে নাও তোমার পছন্দের<br> <span-->
        <!--                            class="yellow-bg yellow-bg-big bn-font"><img-->
        <!--                                src="../../../assets/frontend/img/shape/yellow-bg.png" alt="">অনলাইন</span>-->
        <!--                        <span class="bn-font">কোর্স সমূহ</span>-->
        <!--                    </h2>-->
        <!--                    <p class="bn-normal">আমাদের রয়েছে সুদক্ষ টিম তোমাদের সমস্যা গুলো সমাধান করার জন্য</p>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            <div class="course__menu d-flex justify-content-lg-end mb-60">-->
        <!--                <div class="masonary-menu filter-button-group">-->
        <!--                    <button class="active" data-filter="*">-->
        <!--                        সকল কোর্স-->
        <!--                        <span class="tag">new</span>-->
        <!--                    </button>-->
        <!--                    <button data-filter=".trending">ট্রেন্ডিং</button>-->
        <!--                    <button data-filter=".favorite">জনপ্রিয়</button>-->
        <!--                    <button data-filter=".featured">ফিচারড</button>-->
        <!--                    <button data-filter=".common">সাধারন</button>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->

        <!--        <div class="row grid">-->
        <!--            @foreach ($courses as $course)-->
        <!--                @include('frontend.include.course', ['course' => $course])-->
        <!--            @endforeach-->
        <!--        </div>-->

        <!--    </div>-->
        <!--</section>-->
        <!-- course area end -->
        <!-- category area start -->
        <section class="category__area pb-70">
            <div class="container">


                <div class="section__title-wrapper text-center mb-45">
                    <h2 class="section__title bn-font"><span class="bn-normal">Why Choose us?</span><br>The benefits you  <span class="yellow-bg">will get <img src="../../../assets/frontend/img/shape/yellow-bg-2.png"
                                alt=""> </span>from us:
                    </h2>
                </div>



                <div class="row">
                    @foreach ($studentbenefits as $studentbenefit)
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                            <div class="category__item mb-30 transition-3 d-flex align-items-center justify-content-center"
                                style="padding: 30px 0px 30px 0px">
                                <div class="category__icon mr-30" style="padding: 20px 20px 20px 20px">
                                    <img src="{{ asset($studentbenefit->image) }}"
                                        style="max-height: 100px; width: 100px" alt="" srcset="">
                                </div>
                                <div class="category__content">

                                    <h4 class="category__title"><a href="{{ $studentbenefit->link }}"
                                            class="bn-font">{{ $studentbenefit->title }}</a></h4>
                                    <p class="bn-normal">{{ $studentbenefit->description }}</p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- category area end -->




        <!-- course3 area start -->
        @if ($free_courses->count() > 0)
            <section style="padding-bottom:46px !important;" class="course__area">
                <div class="container">
                    <div style="row-gap:20px;" class="row align-items-end">
                        <div class="col-lg-12">

                            <div class="impcr-head d-flex">
                        <h2 class="section__title bn-font">Free Course</h2>
                        <a class="quicktech-vieww" href="/categories/4"><i class="fas fa-long-arrow-alt-right"></i></a>
                     </div>
                        </div>

                        <div class="owl-carousel owl-theme owl-carousel-courses">
                            @foreach ($free_courses as $course)
                                @include('frontend.include.course', ['course' => $course, 'owl' => true])
                            @endforeach
                        </div>



                    </div>
                </div>
            </section>
        @endif
        <!-- course3 area end -->



        <!-- events area start -->
        <!--<section style="padding-bottom:46px !important;" class="events__area p-relative">-->
        <!--    <div class="events__shape">-->
        <!--        <img class="events-1-shape" src="../../../assets/frontend/img/events/events-shape.png" alt="">-->
        <!--    </div>-->
        <!--    <div class="container">-->
        <!--        <div class="row">-->
        <!--            <div class="col-xxl-4 offset-xxl-4">-->
        <!--                <div class="section__title-wrapper mb-60 text-center">-->
        <!--                    <h2 class="section__title bn-font">বর্তমান <span-->
        <!--                            class="yellow-bg yellow-bg-big">ইভেন্টগুলো<img-->
        <!--                                src="../../../assets/frontend/img/shape/yellow-bg.png" alt=""></span></h2>-->
        <!--                    <p class="font-normal">এখানে সর্বমোট {{ $events->count() }} টি ইভেন্ট পাওয়া গিয়েছে</p>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="row">-->
        <!--            @foreach ($events as $event)-->
        <!--                @include('frontend.include.event', ['event' => $event])-->
        <!--            @endforeach-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</section>-->
        <!-- events area end -->


        <!-- Blog area start -->
        <section style="padding-bottom:46px !important;" class="category__area">
            <div class="container">


                <div class="section__title-wrapper mb-45">
                    <h2 class="section__title bn-font text-center">
                        <span class="bn-font">What’s Included in Our Courses Throughout the Year?</span>
                    </h2>
                    <p class="text-center bn-normal" style="font-size: 20px; margin-top: 10px;">
                        Keep your learning journey uninterrupted from anywhere in the country under the guidance of the best teachers.
                    </p>
                </div>




                <div class="row">
                    @foreach ($promovideos as $promovideo)
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                            <div class="course__item white-bg mb-30 fix">
<div class="course__thumb w-img p-relative fix">
    <style>
        iframe {
            width: 100%;
            height: 200px;
        }

    </style>

    <!-- Video container with the play button -->
    <div class="video-container" style="position: relative;">
        {!! $promovideo->video !!}
        <div class="play-button" onclick="togglePlay(this)"></div>
    </div>


</div>

                                <div class="course__content">
                                    <h3 class="course__title"><a class="bn-normal"
                                            style="font-size: 32px">{{ $promovideo->title }}</a></h3>
                                    <p class="bn-normal">{!! $promovideo->description !!}</p>
                                </div>


                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Blog area end -->
        <!-- counter area start -->
        <section style="padding-bottom:46px !important;" class="counter__area">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 offset-xl-3 col-xl-6 offset-xl-3">
                        <div class="section__title-wrapper text-center mb-60">
                            <h2 class="section__title bn-font">
                                We Are
                                <span class="yellow-bg yellow-bg-big">
                                    Proud
                                    <img src="../../../assets/frontend/img/shape/yellow-bg.png" alt="" />
                                </span>
                            </h2>
                            <p class="bn-normal">
                                You don’t have to struggle alone; we are here to support and assist you.
                            </p>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-4 text-center">
                        <div class="counter__item mb-30">
                            <div class="counter__icon user mb-15">
                                <svg viewBox="0 0 490.7 490.7">
                                    <path class="st0"
                                        d="m245.3 98c-39.7 0-72 32.3-72 72s32.3 72 72 72 72-32.3 72-72-32.3-72-72-72zm0 123.3c-28.3 0-51.4-23-51.4-51.4s23-51.4 51.4-51.4 51.4 23 51.4 51.4-23 51.4-51.4 51.4z" />
                                    <path class="st0"
                                        d="m389.3 180.3c-28.3 0-51.4 23-51.4 51.4s23 51.4 51.4 51.4c28.3 0 51.4-23 51.4-51.4s-23.1-51.4-51.4-51.4zm0 82.2c-17 0-30.8-13.9-30.8-30.8s13.9-30.8 30.8-30.8 30.8 13.9 30.8 30.8-13.9 30.8-30.8 30.8z" />
                                    <path class="st0"
                                        d="m102.9 180.3c-28.3 0-51.4 23-51.4 51.4s23 51.4 51.4 51.4 51.4-23 51.4-51.4-23-51.4-51.4-51.4zm0 82.2c-17 0-30.8-13.9-30.8-30.8s13.9-30.8 30.8-30.8 30.8 13.9 30.8 30.8-13.7 30.8-30.8 30.8z" />
                                    <path class="st0"
                                        d="m245.3 262.5c-73.7 0-133.6 59.9-133.6 133.6 0 5.7 4.6 10.3 10.3 10.3s10.3-4.6 10.3-10.3c0-62.3 50.7-113 113-113s113.1 50.7 113.1 113c0 5.7 4.6 10.3 10.3 10.3s10.3-4.6 10.3-10.3c0-73.7-60-133.6-133.7-133.6z" />
                                    <path class="st0"
                                        d="m389.3 303.6c-17 0-33.5 4.6-47.9 13.4-4.8 3-6.4 9.2-3.5 14.2 3 4.8 9.2 6.4 14.2 3.5 11.2-6.8 24.1-10.4 37.3-10.4 39.7 0 72 32.3 72 72 0 5.7 4.6 10.3 10.3 10.3s10.3-4.6 10.3-10.3c-0.2-51.3-41.8-92.7-92.7-92.7z" />
                                    <path class="st0"
                                        d="m149.4 316.9c-14.5-8.7-30.9-13.3-47.9-13.3-51 0-92.5 41.5-92.5 92.5 0 5.7 4.6 10.3 10.3 10.3s10.3-4.6 10.3-10.3c0-39.7 32.3-72 72-72 13.2 0 26 3.6 37.2 10.4 4.8 3 11.2 1.4 14.2-3.5 2.9-4.9 1.2-11.1-3.6-14.1z" />
                                </svg>
                            </div>
                            <div class="counter__content">
                                <h4><span data-purecounter-duration="1" data-purecounter-end="{{ $total['students'] }}"
                                        class="purecounter">0</span></h4>

                                        <p class="bn-normal" style="font-size: 20px">General Student</p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-4 text-center">
                        <div class="counter__item counter__pl-34 mb-30">
                            <div class="counter__icon graduate mb-15">
                                <svg viewBox="0 0 512 512">
                                    <g id="Page-1">
                                        <g id="_x30_01---Degree">
                                            <path id="Shape" class="st0"
                                                d="M500.6,86.3L261.8,1c-3.8-1.3-7.9-1.3-11.7,0L11.3,86.3C4.5,88.7,0,95.2,0,102.4    s4.5,13.6,11.3,16.1L128,160.1v53.2c0,33.2,114.9,34.1,128,34.1s128-1,128-34.1v-53.2l25.6-9.1v19.6c0,9.4,7.6,17.1,17.1,17.1    h17.1c9.4,0,17.1-7.6,17.1-17.1V145c0-4-1-7.8-2.8-11.4l42.7-15.3c6.8-2.4,11.3-8.9,11.3-16.1S507.5,88.8,500.6,86.3L500.6,86.3z     M366.9,194.6c-32.5-14.8-101-15.4-110.9-15.4s-78.4,0.6-110.9,15.4v-74.3c5.1-6.6,45.4-17.8,110.9-17.8s105.8,11.2,110.9,17.8    V194.6z M256,230.4c-63.1,0-102.8-10.4-110.2-17.1c7.4-6.6,47.1-17.1,110.2-17.1s102.8,10.4,110.2,17.1    C358.8,220,319.1,230.4,256,230.4z M413.6,131.5L384,142v-22.5c0-33.2-114.9-34.1-128-34.1s-128,1-128,34.1V142L17.1,102.4    l239.1-85.3L426.7,78v43C421.3,123,416.7,126.6,413.6,131.5z M443.7,170.7h-17.1v-25.6c0-4.7,3.8-8.5,8.5-8.5s8.5,3.8,8.5,8.5    v25.6H443.7z M443.7,120.7V84.1l51.2,18.3L443.7,120.7z" />
                                            <path id="Shape_1_" class="st0"
                                                d="M486.4,264.5c-0.5,0-1,0-1.5,0.1C409.2,276.4,332.6,282,256,281.5    c-76.6,0.5-153.2-5.2-228.9-16.9c-0.5-0.1-1-0.1-1.5-0.1c-6,0-25.6,6.8-25.6,93.9s19.6,93.9,25.6,93.9c0.5,0,1-0.1,1.5-0.2    c58.2-9.2,116.9-14.6,175.8-16l-16.7,40c-2.6,6.4-1,13.7,3.9,18.5s12.3,6.1,18.6,3.4l6.5-2.8l2.8,6.5c2.7,6.3,8.9,10.4,15.7,10.4    h0.2c6.9-0.1,13.1-4.3,15.6-10.6l14.8-35.5l14.8,35.3c2.6,6.5,8.8,10.7,15.7,10.8h0.3c6.8,0,12.9-4,15.6-10.2l2.9-6.5l6.4,2.8    c6.3,2.8,13.8,1.5,18.7-3.4c5-4.8,6.5-12.2,3.9-18.6L326.3,437c53.1,1.9,106,7,158.5,15.4c0.5,0.1,1,0.1,1.5,0.1    c6,0,25.6-6.8,25.6-93.9S492.4,264.5,486.4,264.5L486.4,264.5z M283.3,298.4c3.5,13,5.6,26.4,6.2,39.9c-19.3-9-42-6.9-59.4,5.5    c-0.4-15.3-2.4-30.6-5.9-45.5c10.3,0.2,20.9,0.3,31.8,0.3C265.3,298.7,274.4,298.6,283.3,298.4z M264.5,435.2    c-23.6,0-42.7-19.1-42.7-42.7s19.1-42.7,42.7-42.7s42.7,19.1,42.7,42.7S288.1,435.2,264.5,435.2z M25.6,285.9    c6.5,23.6,9.4,48.1,8.5,72.5c0.9,24.5-2,48.9-8.5,72.5c-6.5-23.6-9.4-48.1-8.5-72.5C16.2,333.9,19.1,309.5,25.6,285.9z     M42.8,432.4c4.7-13.5,8.4-36.2,8.4-74s-3.7-60.5-8.4-74c54.2,7.5,108.8,12,163.5,13.5c5.1,19.7,7.5,40.1,7,60.5    c0,1.2,0,2.4-0.1,3.6c-10.2,17-11.3,38-2.7,55.9l-0.4,0.9C154.2,420.2,98.3,424.7,42.8,432.4L42.8,432.4z M233.9,494.9l-6.2-14.3    c-1.9-4.3-6.9-6.3-11.2-4.4l-14.4,6.3l20-48c8.2,8.3,18.7,14.1,30.1,16.5L233.9,494.9z M312.6,476.2c-4.3-1.9-9.3,0.1-11.2,4.4    l-6.3,14.2L276.8,451c11.5-2.4,21.9-8.1,30.2-16.5l20,47.8L312.6,476.2z M484.7,434.8c-54.8-8.4-110.1-13.6-165.5-15.4l-0.6-1.5    c10.7-22.6,6.1-49.5-11.5-67.3c-0.1-17.7-2.1-35.3-6.1-52.6c61.5-1.4,122.9-6.7,183.7-16.1c4,6.7,10.2,33.3,10.2,76.4    S488.6,428,484.7,434.8L484.7,434.8z" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="counter__content">
                                <h4><span data-purecounter-duration="1" data-purecounter-end="{{ $total['courses'] }}"
                                        class="purecounter">0</span></h4>
                                        <p class="bn-normal" style="font-size: 20px">Courses</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-4 text-center">
                        <div class="counter__item mb-30">
                            <div class="counter__icon globe mb-15">
                                <svg viewBox="0 0 512 512">
                                    <path class="st0"
                                        d="M444.2,150.6c6.9-14.6,10.9-30.4,11.8-46.6c0.1-48.5-39.2-87.9-87.8-88c-28,0-54.4,13.3-71,35.9  C175.7,29.1,58.6,109.2,35.8,230.8s57.3,238.6,178.9,261.4c121.6,22.8,238.6-57.3,261.4-178.9c2.6-13.6,3.8-27.4,3.8-41.3  C480,228.9,467.6,186.7,444.2,150.6z M464,272c0,39.2-11.1,77.6-32.1,110.8c-7.1-34.3-20.4-42.5-36.7-48.8  c-5.3-1.6-10.3-4.4-14.4-8.1c-5.9-6.6-11-13.8-15.2-21.5c-11.4-18.8-25.5-42.1-57.7-58.2l-5.9-2.9c-40.4-20-54-26.8-34.8-84.2  c3.5-10.5,9.5-20.1,17.4-27.9c9.9,32.7,34,71.5,55,101.4c11,15.6,32.6,19.4,48.2,8.4c3.3-2.3,6.1-5.1,8.4-8.4  c14.7-20.6,28-42.3,39.7-64.7C454.4,199.5,464,235.4,464,272z M368,32c39.7,0,72,32.3,72,72c0,24.8-20.2,67.2-56.8,119.4  c-6,8.4-17.6,10.4-26,4.4c-1.7-1.2-3.2-2.7-4.4-4.4C316.2,171.2,296,128.8,296,104C296,64.3,328.3,32,368,32z M48,272  c0-45.4,14.9-89.6,42.4-125.7c12,7.9,65.3,45.5,53.6,86.2c-4.9,14.7-3.4,30.8,4.2,44.3c14.1,24.4,45,32.4,45.6,32.6  c0.3,0.1,26.5,9.1,31.4,27.2c2.7,9.9-1.5,21.5-12.6,34.5c-12.5,15.5-29.2,27.1-48,33.5c-14.5,5.6-27.3,10.6-33.5,33.7  C78.8,399,48,337.4,48,272z M256,480c-39.2,0-77.5-11.1-110.6-32c3.6-20.1,10.6-22.9,25.1-28.5c21.3-7.4,40.1-20.5,54.3-38  c14.8-17.3,20.1-33.8,15.9-49.2c-7.3-26.3-40.4-37.6-42.4-38.2c-0.2-0.1-25.5-6.6-36.3-25.2c-5.3-9.8-6.3-21.4-2.6-31.9  c14.3-50.1-42.1-92-58.8-103.1C140,89.4,196.6,64,256,64c10.9,0,21.7,0.9,32.5,2.6c-5.6,11.7-8.5,24.5-8.5,37.4  c0,3.2,0.3,6.4,0.7,9.5c-13.3,10.4-23.2,24.5-28.6,40.5c-23.6,70.6,1.4,83.1,42.9,103.6l5.8,2.9c28,14,40.3,34.3,51.1,52.2  c4.9,8.8,10.7,17.1,17.5,24.6c5.7,5.3,12.5,9.3,20,11.7c12.9,5,24.1,9.4,29.2,52.4C379.4,451,319.4,480,256,480z M368,152  c26.5,0,48-21.5,48-48s-21.5-48-48-48s-48,21.5-48,48C320,130.5,341.5,152,368,152z M368,72c17.7,0,32,14.3,32,32s-14.3,32-32,32  s-32-14.3-32-32S350.3,72,368,72z" />
                                </svg>
                            </div>
                            <div class="counter__content">
                                <h4><span data-purecounter-duration="1"
                                        data-purecounter-end="{{ $total['instructors'] }}" class="purecounter">0</span>
                                </h4>
                                <p class="bn-normal" style="font-size: 20px">Instructors</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- counter area end -->


        <!-- Counter for Booking-->
        <!--<section class="category__area pb-70">-->
        <!--    <div class="container">-->
        <!--        <div class="card" style="padding: 60px 0px 60px 0px">-->
        <!--            <div class="section__title-wrapper mb-45">-->
        <!--                <h2 class="section__title bn-font text-center"><span class="bn-font">সফল ক্যারিয়ার গড়তে সঠিক-->
        <!--                        প্রোগ্রামটি বেছে নিন-->
        <!--                </h2>-->
        <!--                <p class="text-center bn-normal" style="font-size: 20px; margin-top: 10px;">সফল ক্যারিয়ার গড়তে-->
        <!--                    দরকার সঠিক জায়গায় নিজের সময় আর পরিশ্রম দেয়া। তাই বহুব্রীহি থেকেই অর্জন করুন জব-রেডি হবার-->
        <!--                    কনফিডেন্স আর স্কিল।</p>-->
        <!--            </div>-->

        <!--            <div class="row">-->
        <!--                <div class="col-6 text-end">-->
        <!--                    <button class="btn btn-danger">সবগুলো কোর্স দেখুন</button>-->
        <!--                </div>-->
        <!--                <div class="col-6">-->
        <!--                    <button class="btn btn-dark" type="button" data-bs-toggle="modal"-->
        <!--                        data-bs-target="#exampleModal">কল বুক করুন</button>-->
                            <!-- Modal -->
        <!--                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"-->
        <!--                        aria-hidden="true">-->
        <!--                        <div class="modal-dialog modal-md">-->
        <!--                            <div class="modal-content">-->
        <!--                                <div class="modal-header">-->
        <!--                                    {{-- <h5 class="modal-title" id="exampleModalLabel">ফোন কল বুক</h5> --}}-->
        <!--                                    <button type="button" class="btn-close" data-bs-dismiss="modal"-->
        <!--                                        aria-label="Close"></button>-->
        <!--                                </div>-->
        <!--                                <div class="modal-body">-->
        <!--                                    <h4 class="bn-font">ফ্রি কলে পরামর্শ নিন-->
        <!--                                        ক্যারিয়ার কাউন্সিলরের কাছ থেকে</h4>-->
        <!--                                    <div class="mb-3">-->
        <!--                                        <label for="" class="form-label bn-normal">ফোন নম্বর অথবা ইমেইল-->
        <!--                                            দিন</label>-->
        <!--                                        <input type="text" name="phone" id=""-->
        <!--                                            class="form-control bg-light" placeholder="ফোন নম্বর অথবা ইমেইল দিন"-->
        <!--                                            aria-describedby="helpId" />-->

        <!--                                    </div>-->
        <!--                                    <button type="submit" class="btn btn-dark bn-normal w-100">-->
        <!--                                        এগিয়ে যান-->
        <!--                                    </button>-->

        <!--                                </div>-->

        <!--                            </div>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->




        <!--    </div>-->
        <!--</section>-->


        <!-- Counter for Student and Courses-->
        <!--<section class="category__area">-->
        <!--    <div class="container">-->



        <!--        <div class="row">-->
        <!--            <div class="col-md-6 text-end">-->
        <!--                <h2 class="bn-font">রিয়েল লাইফ প্রজেক্টের-->
        <!--                    মাধ্যমে মার্কেট স্ট্যান্ডার্ড কাজ শিখুন</h2>-->
        <!--                <p class="bn-normal">-->
        <!--                    একেবারে বেসিক থেকে অ্যাডভান্সড লেভেল পর্যন্ত সবকিছু আপনি ধাপে ধাপে শিখবেন আমাদের ক্যারিয়ার-->
        <!--                    ট্র্যাকগুলোতে। এর জন্য করবেন রিয়েল লাইফ প্রজেক্ট, যা জব ও ফ্রিল্যান্সিং মার্কেটে কাজ করার-->
        <!--                    কনফিডেন্স এনে দেবে আপনাকে।-->
        <!--                </p>-->
        <!--            </div>-->
        <!--            <div class="col-md-6">-->
        <!--                <img class="quicktech-cat-img-size" src="{{ asset('assets/frontend/img/uploads/live-project.png') }}"-->
        <!--                    style="height: 400px; width: 100%">-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->




        <!--    </div>-->
        <!--</section>-->


        <!-- Our Values -->
        <section style="padding-bottom:46px !important;" class="category__area quicktech-valuess">
              <i class="fa-solid fa-chevron-left prevvv"></i>
    <i class="fa-solid fa-chevron-right nexttt"></i>
            <div class="container" style="padding: 60px 0px 0px 0px">
                <h2 class="bn-font text-center">Our Success</h2>
                <p class="bn-normal text-center" style="font-size: 20px">
                    You will learn everything step by step, from absolute basics to advanced levels, in our career tracks.
                    You will work on real-life projects, which will give you the confidence to work in the job and freelancing market.
                </p>



                <div class="row quicktech-row-error-fixed values-slide">

                    @foreach ($success_ads as $success_ad)
                        <div class="col-md-4">
                            <a>
                                <img src="{{ asset($success_ad->image) }}" class="ban-img" style="height: 380px !important; width: 96%; ">
                            </a>
                            <!-- <a href="{{ $success_ad->link }}">-->
                            <!--    <img src="{{ asset($success_ad->image) }}" class="ban-img" style="height: 380px !important; width: 96%; ">-->
                            <!--</a>-->
                        </div>
                    @endforeach
                </div>
            </div>




            </div>
        </section>

        <!-- Testiominal -->
        <!--<section class="category__area">-->
        <!--    <div class="container" style="padding: 10px 0px 0px 0px">-->
        <!--        <center>-->
        <!--            <h2 class="text-center bn-font">আমাদের সম্পর্কে শিক্ষার্থীরা যা বলে</h2>-->
        <!--        </center>-->
        <!--        <div class="owl-carousel owl-theme" id="testiominal">-->
        <!--            @for ($i = 1; $i <= 3; $i++)-->
        <!--                <div class="item">-->
        <!--                    <div class="row no-gutters justify-content-center align-items-center">-->
        <!--                      <div class="col-8 quickteh-testi-iframe">-->
        <!--                            <div class="video-container" style="position: relative;">-->
        <!--                                <iframe width="100%" height="380"-->
        <!--                                    src="https://www.youtube.com/embed/-A5wB0jBO_o?si=r57TDtjcsgqM6hiX"-->
        <!--                                    title="YouTube video player" frameborder="0"-->
        <!--                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"-->
        <!--                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>-->

                                        <!-- Play button -->
        <!--                                <div class="play-button" onclick="togglePlay(this)"></div>-->
        <!--                            </div>-->

        <!--                            <p class="text-center bn-normal" style="font-size: 20px">-->
        <!--                                জীবের মধ্যে সবচেয়ে সম্পূর্ণতা মানুষের। কিন্তু সবচেয়ে অসম্পূর্ণ হয়ে সে জন্মগ্রহণ-->
        <!--                                করে। বাঘ ভালুক তার জীবনযাত্রার পনেরো- আনা মূলধন নিয়ে আসে প্রকৃতির মালখানা থেকে।-->
        <!--                                জীবরঙ্গভূমিতে মানুষ এসে দেখা দেয় দুই শূন্য হাতে মুঠো বেঁধে।-->
        <!--                            </p>-->

        <!--                            <center style="margin-top: 40px;">-->
        <!--                                <img src="https://media.istockphoto.com/id/1327592506/vector/default-avatar-photo-placeholder-icon-grey-profile-picture-business-man.jpg?s=612x612&w=0&k=20&c=BpR0FVaEa5F24GIw7K8nMWiiGmbb8qmhfkpXcp1dhQg="-->
        <!--                                    style="border-radius: 50%; height: 50px; width: 50px;margin-top: -10px">-->
        <!--                            </center>-->
        <!--                            <h3 class="bn-normal text-center">রানা বেপারী </h3>-->
        <!--                            <p class="bn-normal text-center" style="font-size: 18px">ওয়েব ডেভেলপার অ্যান্ড ডিজাইনার</p>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            @endfor-->
        <!--        </div>-->


        <!--    </div>-->
        <!--</section>-->




    </main>
@endsection



{{-- Scripts --}}
@section('script')
<script>
    function togglePlay(button) {
        // Find the iframe within the parent video container
        const videoContainer = button.closest('.video-container');
        const iframe = videoContainer.querySelector('iframe');

        // Get the video src and update it to include autoplay
        const src = iframe.src;
        if (!src.includes("autoplay")) {
            iframe.src = src + (src.includes("?") ? "&autoplay=1" : "?autoplay=1");
        }

        // Hide the play button
        button.style.display = "none";
    }
</script>
  <script>
        function togglePlay(button) {
            // Find the iframe within the parent video container
            const videoContainer = button.closest('.video-container');
            const iframe = videoContainer.querySelector('iframe');

            // Get the video src and update it to include autoplay
            const src = iframe.src;
            if (!src.includes("autoplay")) {
                iframe.src = src + (src.includes("?") ? "&autoplay=1" : "?autoplay=1");
            }

            // Hide the play button
            button.style.display = "none";
        }
    </script>
    <script>
        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        const student = document.getElementById("student");
        const studentValue = document.getElementById("studentValue").value;
        const teacher = document.getElementById("teacher");
        const teacherValue = document.getElementById("teacherValue").value;
        const course = document.getElementById("course");
        const courseValue = document.getElementById("courseValue").value;
        animateValue(student, 0, studentValue, 5000);
        animateValue(teacher, 0, teacherValue, 5000);
        animateValue(course, 1, courseValue, 5000);
    </script>

  <script>
document.addEventListener("DOMContentLoaded", function () {
    const iframe = document.querySelector('.video-container iframe');

    if (iframe) {
        let src = iframe.getAttribute('src');

        if (src && src.includes('youtube.com/embed')) {
            const params = [
                'autoplay=0',        // Autoplay the video (1)
                'controls=0',        // Hide all player controls
                'modestbranding=1',  // Minimize branding
                'rel=0',             // No related videos
                'showinfo=0',        // Hide video info (deprecated, but still safe to add)
                'fs=0',              // Disable fullscreen button
                'iv_load_policy=3',  // Disable annotations
                'disablekb=1'        // Disable keyboard controls
            ];

            if (!src.includes('?')) {
                src += '?' + params.join('&');
            } else {
                src += '&' + params.join('&');
            }

            iframe.setAttribute('src', src);
        }
    }
});
</script>

@endsection
