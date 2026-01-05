@extends('layouts.app')

@push('meta')
    <meta property="og:title" content="{{ env('APP_NAME') }}" />
    <meta property="og:description"
        content="Find trusted building material traders offering a wide range of high quality products." />
    <meta property="og:image" content="{{ url('public/storage/' . $user->profile_image) }}" />
    <meta property="og:url" content="{{ route('view-shop', ['uuid' => $user->uuid]) }}" />
    <meta property="og:type" content="website" />
@endpush

@section('content')
<div id="view-business-container">
    <div class="container">
        <div class="row">
            <!-- Banner -->
            <div class="col-12 mt-4 position-relative">
                @if ($user->bg_image)
                    <img class="w-100 h-250 object-fit-cover rounded-4"
                        src="{{ asset('storage/' . $user->bg_image) }}">
                @else
                    <picture>
                        <source media="(max-width: 767px)" srcset="{{ asset('assets/image/mobile/banner_01.png') }}">
                        <img class="w-100 h-250 object-fit-cover rounded-4"
                            src="{{ asset('assets/image/desktop/banner_01.png') }}" alt="Banner">
                    </picture>
                @endif
                
                 <a role="button" class="position-absolute top-0 end-0 p-2 pe-4" style="z-index: 1"
                    href="https://wa.me/?text={{ urlencode(route('view-shop', ['uuid' => $user->uuid])) }}" target="_blank" rel="noopener noreferrer">
                    <svg width="40" height="40" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect width="30" height="30" rx="15" transform="matrix(-1 0 0 1 30 0)"
                            fill="white" fill-opacity="0.8" />
                        <path d="M19.2227 16.9219C18.3543 16.9219 17.589 17.3491 17.1084 17.9987L12.9528 15.8708C13.0218 15.6357 13.0703 15.3919 13.0703 15.1348C13.0703 14.786 12.9988 14.4543 12.8753 14.1493L17.2242 11.5323C17.7082 12.1003 18.4196 12.4688 19.2227 12.4688C20.6766 12.4688 21.8594 11.286 21.8594 9.83203C21.8594 8.37806 20.6766 7.19531 19.2227 7.19531C17.7687 7.19531 16.5859 8.37806 16.5859 9.83203C16.5859 10.1671 16.6549 10.4849 16.7694 10.78L12.4075 13.4047C11.9239 12.8536 11.2228 12.498 10.4336 12.498C8.97962 12.498 7.79688 13.6808 7.79688 15.1348C7.79688 16.5887 8.97962 17.7715 10.4336 17.7715C11.3163 17.7715 12.0945 17.3318 12.5733 16.6639L16.7152 18.7848C16.6389 19.0311 16.5859 19.2876 16.5859 19.5586C16.5859 21.0126 17.7687 22.1953 19.2227 22.1953C20.6766 22.1953 21.8594 21.0126 21.8594 19.5586C21.8594 18.1046 20.6766 16.9219 19.2227 16.9219Z" fill="black" />
                    </svg>
                </a>
            </div>

            <!-- Profile Info -->
             <div class="col-12 mb-3 mt-2">
                <div class="row">
                    <div class="col-md-4 col-lg-3 col-xl-2 col-6 offset-3 offset-sm-0 position-relative"
                        style="margin-top:-70px">
                        @if ($user->profile_image)
                            <img class="ms-md-4 p-3 p-sm-0 square-img-profile"
                                src="{{ asset('storage/' . $user->profile_image) }}">
                        @else
                            <img class="ms-md-4 p-3 p-sm-0 square-img-profile"
                                src="{{ asset('assets/image/profile.png') }}">
                        @endif
                    </div>
                     <div class="col-md-4 col-lg-5 col-xl-5 col-12">
                         <div class="d-xl-flex align-items-center ms-xl-2 text-md-start text-center p-md-2">
                            <span class="fw-bold fs-4">{{ $user->name }}</span>
                             @if ($user->gst)
                                <span class="badge text-bg-light fs-6 ms-xl-2"><span class="fw-light">GST :</span> {{ $user->gst }}</span>
                            @endif
                         </div>
                         <div class="ms-xl-2 mt-2 d-flex p-md-2">
                             <!-- Location Icon -->
                             <span class="me-2"><i class="fa fa-map-marker text-muted"></i></span>
                             <span>{{ $user->address->address }}, {{ $user->address->city }}, {{ $user->address->state }}</span>
                         </div>
                     </div>
                     <div class="col-md-4 col-lg-4 col-xl-5 col-12 text-md-end">
                        <div class="d-lg-flex float-md-end text-md-end w-100 justify-content-md-end">
                            <!-- Ratings -->
                            @if ($user->ratings?->total_score)
                                <span class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                    <i class="fas fa-star text-success me-1"></i> {{ $user->ratings->total_score }}
                                </span>
                            @endif
                             @if ($businessRatingsCount)
                                <span class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                     <i class="fas fa-certificate text-primary me-1"></i> {{ $businessRatingsCount }}
                                </span>
                             @endif
                              <span class="d-inline-flex mb-3 px-2 py-1 fw-semibold text-light-emphasis bg-light-subtle border border-light-subtle rounded-2 me-2">
                                <i class="far fa-clock text-muted me-1"></i> {{ $businessTime }}
                             </span>
                        </div>
                        <div class="d-lg-flex gap-1 float-md-end w-100 justify-content-md-end">
                             @if ($user->address && $user->address->map_link)
                                <a href="{{ $user->address->map_link }}" target="_blank" class="btn btn-dark text-white my-2">
                                    <i class="fas fa-directions"></i> Direction
                                </a>
                            @endif
                             <a href="tel:{{ $user->phone }}" class="btn btn-dark my-2">
                                <i class="fas fa-phone"></i> Call
                            </a>
                             @if (Auth::check())
                                <button class="btn btn-dark my-2" id="btn-open-review">
                                    Review {{ $user->offering === 'product' ? 'Seller' : 'Service Provider' }}
                                </button>
                            @endif
                        </div>
                     </div>
                </div>
            </div>
            
            <hr>

             <div class="col-md-9">
                <span class="badge rounded-pill text-bg-dark fs-6 p-3 m-1 cat-filter" data-id="all" role="button">All</span>
                @foreach ($businessCategories as $cat)
                    <span class="badge rounded-pill text-bg-light fs-6 p-3 m-1 cat-filter" data-id="{{ $cat->id }}" role="button">{{ $cat->title }}</span>
                @endforeach
            </div>

             <div class="col-12 mt-3" id="items-container">
                 @foreach ($allItems as $categoryTitle => $items)
                    <!-- We can add data-cat-id to the container of grouped items, but items might have different categories or same. 
                         Grouping by title is fine, but for filtering we need to hide blocks. 
                         Let's assume each block corresponds to one category. 
                         Wait, groupBy title doesn't give ID directly unless we look at first item.
                    -->
                    @php $firstItem = $items->first(); $catId = $firstItem->category_id; @endphp
                    <div class="category-block" data-cat-id="{{ $catId }}">
                        <h6 class="fw-bold">{{ $categoryTitle }}</h6>
                        <div class="row mb-2">
                             @foreach ($items as $item)
                                <div class="col-md-4 col-lg-3 col-xl-2 col-xxl-2 col-6 mb-3">
                                    <div class="border rounded position-relative h-100 d-flex flex-column my-2">
                                         <!-- Carousel -->
                                         <div id="carousel{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($item->images as $key => $img)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }} ratio ratio-1x1">
                                                        <img src="{{ asset('storage/' . $img->path) }}" class="d-block object-fit-cover rounded w-100">
                                                    </div>
                                                @endforeach
                                            </div>
                                             @if(count($item->images) > 1)
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $item->id }}" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $item->id }}" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                                            @endif
                                         </div>
                                         <!-- Info -->
                                         <div class="p-2 text-start fw-bold flex-grow-1 d-flex flex-column fs-12">
                                             <span class="d-block p-1">{{ substr($item->description, 0, 50) }}</span>
                                             @if($user->offering == 'product')
                                                 <span class="text-secondary fw-light p-1">{{ $item->brand_name }}</span>
                                                  @if ($item->show_price)
                                                    <span class="d-block p-1">Rs.{{ $item->price }} <span class="text-secondary fw-light">per</span> Unit</span>
                                                  @else
                                                    <span class="d-block p-1">Contact for price</span>
                                                  @endif
                                             @else
                                                  <span class="text-secondary fw-light p-1">{{ $item->work_brief }}</span>
                                                  <span class="d-block p-1">Contact for price</span>
                                             @endif
                                             
                                              <div class="d-flex gap-2 justify-content-between mt-auto pt-2">
                                                <a href="tel:{{ $user->phone }}" class="w-50 btn btn-dark"><i class="fas fa-phone"></i></a>
                                                <button class="w-50 btn btn-secondary btn-view-detail" data-item="{{ json_encode($item) }}"><i class="fa fa-eye"></i></button>
                                            </div>
                                         </div>
                                         
                                          <!-- Wishlist -->
                                            @if (auth()->user()?->role == 'individual')
                                                @php $inWishlist = in_array($item->id, $wishlistIds); @endphp
                                                <a class="position-absolute top-0 end-0 m-2 bg-white bg-opacity-75 rounded-pill d-flex align-items-center justify-content-center shadow wishlist-btn"
                                                    style="width: 40px; height: 40px; z-index: 1; cursor: pointer;"
                                                    onclick="toggleWishlist({{ $item->id }}, this)">
                                                    <i class="fs-5 {{ $inWishlist ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart text-dark' }}"></i>
                                                </a>
                                            @endif
                                    </div>
                                </div>
                             @endforeach
                        </div>
                    </div>
                 @endforeach
             </div>
        </div>
    </div>
