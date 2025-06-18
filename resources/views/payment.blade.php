@extends('layout/masterLayout')
@section('content')

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="map">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-4 col-md-7">
                        @if(session('success'))
                        <h3>{{ session('success') }}</h3>
                        @endif
                        @if(session('error'))
                        <h3 style="color:red;">{{ session('error') }}</h3>
                        @endif

                        <form action="{{ route('payment.process') }}" method="POST">
                            @csrf
                            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="{{ config('services.stripe.key') }}" data-amount="1000"
                                data-name="Laravel Payment" data-description="Sample Charge" data-currency="usd">
                                </script>
                        </form>
                    </div>
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
