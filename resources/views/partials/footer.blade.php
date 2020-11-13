<section class="footer">
    <div class="footercol">
        <div class="container">
            <div class="ftrlogo"><img src="{{ asset('images/website/logo.png') }}"></div>

            <div class="row">
                <div class="col-md-4">
                    <h5>let us spoil you with the latest offers</h5>
                    <div class="inputform">
                        <div class="alert alert-danger newsletter_error_msg" id="footer-alert-danger"></div>
                        <div class="alert alert-success newsletter_success_msg" id="footer-alert-success"></div>
                        <input type="email" name="email" id="email" required value="" placeholder="Your email address">
                        <button id="signup">SIGN UP</button>
                    </div>
                    <h6>Please view our <a href="{{route('cmspages','privacy')}}">Privacy Policy</a> to see how we use
                        information.</h6>
                </div>
                <div class="col-md-3">
                    <h5>support</h5>

                    <ul>
                        <li class="hellomail"><a href="mailto:hello@solo60.com">hello@solo60.com</a></li>
                        <li><a href="{{route('cmspages','rules')}}">House Rules</a></li>
                        <li><a href="{{route('cmspages','cancellation')}}">Cancellation Policy</a></li>
                        <li><a href="{{route('cmspages','faq')}}">FAQ</a></li>


                    </ul>
                </div>

                <div class="col-md-2">
                    <h5>investors</h5>

                    <ul>
                        <li><a href="https://www.crunchbase.com/organization/solo60" target="_blank">Crunchbase</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5>social</h5>

                    <ul class="social_col">
                        <li class="fb"><a href="{{$socialLinks['facebook_url']}}" target="_blank"></a></li>
                        <li class="tweet"><a href="{{$socialLinks['twitter_url']}}" target="_blank"></a></li>
                        <li class="insta"><a href="{{$socialLinks['instagram_url']}}" target="_blank"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="copy">
    <div class="container">
        <div class=""><a href="{{route('cmspages','privacy')}}">Privacy Policy</a> <a
                    href="{{route('cmspages','terms')}}">Terms & Conditions</a></div>
        <div class="copytext"> &copy; Copyright {{date('Y')}} Solo60. All rights reserved.</div>
    </div>
</div>
<script src="{{ asset('js/website/jquery-2.2.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/website/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/website/slick.js') }}" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
    $(document).on('ready', function () {

        $(".variable").slick({
            infinite: true,
            variableWidth: true,
            autoplay: true,
            speed: 300,
            slidesToScroll: 1,
            speed: 1000,
            responsive: [
                {
                    breakpoint: 700,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        variableWidth: false,
                        autoplay: true
                    }
                }

            ]
        });
        $(document).on("click","#singup_middle",function() {
            var email=$("#email_middle").val();
            $.ajax({
                url: "{{ route("subscribe") }}",
                type: 'post',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: email
                },
                success: function (data) {
                    $.each(data.success, function(key, value){
                        $('#middle-alert-danger').hide();
                        $('#middle-alert-success').show();
                        $('#middle-alert-success').html(value);
                    });
                },
                error: function (data) {
                    $.each(data.responseJSON.errors, function(key, value){
                        $('#middle-alert-success').hide();
                        $('#middle-alert-danger').show();
                        $('#middle-alert-danger').html(value);
                    });
                }
            });
        });
        $(document).on("click","#signup",function() {
            var email=$("#email").val();
            $.ajax({
                url: "{{ route("subscribe") }}",
                type: 'post',
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    email: email
                },
                success: function (data) {
                    $.each(data.success, function(key, value){
                        $('#footer-alert-danger').hide();
                        $('#footer-alert-success').show();
                        $('#footer-alert-success').html(value);
                    });
                },
                error: function (data) {
                    $.each(data.responseJSON.errors, function(key, value){
                        $('#footer-alert-success').hide();
                        $('#footer-alert-danger').show();
                        $('#footer-alert-danger').html(value);
                    });
                }
            });
        });
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() >= 900) {

            $(".discover").addClass("active");

        }

    });


    $(window).scroll(function () {
        if ($(window).scrollTop() >= 400) {

            $(".fadecol").addClass("active");

        }

    });


</script>


