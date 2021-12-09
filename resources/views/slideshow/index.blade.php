@extends("layouts.app")

@section("body")

    <div id="image-slider" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach($images as $image)
                    <li class="splide__slide" style="display: flex; justify-content: center;">
                            <img src="{{$image}}">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
