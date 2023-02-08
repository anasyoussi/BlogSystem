<footer>
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">

                    <!-- <a class="logo" href="#"><img src="assets/frontend/images/logo.png" alt="Logo Image"></a> -->
                    <a class="logo" href="{{ route('home') }}">./Blog</a>
                    <p class="copyright">Bona @ <script>new Date().getFullYear();</script>. All rights reserved.</p>
                    <p class="copyright">Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a>.Downloaded from <a href="https://themeslab.org/" target="_blank">Themeslab</a></p>
                    <ul class="icons">
                        <li><a href="#"><i class="ion-social-facebook-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-vimeo-outline"></i></a></li>
                        <li><a href="#"><i class="ion-social-pinterest-outline"></i></a></li>
                    </ul>

                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                    <div class="footer-section">
                    <h4 class="title"><b>CATAGORIES</b></h4>
                    <ul>
                        <!--  foreach($categories as $cat)
                            <li><a href="  route('category.posts', $cat->slug)  ">  $cat->name  </a></li>
                         endforeach -->
                    </ul>
                    <ul>
                        <li><a href="#">BEAUTY</a></li>
                        <li><a href="#">HEALTH</a></li>
                        <li><a href="#">MUSIC</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">SPORT</a></li>
                        <li><a href="#">DESIGN</a></li>
                        <li><a href="#">TRAVEL</a></li>
                    </ul>
                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">

                    <h4 class="title"><b>SUBSCRIBE</b></h4>
                    <div class="input-area">
                        <form method="POST" action="{{ route('subscriber.store') }}">
                            @csrf
                            <input class="email-input" name="email" type="text" placeholder="Enter your email">
                            <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                        </form>
                    </div>

                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

        </div><!-- row -->
    </div><!-- container -->
</footer> 