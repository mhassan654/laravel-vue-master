@extends('layout.master')
{{-- @section('title', $blogDetails->title)@endsection --}}

@section('content')

<!-- BANNER -->
@include('partials.banner')
<!-- BANNER -->
<div class="blog_post_sec_all">
    <div class="container">
        <div class="row">
            <div class="cl-12 col-md-12 col-lg-9">
                <div class="blog_post_left">
                    <div class="blog_post_sec">
                        <div class="blog_post_top">
                            <ul class="blog_post_top_ul">
                                <li>
                                    <a href="blog.html">{{$blogDetails->title}}</a>
                                </li>
                                <li>{{$blogDetails->created_at}}</li>
                            </ul>
                        </div>
                        <div class="blog_post">
                            {!! $blogDetails->post !!}
                        </div>
                    </div>
                    <div class="post_que">
                        <h2 class="post_que_h2">UNDERSTANDING THE BASICS</h2>
                        <!-- ITEAM -->
                        <div class="post_que_single">
                            <div class="post_que_single_top">
                                <i class="fas fa-angle-right"></i>
                                <p class="post_que_title">What is a chatbot and how does it work?</p>
                            </div>
                            <div class="post_que_single_btm dis_none">
                                <p class="post_que_text">
                                    Chatbot terminology causes confusion. Chatbots are computer programs that respond to
                                    human messages. They are designed one of two ways: The first is based on rules that
                                    dictate the bot’s replies to specific commands. The second is with AI, where the
                                    goal is to comprehend the nuances of human language.
                                </p>
                            </div>
                        </div>
                        <!-- ITEAM -->

                        <!-- ITEAM -->
                        <div class="post_que_single">
                            <div class="post_que_single_top">
                                <i class="fas fa-angle-right"></i>
                                <p class="post_que_title">What are chatbots good for?</p>
                            </div>
                            <div class="post_que_single_btm dis_none">
                                <p class="post_que_text">
                                    Some chatbots are designed to carry on casual conversations. Others act as customer
                                    service reps, providing deals, booking dates, and product support. There are also
                                    “digital assistants” that can do everything listed above while providing hundreds of
                                    extra features, like banking, home security, and traffic advice.
                                </p>
                            </div>
                        </div>
                        <!-- ITEAM -->

                        <!-- ITEAM -->
                        <div class="post_que_single">
                            <div class="post_que_single_top">
                                <i class="fas fa-angle-right"></i>
                                <p class="post_que_title">What are the types of chatbots?</p>
                            </div>
                            <div class="post_que_single_btm dis_none">
                                <p class="post_que_text">
                                    Chatbot terminology causes confusion. Chatbots are computer programs that respond to
                                    human messages. They are designed one of two ways: The first is based on rules that
                                    dictate the bot’s replies to specific commands. The second is with AI, where the
                                    goal is to comprehend the nuances of human language.
                                </p>
                            </div>
                        </div>
                        <!-- ITEAM -->
                    </div>
                    <div class="post_dtls_cmnt_sec mar_t20">
                        <h2 class="post_dtls_title2 pad_b20">Comments</h2>
                        <!-- comment -->
                        <div class="cmnt_box_all">
                            <div class="cmnt_box_top dis_flx">
                                <div class="cmnt_box_top_left d-flex">
                                    <div class="cmnt_img mar_r15">
                                        <img src="img/girl-cmnt.jpg" alt="image">
                                    </div>
                                    <div class="cmnnt_name">
                                        <div class="cmnt_name_left">
                                            <h4 class="tchr_nam mar_b10">james smith</h4>
                                        </div>
                                        <div class="cmnt_name_right">
                                            <p class="cmnt_name_right_p">05 Nov 2019 AT 12:00 AM</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="cmnnt_p pad_t10">
                                <p>
                                    I recently completed another course from the 365 team "Data Science Boot Camp" where
                                    I was able to review my college course work taken many years ago in statistics along
                                    with an overview of programming languages (Python) I use regularly.
                                </p>
                                <p class="post_reply mar_t5">Reply</p>
                            </div>
                        </div>
                        <!-- comment -->

                        <!-- reply -->
                        <div class="cmnt_box_all reply_sec">
                            <div class="cmnt_box_top dis_flx">
                                <div class="cmnt_box_top_left d-flex">
                                    <div class="cmnt_img mar_r15">
                                        <img src="img/girl2-cmnt.jpg" alt="image">
                                    </div>
                                    <div class="cmnnt_name">
                                        <div class="cmnt_name_left dis_fx_cntr">
                                            <h4 class="tchr_nam mar_b10">Liam Dawson</h4>
                                        </div>
                                        <div class="cmnt_name_right">
                                            <p class="cmnt_name_right_p">06 Nov 2019 AT 11:23 PM</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="cmnnt_p pad_t10">
                                <p>
                                    Great course. Excellent introduction. Pretty fast paced. And while I was new to the
                                    field I had to do some exploration next to the explanations provided within the
                                    course.
                                </p>
                                <p class="post_reply mar_t5">Reply</p>
                            </div>
                        </div>
                        <div class="cmnt_box_all reply_sec">
                            <div class="cmnt_box_top d-flex">
                                <div class="cmnt_box_top_left d-flex">
                                    <div class="cmnt_img mar_r15">
                                        <img src="img/girl3-cmnt.jpg" alt="image">
                                    </div>
                                    <div class="cmnnt_name">
                                        <div class="cmnt_name_left dis_fx_cntr">
                                            <h4 class="tchr_nam mar_b10">Jake Ball</h4>
                                            <div class="cmnt_name_left_rating">
                                            </div>
                                        </div>
                                        <div class="cmnt_name_right">
                                            <p class="cmnt_name_right_p">07 Nov 2019 AT 05:23 AM</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="cmnnt_p pad_t10">
                                <p>
                                    Great to understand the mechanics, mathematics and also statistics in back of BI. I
                                    really liked it, and the exercises are great to confirm the knowledge.
                                </p>
                                <p class="post_reply mar_t5">Reply</p>
                            </div>
                        </div>
                        <!-- reply -->

                        <!-- comment -->
                        <div class="cmnt_box_all">
                            <div class="cmnt_box_top dis_flx">
                                <div class="cmnt_box_top_left d-flex">
                                    <div class="cmnt_img mar_r15">
                                        <img src="img/girl4-cmnt.jpg" alt="image">
                                    </div>
                                    <div class="cmnnt_name">
                                        <div class="cmnt_name_left">
                                            <h4 class="tchr_nam mar_b10">Olly Stone</h4>
                                        </div>
                                        <div class="cmnt_name_right">
                                            <p class="cmnt_name_right_p">11 Nov 2019 AT 09:12 AM</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="cmnnt_p pad_t10">
                                <p>
                                    It was a decent match, I hate to say this because it was already very long but
                                    honestly it probably should have been 1 - 3 hours longer to include more
                                    explanations of SQL/MySQL, Python and Tableau.
                                </p>
                                <p class="post_reply mar_t5">Reply</p>
                            </div>
                        </div>
                        <!-- comment -->

                        <!-- iteam -->
                        <div class="cmnt_box_all reply_sec">
                            <div class="cmnt_box_top dis_flx">
                                <div class="cmnt_box_top_left d-flex">
                                    <div class="cmnt_img mar_r15">
                                        <img src="img/girl2-cmnt.jpg" alt="image">
                                    </div>
                                    <div class="cmnnt_name">
                                        <div class="cmnt_name_left">
                                            <h4 class="tchr_nam mar_b10">Jofra Archer</h4>
                                        </div>
                                        <div class="cmnt_name_right">
                                            <p class="cmnt_name_right_p">11 Dec 2019 AT 07:45 AM</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="cmnnt_p pad_t10">
                                <p>
                                    I am on 50% of the course. So far I am very happy about the course. very succinct,
                                    practical and straight to the point. I am looking forward to complete this course so
                                    I can move onto data science
                                </p>
                                <p class="post_reply mar_t5">Reply</p>
                            </div>
                        </div>
                        <!-- iteam -->
                    </div>

                    <!--WRITE COMMENT BOX -->
                    <div class="cmnt_frm mar_t30">
                        <h2 class="post_dtls_title2 pad_b20">Leave A Comment</h2>
                        <div class="cmnt_frm_all">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="cmnt_input">
                                        <p>NAME</p>
                                        <input type="text" placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <div class="cmnt_input">
                                        <p>E-MAIL</p>
                                        <input type="text" placeholder="Enter your E-MAIL">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="cmnt_input">
                                        <p class="mar_b10">MESSAGE</p>
                                        <textarea placeholder="Type your comment" name="message" required=""></textarea>
                                    </div>
                                </div>
                                <div class="dtls_frm_btn mar_t20">
                                    <button class="btn1">send message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--WRITE COMMENT BOX -->
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-3">
                <div class="blog_post_r8">
                    <h4 class="trnd_artcl_h4">Related Articles</h4>
                    <div class="blog_post_r8_all">
                        <!-- iteam -->
                        @if (count($relatedBlogs) >0)
                        @foreach ($relatedBlogs as $blog)
                        <div class="blog_post_r8_item">
                            <div class="blog_post_item_lft">
                                <img src="img/man3.jpg" alt="image">
                            </div>
                            <div class="blog_post_item_r8">
                                <a href="{{route('blog.single', $blog->slug)}}">
                                    <h4 class="blog_post_item_r8_h4">
                                        {{$blog->title}}
                                    </h4>
                                </a>
                                <a href="">
                                    <p class="author_name2">-{{$blog->user->fullName}}</p>
                                </a>
                            </div>
                        </div>
                        <!-- iteam -->
                        @endforeach

                        @endif




                    </div>
                    <div class="course_price mar_t60">
                        <div class="course_price_top">
                            <p>Share this post</p>
                        </div>
                        <div class="course_price_main" style="padding: 30px 0px 30px 17px">
                            <ul class="share_social_ul dis_flx">
                                <li>
                                    <a class="fb" href="">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="google" href="">
                                        <i class="fab fa-google-plus-g"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="instgrm" href="">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="twtr" href="">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="skpye" href="">
                                        <i class="fab fa-skype"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="utube" href="">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>
                                <!-- 		<li>
											<a class="lnkdn" href="">
												<i class="fab fa-linkedin-in"></i>
											</a>
										</li>
										<li>
											<a class="pinstr" href="">
												<i class="fab fa-pinterest"></i>
											</a>
										</li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="post_tags">
                        <h3 class="post_tags_h3">Tags</h3>
                        <ul class="post_tags_ul">
                            @if (count($blogDetails->tag) > 0)
                            @foreach ($blogDetails->tag as $tag)
                            <li>
                                <a href="">{{$tag->tagName}}</a>
                            </li>
                            @endforeach

                            @endif


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
