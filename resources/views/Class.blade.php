@extends('layout/masterLayout')
@section('content')

<section class="class spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="class__form">
                    <div class="section-title">
                        <span>Class cakes</span>
                        <h2>Made from your <br />own hands</h2>
                    </div>
                    <form action="{{route('classcakes')}}" method="POST">
                        @csrf
                        <input type="text" name="name" value="" placeholder="Name">
                        <input type="text" name="phone" value="" placeholder="Phone">
                        <select name="class">
                            <option value="Studying Class">Studying Class</option>
                            <option value="Writting Class">Writting Class</option>
                            <option value="Reading Class">Reading Class</option>
                        </select>
                        <input type="text" name="requirements" value="" placeholder="Type your requirements">
                        <button type="submit" class="site-btn">registration</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@section('title')
    Class
@endsection
