<style>
    /* Initially set the slider to be hidden off-screen on the right */
    .slider-form {
        position: fixed;
        top: 0;
        right: -100%;
        /* Hide off-screen initially */
        width: 100%;
        height: 100%;
        background-color: #f8f9fa;
        transition: right 0.3s ease;
        z-index: 1050;
        box-shadow: -4px 0px 8px rgba(0, 0, 0, 0.2);
        overflow: scroll;
    }

    /* Show the slider when active (slide in from the right) */
    .slider-form.open {
        right: 0;
    }

    /* Form content styling */
    .slider-content {
        padding: 30px;
    }

    /* Adjust the width of the form based on screen size */
    @media (max-width: 767px) {
        .slider-form {
            width: 100%;
            /* Full width on small screens */
        }
    }

    @media (min-width: 768px) {
        .slider-form {
            width: 75%;
            /* 75% width on medium and larger screens */
        }
    }
    .star-rating {
        font-size: 24px;
        cursor: pointer;
        color: #ccc;
    }
    
</style>
<div>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                @if(auth()->user()->bg_image)
                    <img class="w-100 h-250 object-fit-cover rounded-4" src="{{ asset('storage/'.auth()->user()->bg_image) }}">
                @else
                    <img class="w-100 h-250 object-fit-cover rounded-4" src="{{ asset('assets/bg/bg_profile.png') }}">
                @endif
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-2 col-md-3 mb-3 col-6 position-relative" style="margin-top:-70px">
                        @if(auth()->user()->profile_image)
                            <img class="w-100 ms-md-4 h-100" src="{{ asset('storage/'.auth()->user()->profile_image) }}">
                        @else
                            <img class="w-100 ms-md-4 h-100" src="{{ asset('assets/image/profile.png') }}">
                        @endif
                    </div>
                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex align-items-center ms-md-2">
                            <span class="fw-bold fs-4 m-2">{{ auth()->user()->name }}</span>
                            
                        </div>
                        <div class="ms-md-3 mt-2">
                            Individual
                        </div>
                    </div>
                    <div class="col-md-5 p-3">
                        <div class="d-lg-flex justify-content-end align-items-end float-md-end">
                            {{-- <a id="openReviewSliderBtn" class="btn bg-secondary-subtle me-2">

                                <svg class="me-2" width="18" height="20" viewBox="0 0 18 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.7281 19.9137C8.83884 19.9715 8.96266 20.0009 9.08649 20C9.21032 19.999 9.33314 19.9686 9.44489 19.9097L13.0128 18.0025C14.0245 17.4631 14.8168 16.8601 15.435 16.1579C16.779 14.6282 17.5129 12.6758 17.4998 10.6626L17.4575 4.02198C17.4535 3.25711 16.9511 2.57461 16.2082 2.32652L9.57073 0.0995642C9.17106 -0.0357592 8.73313 -0.0328174 8.3405 0.106428L1.72824 2.41281C0.989299 2.67071 0.495998 3.35811 0.500024 4.12396L0.542307 10.7597C0.555395 12.7758 1.31448 14.7194 2.68062 16.2334C3.3048 16.9258 4.10415 17.52 5.12699 18.0505L8.7281 19.9137ZM7.78119 12.1106C7.93019 12.2538 8.12348 12.3244 8.31678 12.3225C8.51007 12.3215 8.70236 12.2489 8.84934 12.1038L12.7484 8.25981C13.0414 7.97053 13.0384 7.50572 12.7424 7.22037C12.4454 6.93501 11.9672 6.93697 11.6742 7.22625L8.3057 10.5466L6.92647 9.2208C6.62949 8.93545 6.15229 8.93839 5.85832 9.22767C5.56536 9.51694 5.56838 9.98175 5.86537 10.2671L7.78119 12.1106Z"
                                        fill="black" />
                                </svg>
                                Expert Review
                            </a> --}}
                            <a href="{{ route('user.edit') }}" class="btn btn-dark">
                                <svg class="me-2" width="21" height="21" viewBox="0 0 21 21" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.3203 19.7912H19.8751" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.3125 2.45291C12.1205 1.48728 13.5729 1.34568 14.5586 2.13722C14.6131 2.18016 16.364 3.5404 16.364 3.5404C17.4469 4.19499 17.7833 5.58657 17.114 6.64853C17.0784 6.7054 7.17911 19.088 7.17911 19.088C6.84977 19.4989 6.34983 19.7414 5.81553 19.7472L2.02451 19.7948L1.17034 16.1795C1.05069 15.6711 1.17034 15.1373 1.49969 14.7264L11.3125 2.45291Z"
                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9.47656 4.75L15.156 9.11159" stroke="white" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <button class="badge rounded-pill text-bg-dark fs-6 p-3 m-1">Product Whishlist</button>
                <button class="badge rounded-pill text-bg-light fs-6 p-3 m-1">Service Whishlist</button>
            </div>
            <div class="col-12 mt-3 mb-5">
                <div class="row">
                    <div class=" col-12 text-center">
                        <img src="{{ asset('assets/image/empty.png') }}">
                    </div>
                    <div class="text-center col-12">
                        <i class="d-block">Your wishlist is looking a little lonely!</i>
                        <i>Start exploring and add your favourites!</i>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- @include('livewire.service.partial.service-slider') --}}
    {{-- @include('livewire.service.partial.review-slider') --}}
</div>

<script>
    // Toggle slider form on button click
    //product slider
    const openSliderBtn = document.getElementById("openSliderBtn");
    const sliderForm = document.querySelector(".slider-form");
    const closeSliderBtn = document.getElementById("closeSliderBtn");

    openSliderBtn.addEventListener("click", function() {
        sliderForm.classList.toggle("open");
    });

    closeSliderBtn.addEventListener("click", function() {
        sliderForm.classList.remove("open");
    });

    //review slider
    const openReviewSliderBtn = document.getElementById("openReviewSliderBtn");
    const reviewSliderForm = document.getElementById("reviewSlider");
    const closeReviewSliderBtn = document.getElementById("closeReviewSliderBtn");

    openReviewSliderBtn.addEventListener("click", function() {
        reviewSliderForm.classList.toggle("open");
    });

    closeReviewSliderBtn.addEventListener("click", function() {
        reviewSliderForm.classList.remove("open");
    });

    const stars = document.querySelectorAll('.star-rating i');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            let value = this.getAttribute('data-value');
            // ratingValue.innerText = value;

            // Update star colors
            stars.forEach((s, index) => {
                if (index < value) {
                    s.classList.add('text-success');
                    // s.classList.remove('fa-star-o');
                } else {
                    // s.classList.add('fa-star-o');
                    s.classList.remove('text-success');
                }
            });
        });
    });
</script>