<script>
    $(document).ready(function () {
        // Add smooth scrolling to all links
        $("a.btn_r").on('click', function (event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function () {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });
</script>
<script id="rendered-js">
    (function () {
        var Util,
            __bind = function (fn, me) {
                return function () {
                    return fn.apply(me, arguments);
                };
            };

        Util = function () {
            function Util() {
            }

            Util.prototype.extend = function (custom, defaults) {
                var key, value;
                for (key in custom) {
                    value = custom[key];
                    if (value != null) {
                        defaults[key] = value;
                    }
                }
                return defaults;
            };

            Util.prototype.isMobile = function (agent) {
                return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(agent);
            };

            return Util;

        }();

        this.WOW = function () {
            WOW.prototype.defaults = {
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: true
            };


            function WOW(options) {
                if (options == null) {
                    options = {};
                }
                this.scrollCallback = __bind(this.scrollCallback, this);
                this.scrollHandler = __bind(this.scrollHandler, this);
                this.start = __bind(this.start, this);
                this.scrolled = true;
                this.config = this.util().extend(options, this.defaults);
            }

            WOW.prototype.init = function () {
                var _ref;
                this.element = window.document.documentElement;
                if ((_ref = document.readyState) === "interactive" || _ref === "complete") {
                    return this.start();
                } else {
                    return document.addEventListener('DOMContentLoaded', this.start);
                }
            };

            WOW.prototype.start = function () {
                var box, _i, _len, _ref;
                this.boxes = this.element.getElementsByClassName(this.config.boxClass);
                if (this.boxes.length) {
                    if (this.disabled()) {
                        return this.resetStyle();
                    } else {
                        _ref = this.boxes;
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                            box = _ref[_i];
                            this.applyStyle(box, true);
                        }
                        window.addEventListener('scroll', this.scrollHandler, false);
                        window.addEventListener('resize', this.scrollHandler, false);
                        return this.interval = setInterval(this.scrollCallback, 50);
                    }
                }
            };

            WOW.prototype.stop = function () {
                window.removeEventListener('scroll', this.scrollHandler, false);
                window.removeEventListener('resize', this.scrollHandler, false);
                if (this.interval != null) {
                    return clearInterval(this.interval);
                }
            };

            WOW.prototype.show = function (box) {
                this.applyStyle(box);
                return box.className = "" + box.className + " " + this.config.animateClass;
            };

            WOW.prototype.applyStyle = function (box, hidden) {
                var delay, duration, iteration;
                duration = box.getAttribute('data-wow-duration');
                delay = box.getAttribute('data-wow-delay');
                iteration = box.getAttribute('data-wow-iteration');
                return box.setAttribute('style', this.customStyle(hidden, duration, delay, iteration));
            };

            WOW.prototype.resetStyle = function () {
                var box, _i, _len, _ref, _results;
                _ref = this.boxes;
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    box = _ref[_i];
                    _results.push(box.setAttribute('style', 'visibility: visible;'));
                }
                return _results;
            };

            WOW.prototype.customStyle = function (hidden, duration, delay, iteration) {
                var style;
                style = hidden ? "visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;" : "visibility: visible;";
                if (duration) {
                    style += "-webkit-animation-duration: " + duration + "; -moz-animation-duration: " + duration + "; animation-duration: " + duration + ";";
                }
                if (delay) {
                    style += "-webkit-animation-delay: " + delay + "; -moz-animation-delay: " + delay + "; animation-delay: " + delay + ";";
                }
                if (iteration) {
                    style += "-webkit-animation-iteration-count: " + iteration + "; -moz-animation-iteration-count: " + iteration + "; animation-iteration-count: " + iteration + ";";
                }
                return style;
            };

            WOW.prototype.scrollHandler = function () {
                return this.scrolled = true;
            };

            WOW.prototype.scrollCallback = function () {
                var box;
                if (this.scrolled) {
                    this.scrolled = false;
                    this.boxes = function () {
                        var _i, _len, _ref, _results;
                        _ref = this.boxes;
                        _results = [];
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                            box = _ref[_i];
                            if (!box) {
                                continue;
                            }
                            if (this.isVisible(box)) {
                                this.show(box);
                                continue;
                            }
                            _results.push(box);
                        }
                        return _results;
                    }.call(this);
                    if (!this.boxes.length) {
                        return this.stop();
                    }
                }
            };

            WOW.prototype.offsetTop = function (element) {
                var top;
                top = element.offsetTop;
                while (element = element.offsetParent) {
                    top += element.offsetTop;
                }
                return top;
            };

            WOW.prototype.isVisible = function (box) {
                var bottom, offset, top, viewBottom, viewTop;
                offset = box.getAttribute('data-wow-offset') || this.config.offset;
                viewTop = window.pageYOffset;
                viewBottom = viewTop + this.element.clientHeight - offset;
                top = this.offsetTop(box);
                bottom = top + box.clientHeight;
                return top <= viewBottom && bottom >= viewTop;
            };

            WOW.prototype.util = function () {
                return this._util || (this._util = new Util());
            };

            WOW.prototype.disabled = function () {
                return !this.config.mobile && this.util().isMobile(navigator.userAgent);
            };

            return WOW;

        }();

    }).call(this);


    wow = new WOW(
        {
            animateClass: 'animated',
            offset: 100
        });


    wow.init();
    //# sourceURL=pen.js
</script>