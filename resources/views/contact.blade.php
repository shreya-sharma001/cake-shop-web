@extends('layout/masterLayout')
@section('content')

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="map">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-4 col-md-7">
                            <div class="map__inner">
                                <h6>COlorado</h6>
                                <ul>
                                    <li>1000 Lakepoint Dr, Frisco, CO 80443, USA</li>
                                    <li><a href="https://preview.colorlib.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="8ad9fdefeffee9ebe1efcaf9fffafae5f8fea4e9e5e7">[email&#160;protected]</a>
                                    </li>
                                    <li>+1 800-786-1000</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="map__iframe">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d10784.188505644011!2d19.053119335158936!3d47.48899529453826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1543907528304"
                        height="300" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
            <div class="contact__address">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact__address__item">
                            <h6>san bernardino</h6>
                            <ul>
                                <li>
                                    <span class="icon_pin_alt"></span>
                                    <p>795 W 5th St, San Bernardino, CA 92410, USA</p>
                                </li>
                                <li><span class="icon_headphones"></span>
                                    <p>+1 800-786-1000</p>
                                </li>
                                <li><span class="icon_mail_alt"></span>
                                    <p><a href="https://preview.colorlib.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="04577361617067656f6144777174746b76702a676b69">[email&#160;protected]</a>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact__address__item">
                            <h6>Los angeles</h6>
                            <ul>
                                <li>
                                    <span class="icon_pin_alt"></span>
                                    <p>639 S Spring St, Los Angeles, CA 90014, USA</p>
                                </li>
                                <li><span class="icon_headphones"></span>
                                    <p>+1 213-612-3000</p>
                                </li>
                                <li><span class="icon_mail_alt"></span>
                                    <p><a href="https://preview.colorlib.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="fead899b9b8a9d9f959bbe8d8b8e8e918c8ad09d9193">[email&#160;protected]</a>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact__address__item">
                            <h6>san bernardino</h6>
                            <ul>
                                <li>
                                    <span class="icon_pin_alt"></span>
                                    <p>1000 Lakepoint Dr, Frisco, CO 80443, USA</p>
                                </li>
                                <li><span class="icon_headphones"></span>
                                    <p>+1 800-786-1000</p>
                                </li>
                                <li><span class="icon_mail_alt"></span>
                                    <p><a href="https://preview.colorlib.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="b8ebcfddddccdbd9d3ddf8cbcdc8c8d7cacc96dbd7d5">[email&#160;protected]</a>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact__text">
                        <h3>Contact With us</h3>
                        <ul>
                            <li>Representatives or Advisors are available:</li>
                            <li>Mon-Fri: 5:00am to 9:00pm</li>
                            <li>Sat-Sun: 6:00am to 9:00pm</li>
                        </ul>
                        <img src="img/cake-piece.png" alt="">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="contact__form">
                        <form action="{{route('addEmail')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" value="" placeholder="Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" value="" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="message" placeholder="Message"></textarea>
                                    <button type="submit" class="site-btn">Send Us</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

@endsection

@section('title')
    contact
@endsection