</div>

<!-- Details Slider -->
<div class="slider-overlay" id="detail-overlay"></div>
<div class="slider-form" id="detail-slider">
    <div class="slider-content">
         <div class="row">
            <div class="col-8">
                <h3 class="fw-bold" id="detail-title">Details</h3>
            </div>
            <div class="col-4 text-end">
                <button class="btn btn-default rounded-5 bg-custom-secondary" id="btn-close-detail"><i class="fa-solid fa-xmark"></i></button>
            </div>
         </div>
         <div id="detail-body" class="mt-3">
             <!-- JS will populate -->
         </div>
    </div>
</div>

<!-- Review Slider -->
<div class="slider-overlay" id="review-overlay"></div>
<div class="slider-review-form" id="review-slider">
     <div class="slider-content">
          <div class="row">
            <div class="col-8">
                <h3 class="fw-bold">Review</h3>
            </div>
            <div class="col-4 text-end">
                <button class="btn btn-default rounded-5 bg-custom-secondary" id="btn-close-review"><i class="fa-solid fa-xmark"></i></button>
            </div>
         </div>
         <div class="mt-3">
             <!-- Rating Form Steps ... simplified for conciseness -->
              <form id="reviewForm">
                 @csrf
                 <input type="hidden" name="user_id" value="{{ $user->id }}">
                 <!-- Questions -->
                 <div class="mb-3">
                     <label>Is contact accurate?</label><br>
                     <input type="radio" name="is_contact_accurate" value="yes"> Yes
                     <input type="radio" name="is_contact_accurate" value="no"> No
                 </div>
                 <div class="mb-3">
                     <label>Is location accurate?</label><br>
                     <input type="radio" name="is_location_accurate" value="yes"> Yes
                     <input type="radio" name="is_location_accurate" value="no"> No
                 </div>
                 <!-- Stars -->
                 <div class="mb-3">
                     <label>Communication</label>
                     <div class="rating-input" data-name="communication">
                         @for($i=1;$i<=5;$i++) <i class="far fa-star star" data-val="{{$i}}"></i> @endfor
                         <input type="hidden" name="communication" id="communication">
                     </div>
                 </div>
                  <div class="mb-3">
                     <label>Quality</label>
                     <div class="rating-input" data-name="quality">
                         @for($i=1;$i<=5;$i++) <i class="far fa-star star" data-val="{{$i}}"></i> @endfor
                         <input type="hidden" name="quality" id="quality">
                     </div>
                 </div>
                  <div class="mb-3">
                     <label>Recommendation</label>
                     <div class="rating-input" data-name="recommendation">
                         @for($i=1;$i<=5;$i++) <i class="far fa-star star" data-val="{{$i}}"></i> @endfor
                         <input type="hidden" name="recommendation" id="recommendation">
                     </div>
                 </div>
                 <button type="button" class="btn btn-dark" onclick="submitReview()">Submit</button>
              </form>
         </div>
     </div>
