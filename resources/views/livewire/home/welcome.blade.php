<div>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 text-center rounded-4 position-relative"
                style="background-image: url({{ asset('assets/bg/grey_bar.png') }});background-repeat: no-repeat; background-size: cover">
                <div class="p-3">
                    I am looking for
                </div>
                <div class="d-flex justify-content-center mb-4">
                    <div class="d-flex justify-content-between bg-white rounded-5 p-2 border" style="width:fit-content">
                        <button type="button"
                            class="btn rounded-5 @if ($section == 'product') btn-dark @endif email-toggle-btn ps-4 pe-4 pt-2 pb-2"
                            data-item="email" wire:click="setSection('product')">Material</button>
                        <button type="button"
                            class="btn rounded-5 @if ($section == 'service') btn-dark @endif  email-toggle-btn pt-2 pb-2 ps-4 pe-4"
                            data-item="phone" wire:click="setSection('service')">Services</button>
                    </div>
                </div>
                <div class="d-md-flex position-relative justify-content-center mb-4">
                    <div class="bg-white rounded-5 p-2 border me-2" x-data="{ focused: false }"
                        :class="{ 'border-2 border-dark': focused }">
                        <input class="form-select rounded-5 mt-1 border border-0 bg-white" name="city" placeholder="City" @focus="focused = true" @blur="focused = false" wire:click="toggle" wire:model.live="selectedCity" />
                    </div>
                    @if ($isOpen)
                        <div class="position-absolute mt-2 w-sp shadow bg-white border rounded-4 p-3"
                            style="z-index: 1050; max-height: 300px; overflow-y: auto;top:65px">
                            @if (count($cities) > 0)
                                <div class="row row-cols-2 row-cols-md-4 g-2">
                                    @foreach ($cities as $city)
                                        <div>
                                            <button type="button" class="btn btn-light w-100 text-start"
                                                wire:click="selectCity('{{ $city }}')">
                                                {{ $city }}
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center text-muted">No results found</div>
                            @endif
                        </div>
                    @endif
                    <div class="d-flex align-items-center justify-content-between bg-white rounded-5 p-2 border mt-2 mt-md-0"
                        x-data="{ focused: false }" :class="{ 'border-2 border-dark': focused }">
                        <svg class="mx-2" width="40" height="40" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.39687 14.7937C5.32954 14.7937 3.5799 14.0778 2.14794 12.6458C0.715979 11.2138 0 9.4642 0 7.39687C0 5.32954 0.715979 3.5799 2.14794 2.14794C3.5799 0.715979 5.32954 0 7.39687 0C9.4642 0 11.2138 0.715979 12.6458 2.14794C14.0778 3.5799 14.7937 5.32954 14.7937 7.39687C14.7937 8.23139 14.661 9.01849 14.3954 9.75818C14.1299 10.4979 13.7696 11.1522 13.3144 11.7212L19.6871 18.0939C19.8957 18.3025 20 18.568 20 18.8905C20 19.2129 19.8957 19.4784 19.6871 19.6871C19.4784 19.8957 19.2129 20 18.8905 20C18.568 20 18.3025 19.8957 18.0939 19.6871L11.7212 13.3144C11.1522 13.7696 10.4979 14.1299 9.75818 14.3954C9.01849 14.661 8.23139 14.7937 7.39687 14.7937ZM7.39687 12.5178C8.81935 12.5178 10.0284 12.0199 11.0242 11.0242C12.0199 10.0284 12.5178 8.81935 12.5178 7.39687C12.5178 5.9744 12.0199 4.76529 11.0242 3.76956C10.0284 2.77383 8.81935 2.27596 7.39687 2.27596C5.9744 2.27596 4.76529 2.77383 3.76956 3.76956C2.77383 4.76529 2.27596 5.9744 2.27596 7.39687C2.27596 8.81935 2.77383 10.0284 3.76956 11.0242C4.76529 12.0199 5.9744 12.5178 7.39687 12.5178Z"
                                fill="#CCCCCC" />
                        </svg>
                        <input wire:model="productName" class="form-control border border-0 rounded-5 me-2 bg-white" type="text" placeholder="Search" @focus='focused = true' @blur="focused = false" wire:keyup="searchRestart()">
                        <button type="button" class="btn rounded-5 email-toggle-btn pt-2 pb-2 ps-4 pe-4" :class="{ 'btn-dark': focused, 'btn-secondary': !focused }" wire:click="searchProduct()">Search</button>
                    </div>
                </div>
                @if ($searchStarted)
                <a href="{{ route('home') }}" role="button" class="position-absolute top-0 start-0 p-2 ps-2"
                    style="z-index: 1">
                    <svg width="40" height="40" viewBox="0 0 50 50" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="-1" y="1" width="47" height="47" rx="24"
                            transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" />
                        <path
                            d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z"
                            fill="black" />
                    </svg>
                </a>
                @endif
            </div>

            @if (empty($sellers))
                <div class="col-md-12 text-center" wire:show="section == 'product'" x-transition.duration.500ms>
                    <div class="h3 fw-bold mt-5">Top Material Categories</div>
                    <span>Your one-stop destination for premium building materials <br> from trusted sellers in your
                        area.</span>
                    <div class="row mt-5 text-md-start justify-content-center">
                        @foreach ($data as $item)
                            <div class="col-md-3 col-lg-2 col-3 text-break" role="button"
                                wire:click="searchProduct({{ $item->id }})">
                                <img class="w-100 category-image"
                                    src="{{ asset('assets/material/' . strtolower(str_replace(' ', '_', $item->title)) . '.png') }}">
                                <p>{{ $item->title }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-12 text-center" wire:show="section == 'service'" x-transition.duration.500ms>
                    <div class="h3 fw-bold mt-5">Top Service Providers</div>
                    <span>Discover skilled experts and reliable services to make <br> your construction projects
                        hassle-free</span>
                    <div class="row mt-5 text-md-start justify-content-center">
                        @foreach ($data as $item)
                            <div role="button" class="col-md-3 col-lg-2 col-3 text-break"
                                wire:click="searchProduct({{ $item->id }})">
                                <img class="w-100 category-image"
                                    src="{{ asset('assets/material/' . strtolower(str_replace(' ', '_', $item->title)) . '.png') }}">
                                <p>{{ $item->title }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (count($sellers) > 0)
                <div class="container py-4">
                    <h5 class="mb-4">
                        Top Sellers for <strong>{{ $productName }}</strong>
                    </h5>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        @foreach ($sellers as $seller)
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    <div class="ratio ratio-21x9">
                                        @if ($seller->bg_image)
                                            <img src="{{ asset('storage/' . $seller->bg_image) }}" class="card-img-top h-100"
                                                alt="{{ $seller['name'] }}">
                                        @else
                                            <picture>
                                                <source media="(max-width: 767px)"
                                                    srcset="{{ asset('assets/image/mobile/banner_0' . rand(1, 8) . '.png') }}">
                                                <img class="card-img-top h-100"
                                                    src="{{ asset('assets/image/desktop/banner_0' . rand(1, 8) . '.png') }}"
                                                    alt="Banner">
                                            </picture>
                                        @endif
                                    </div>
                                    <div style="margin-top:-50px;z-index:5">
                                        @if ($seller->profile_image)
                                            <img src="{{ asset('storage/' . $seller->profile_image) }}"
                                                alt="{{ $seller['name'] }}" class="mx-auto d-block rounded"
                                                style="height: 100px; width: 100px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/image/profile.png') }}"
                                                alt="{{ $seller['name'] }}" class="mx-auto d-block rounded"
                                                style="height: 100px; width: 100px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5 class="card-title fw-bolder">{{ $seller->name }}</h5>
                                        </div>

                                        <div class="d-flex align-items-center mb-2">
                                            @if ($seller?->ratings?->total_score)
                                                <span
                                                    class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                                    <svg class="me-2" width="20" height="20"
                                                        viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15.9189 12.32C15.6599 12.571 15.5409 12.934 15.5999 13.29L16.4889 18.21C16.5639 18.627 16.3879 19.049 16.0389 19.29C15.6969 19.54 15.2419 19.57 14.8689 19.37L10.4399 17.06C10.2859 16.978 10.1149 16.934 9.93988 16.929H9.66888C9.57488 16.943 9.48288 16.973 9.39888 17.019L4.96888 19.34C4.74988 19.45 4.50188 19.489 4.25888 19.45C3.66688 19.338 3.27188 18.774 3.36888 18.179L4.25888 13.259C4.31788 12.9 4.19888 12.535 3.93988 12.28L0.328876 8.78C0.0268758 8.487 -0.0781242 8.047 0.0598758 7.65C0.193876 7.254 0.535876 6.965 0.948876 6.9L5.91888 6.179C6.29688 6.14 6.62888 5.91 6.79888 5.57L8.98888 1.08C9.04088 0.98 9.10788 0.888 9.18888 0.81L9.27888 0.74C9.32588 0.688 9.37988 0.645 9.43988 0.61L9.54888 0.57L9.71888 0.5H10.1399C10.5159 0.539 10.8469 0.764 11.0199 1.1L13.2389 5.57C13.3989 5.897 13.7099 6.124 14.0689 6.179L19.0389 6.9C19.4589 6.96 19.8099 7.25 19.9489 7.65C20.0799 8.051 19.9669 8.491 19.6589 8.78L15.9189 12.32Z"
                                                            fill="#22B14D" />
                                                    </svg>
                                                    {{ $seller->ratings->total_score }}
                                                </span>
                                            @endif

                                            <span
                                                class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">

                                                <svg class="me-2" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_287_3784)">
                                                        <path
                                                            d="M10.0026 0.828125C8.18961 0.828125 6.41733 1.36574 4.90988 2.37299C3.40243 3.38023 2.22752 4.81187 1.53371 6.48686C0.839909 8.16185 0.658379 10.005 1.01208 11.7831C1.36577 13.5613 2.23881 15.1946 3.5208 16.4766C4.80278 17.7586 6.43612 18.6316 8.21428 18.9853C9.99244 19.339 11.8356 19.1575 13.5105 18.4637C15.1855 17.7699 16.6172 16.595 17.6244 15.0875C18.6317 13.5801 19.1693 11.8078 19.1693 9.99479C19.1664 7.56452 18.1997 5.23461 16.4813 3.51615C14.7628 1.79768 12.4329 0.830992 10.0026 0.828125ZM10.0026 17.4948C8.51925 17.4948 7.0692 17.0549 5.83583 16.2308C4.60246 15.4067 3.64117 14.2354 3.07351 12.8649C2.50585 11.4945 2.35733 9.98647 2.64672 8.53161C2.93611 7.07676 3.65041 5.74038 4.69931 4.69149C5.7482 3.6426 7.08457 2.92829 8.53943 2.6389C9.99429 2.34951 11.5023 2.49804 12.8727 3.0657C14.2432 3.63335 15.4145 4.59465 16.2386 5.82801C17.0627 7.06138 17.5026 8.51143 17.5026 9.99479C17.5002 11.9832 16.7092 13.8894 15.3032 15.2954C13.8972 16.7014 11.991 17.4924 10.0026 17.4948Z"
                                                            fill="#808080" />
                                                        <path
                                                            d="M10.8307 9.66021V5.00521C10.8307 4.78419 10.7429 4.57223 10.5867 4.41595C10.4304 4.25967 10.2184 4.17188 9.9974 4.17188C9.77638 4.17188 9.56442 4.25967 9.40814 4.41595C9.25186 4.57223 9.16406 4.78419 9.16406 5.00521V10.0052C9.16411 10.2262 9.25194 10.4381 9.40823 10.5944L11.9082 13.0944C12.0654 13.2462 12.2759 13.3302 12.4944 13.3283C12.7129 13.3264 12.9219 13.2387 13.0764 13.0842C13.2309 12.9297 13.3186 12.7207 13.3205 12.5022C13.3224 12.2837 13.2384 12.0732 13.0866 11.916L10.8307 9.66021Z"
                                                            fill="#808080" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_287_3784">
                                                            <rect width="20" height="20" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                {{ $seller->bussiness_time }}
                                            </span>
                                        </div>

                                        <p class="mb-1 small text-muted border-bottom">GST Number:
                                            {{ $seller->gst ?? '-' }}</p>

                                        <p class="mb-1 small border-bottom pb-1">
                                            <strong>Categories:</strong>
                                            @foreach ($seller->categories as $category)
                                                {{ $category->title }} |
                                            @endforeach
                                        </p>

                                        <p class="mb-0 small">
                                            <i class="bi bi-geo-alt-fill me-1"></i>
                                            {{ $seller->address->full_address }}
                                        </p>
                                    </div>

                                    <div class="p-2 d-flex justify-content-between">
                                        <a class="btn btn-outline-dark w-100 me-1"
                                            href="{{ route('view-shop', $seller->uuid) }}">
                                            <i class="bi bi-shop me-1"></i> View Shop
                                        </a>
                                        <div class="d-flex">
                                            @if ($seller->address && $seller->address->map_link)
                                                <a href="{{ $seller->address->map_link }}" target="_blank"
                                                    class="btn btn-dark me-1 text-white text-decoration-none">
                                                    <svg width="25" height="26" viewBox="0 0 25 26"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M16.4922 9.01524L10.5302 15.0408L3.74941 10.7997C2.77786 10.1918 2.97996 8.71608 4.07888 8.39471L20.1784 3.67997C21.1846 3.38503 22.1172 4.32587 21.8183 5.33541L17.0553 21.4237C16.729 22.5242 15.2617 22.7208 14.6596 21.7451L10.5271 15.0419"
                                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </a>
                                            @endif
                                            <a href="tel:{{ $seller->phone }}" class="btn btn-dark me-1">
                                                <svg width="25" height="26" viewBox="0 0 25 26"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12.0096 13.4895C16.1649 17.6436 17.1076 12.8377 19.7533 15.4816C22.3039 18.0315 23.7699 18.5424 20.5383 21.7731C20.1335 22.0985 17.5616 26.0122 8.52302 16.9762C-0.516644 7.93906 3.39488 5.36453 3.72028 4.95984C6.95976 1.72015 7.46184 3.19467 10.0125 5.74461C12.6582 8.38958 7.85433 9.33533 12.0096 13.4895Z"
                                                        stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                @if ($searchStarted)
                    <div class="container py-4 text-center">
                        <h4 class="mb-4">
                            No Results Found
                        </h4>
                    </div>
                @endif
            @endif

            @if (count($ads) > 0)
                {{-- Ads --}}
                <div class="col-md-12 text-center justify-content-center">
                    {{-- <div class="text-warning mt-5 fw-bold fs-5">Brands</div> --}}
                    <div class="h3 fw-bold mt-5">Trusted by professionals</div>
                </div>
                <div wire:ignore>
                    <div class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($ads as $ad)
                                    <li class=" splide__slide p-2">
                                        <img class="w-100" src="{{ asset('storage/' . $ad->image) }}">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if (empty($sellers) && count($blogs) > 0)
                <div class="col-md-12 text-center justify-content-center">
                    <div class="h3 fw-bold mt-5">Ideas that shape the future</div>
                    <div>Stay ahead with expert advice, innovative ideas, and <br> the latest updates from the world of
                        construction</div>
                    <a href="{{ route('blogs') }}" class="btn btn-dark rounded-5 m-4">Read more</a>
                    <div class="row mt-5 text-start justify-content-center">
                        @foreach ($blogs as $data)
                            <div class="col-md-3 col-lg-2 col-6" wire:click="viewBlog('{{ $data->slug }}')">
                                <div class="border rounded position-relative rounded-3">
                                    <div class="ratio ratio-16x9">
                                        <img src="{{ asset('storage/' . $data->blog_image) }}"
                                            class="d-block w-100 rounded-3" alt="Product Image">
                                    </div>
                                    <div style="height: 140px">
                                        <div class="p-1 fw-bold text-title"> {{ $data->title }}</div>
                                        <div class="p-1 text-secondary text-description"> {!! $data->description !!}
                                        </div>
                                        <small
                                            class="p-1 text-secondary position-absolute bottom-0">{{ $data->created_at->format('F j, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@push('scripts')
<script>
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
      } else {
        console.log("Geolocation is not supported by this browser.");
      }
    }

    async function success(position) {
      const latitude = position.coords.latitude;
      const longitude = position.coords.longitude;

      try {
        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`);
        const data = await response.json();
        const city = data.address.state_district ? (data.address.state_district.replace(' District','')) :(data.address.city || data.address.town || data.address.village || "Unknown city");
        const state = data.address.state || "Unknown state";
        if(city != 'Unknown city'){
            if(city == 'Ahmadnagar' || city == 'ahmadnagar' || city == 'Ahamadnagar' || city == 'ahamadnagar'){
                city = 'Ahilyanagar';
            }
            Livewire.dispatch('selectedCityfun', {'value':city});
        }
        Livewire.dispatch('selectedStatefun', {'value':state});
      } catch (err) {
        console.log("Failed to fetch location details.");
      }
    }
    function error() {
      console.log("Permission denied or unable to get location.");
    }
    getLocation();
  </script>
@endpush
@push('style')
    <style>
        .form-control:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border-color: rgb(0, 0, 0);
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgb(255, 255, 255);
        }
        .form-select:focus {
            color: var(--bs-body-color);
            background-color: var(--bs-body-bg);
            border-color: rgb(0, 0, 0);
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgb(255, 255, 255);
        }

        .category-image {
            aspect-ratio: 1/1;
            object-fit: cover;
            border-radius: 5px
        }

        @media (min-width: 768px) {
            .category-image {
                aspect-ratio: 16/9;
                object-fit: cover;
                border-radius: 5px
            }
        }

        @media (min-width: 1024px) {
            .category-image {
                aspect-ratio: 16/9;
                object-fit: cover;
                border-radius: 10px
            }
        }

        @media (min-width: 1024px) {
            .w-sp {
                width: 50%;
            }
        }

        @media (max-width: 768px) {
            .w-sp {
                width: 100%;
            }
        }

        .ratio-21x9 {
            --bs-aspect-ratio: 28.857143%;
        }

        .text-description {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Number of lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .text-title {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* Number of lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
