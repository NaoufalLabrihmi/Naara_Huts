@extends('frontend.main_master')
@section('main')

<!-- Inner Banner -->
<div class="inner-banner inner-bg3">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Gallery</li>
            </ul>
            <h3>Gallery</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->
<style>
    /* Gallery Overlay */
    .gallery-item {
        position: relative;
        overflow: hidden;
    }

    .gallery-item img {
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.1);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.7);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-icon {
        color: #fff;
        font-size: 36px;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .gallery-icon:hover {
        transform: scale(1.2);
    }
</style>

<!-- Gallery Area -->
<div class="gallery-area pt-100 pb-70">
    <div class="container">
        <div class="gallery-view">
            <div class="row justify-content-center">


                @foreach ($gallery as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="gallery-item">
                        <img src="{{ asset($item->photo_name) }}" class="img-fluid" alt="Gallery Image">
                        <div class="gallery-overlay">
                            <a href="{{ asset($item->photo_name) }}" class="gallery-icon">
                                <i class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
</div>


<!-- Gallery Area End -->


@endsection