</div>

@endsection

@push('style')
<style>
    .slider-form, .slider-review-form {
        position: fixed; top: 0; right: -100%; width: 100%; height: 100%; background: #f8f9fa; z-index: 1050; transition: right 0.3s;
        box-shadow: -5px 0 15px rgba(0,0,0,0.1); overflow-y: auto;
    }
    .slider-form.open, .slider-review-form.open { right: 0; }
    .slider-overlay { position: fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1049; display:none; }
    @media(min-width: 768px) { .slider-form, .slider-review-form { width: 40%; } }
    .star { cursor: pointer; color: #ffc107; }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){
        // Category Filter
        $('.cat-filter').click(function(){
            $('.cat-filter').removeClass('text-bg-dark').addClass('text-bg-light');
            $(this).removeClass('text-bg-light').addClass('text-bg-dark');
            let id = $(this).data('id');
            if(id == 'all') $('.category-block').show();
            else {
                $('.category-block').hide();
                $('.category-block[data-cat-id="'+id+'"]').show();
            }
        });

        // Sliders
        $('.btn-view-detail').click(function(){
            let item = $(this).data('item');
            populateDetail(item);
            $('#detail-slider').addClass('open');
            $('#detail-overlay').show();
        });
        $('#btn-close-detail, #detail-overlay').click(function(){
            $('#detail-slider').removeClass('open');
            $('#detail-overlay').hide();
        });

        $('#btn-open-review').click(function(){
            $('#review-slider').addClass('open');
            $('#review-overlay').show();
        });
        $('#btn-close-review, #review-overlay').click(function(){
            $('#review-slider').removeClass('open');
            $('#review-overlay').hide();
        });

        // Stars
        $('.rating-input .star').click(function(){
            let val = $(this).data('val');
            let parent = $(this).closest('.rating-input');
            parent.find('input').val(val);
            parent.find('.star').removeClass('fas').addClass('far');
            parent.find('.star').each(function(){
                if($(this).data('val') <= val) $(this).removeClass('far').addClass('fas');
            });
        });
    });

    function populateDetail(item) {
        let html = '';
        if(item.images && item.images.length > 0) {
             html += '<div id="detailParamsCarousel" class="carousel slide mb-3" data-bs-ride="carousel"><div class="carousel-inner ratio ratio-1x1">';
             item.images.forEach((img, index) => {
                 let active = index === 0 ? 'active' : '';
                 html += `<div class="carousel-item ${active}"><img src="/storage/${img.path}" class="d-block w-100 rounded object-fit-cover"></div>`;
             });
             html += '</div>';
             if(item.images.length > 1) {
                 html += '<button class="carousel-control-prev" type="button" data-bs-target="#detailParamsCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button>';
                 html += '<button class="carousel-control-next" type="button" data-bs-target="#detailParamsCarousel" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>';
             }
             html += '</div>';
        }
        let desc = item.description || item.service_description || '';
        let brief = item.name || item.work_brief || '';
        
        html += `<h4>${brief}</h4>`;
        html += `<hr><p class="text-muted">${desc}</p>`;
        
        if(item.category) {
             html += `<div class="mb-2"><strong>Category:</strong> ${item.category.title}</div>`;
        }
        if(item.show_price && item.price) {
             html += `<div class="mb-2"><strong>Price:</strong> Rs. ${item.price} per ${item.quantity || 'Unit'}</div>`;
        }
        
        $('#detail-body').html(html);
        $('#detail-title').text(brief);
    }

    function toggleWishlist(id, btn) {
        let type = '{{ $user->offering }}'; // product or service
        $.ajax({
            url: "{{ route('wishlist.toggle') }}",
            method: 'POST',
            data: { id: id, type: type, _token: "{{ csrf_token() }}" },
            success: function(resp) {
                if(resp.success) {
                    let icon = $(btn).find('i');
                    if(resp.status == 'added') {
                        icon.removeClass('fa-regular fa-heart text-dark').addClass('fa-solid fa-heart text-danger');
                    } else {
                        icon.removeClass('fa-solid fa-heart text-danger').addClass('fa-regular fa-heart text-dark');
                    }
                     Toastify({ text: resp.message, duration: 3000, style: { background: "#28a745" } }).showToast();
                } else if(resp.message == 'Login required') {
                    window.location.href = '/login';
                }
            }
        });
    }

    function submitReview() {
        let formData = {
            user_id: $('input[name="user_id"]').val(),
            is_contact_accurate: $('input[name="is_contact_accurate"]:checked').val(),
            is_location_accurate: $('input[name="is_location_accurate"]:checked').val(),
            communication: $('#communication').val(),
            quality: $('#quality').val(),
            recommendation: $('#recommendation').val(),
            _token: "{{ csrf_token() }}"
        };
        
        if(!formData.is_contact_accurate || !formData.is_location_accurate || !formData.communication || !formData.quality || !formData.recommendation) {
            alert('Please fill all fields');
            return;
        }

        $.ajax({
            url: "{{ route('review.submit') }}",
            method: 'POST',
            data: formData,
            success: function(resp) {
                if(resp.success) {
                    alert(resp.message);
                    $('#review-slider').removeClass('open');
                    $('#review-overlay').hide();
                    location.reload();
                } else {
                    alert(resp.message || 'Error submitting review');
                }
            },
            error: function(xhr) {
                alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
            }
        });
    }
</script>
@endpush
