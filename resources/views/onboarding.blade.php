@extends('layouts.app')

@section('content')
<div class="card rounded-4 shadow" id="onboarding-container">
    <div class="row p-4">
        <div class="offset-xl-2 offset-lg-1 col-xl-5 col-lg-7 col-md-6 col-sm-12 p-4">
            <form id="onboardingForm">
                @csrf
                <input type="hidden" name="step" id="currentStep" value="1">
                <input type="hidden" name="type" id="userType" value="">
                
                <!-- Step 1: User Type Selection -->
                <div id="step-1" class="step-section">
                    <div class="row">
                        <div class="col-6 col-md-8">
                            <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                        </div>
                        <div class="col-6 col-md-4 text-end">
                            <div class="d-flex justify-content-end align-items-center mb-2" id="step-indicator-1">
                                <!-- JS will populate indicators -->
                            </div>
                            <div class="d-flex justify-content-end align-items-center mb-3">
                                <span class="text-muted">Step <strong>01 of 03</strong></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted fst-italic mb-2">Welcome to Bajar Bhaw!</h6>
                    <h6 class="text-muted fst-italic mb-5">"Let's get to know you better."</h6>
                    <div class="mb-4">
                        <h3 class="fw-bold">
                            <span class="text-muted" id="iam-text">I am</span>
                            <span id="selected-type-text" class="text-muted">Individual / Business</span>
                        </h3>
                    </div>
                    
                    <div class="row">
                        <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 col-6 mb-3 position-relative">
                            <button type="button" class="border rounded-4 position-relative text-center w-100 w-md-auto h-180 type-btn" data-type="individual" onclick="selectType('individual')">
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30 29.2344C27.5938 29.2344 25.534 28.3777 23.8206 26.6644C22.1069 24.9506 21.25 22.8906 21.25 20.4844C21.25 18.0781 22.1069 16.0183 23.8206 14.305C25.534 12.5913 27.5938 11.7344 30 11.7344C32.4062 11.7344 34.466 12.5913 36.1794 14.305C37.8931 16.0183 38.75 18.0781 38.75 20.4844C38.75 22.8906 37.8931 24.9506 36.1794 26.6644C34.466 28.3777 32.4062 29.2344 30 29.2344ZM11.25 44.475V42.715C11.25 41.4908 11.5825 40.3571 12.2475 39.3137C12.9125 38.2704 13.8012 37.4683 14.9137 36.9075C17.3846 35.6962 19.8773 34.7877 22.3919 34.1819C24.9065 33.576 27.4425 33.2731 30 33.2731C32.5575 33.2731 35.0935 33.576 37.6081 34.1819C40.1227 34.7877 42.6154 35.6962 45.0863 36.9075C46.1987 37.4683 47.0875 38.2704 47.7525 39.3137C48.4175 40.3571 48.75 41.4908 48.75 42.715V44.475C48.75 45.5292 48.3806 46.4258 47.6419 47.165C46.9031 47.9038 46.0065 48.2731 44.9519 48.2731H15.0481C13.9935 48.2731 13.0969 47.9038 12.3581 47.165C11.6194 46.4258 11.25 45.5292 11.25 44.475ZM15 44.5231H45V42.715C45 42.2087 44.8533 41.74 44.56 41.3088C44.2667 40.8779 43.8685 40.5262 43.3656 40.2537C41.2115 39.1929 39.0152 38.3892 36.7769 37.8425C34.5381 37.2963 32.2792 37.0231 30 37.0231C27.7208 37.0231 25.4619 37.2963 23.2231 37.8425C20.9848 38.3892 18.7885 39.1929 16.6344 40.2537C16.1315 40.5262 15.7333 40.8779 15.44 41.3088C15.1467 41.74 15 42.2087 15 42.715V44.5231ZM30 25.4844C31.375 25.4844 32.5521 24.9948 33.5312 24.0156C34.5104 23.0365 35 21.8594 35 20.4844C35 19.1094 34.5104 17.9323 33.5312 16.9531C32.5521 15.974 31.375 15.4844 30 15.4844C28.625 15.4844 27.4479 15.974 26.4688 16.9531C25.4896 17.9323 25 19.1094 25 20.4844C25 21.8594 25.4896 23.0365 26.4688 24.0156C27.4479 24.9948 28.625 25.4844 30 25.4844Z" fill="black" />
                                </svg>
                                <h6 class="fw-bold">Individual</h6>
                                <div class="check-icon d-none position-absolute top-0 end-0 m-2">
                                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="12" fill="black" /><path d="M9.75 14.06L16.58 7.23C16.74 7.08 16.93 7 17.17 7C17.41 7 17.61 7.08 17.77 7.23C17.92 7.39 18 7.58 18 7.82C18 8.06 17.92 8.26 17.77 8.42L10.46 15.7C10.26 15.9 10.02 16 9.75 16C9.48 16 9.24 15.9 9.04 15.7L6.23 12.91C6.08 12.75 6 12.55 6 12.32C6 12.08 6.08 11.88 6.23 11.72C6.39 11.57 6.59 11.49 6.83 11.49C7.07 11.49 7.26 11.57 7.42 11.72L9.75 14.06Z" fill="white" /></svg>
                                </div>
                            </button>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-md-6 col-lg-6 col-6 mb-3">
                            <button type="button" class="border rounded-4 h-180 position-relative text-center w-100 w-md-auto type-btn" data-type="business" onclick="selectType('business')">
                                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.4024 10.625H47.5949C48.1262 10.625 48.5714 10.8048 48.9305 11.1644C49.2901 11.524 49.4699 11.9694 49.4699 12.5006C49.4699 13.0323 49.2901 13.4775 48.9305 13.8363C48.5714 14.1954 48.1262 14.375 47.5949 14.375H12.4024C11.8712 14.375 11.426 14.1952 11.0668 13.8356C10.7072 13.476 10.5274 13.0306 10.5274 12.4994C10.5274 11.9677 10.7072 11.5225 11.0668 11.1637C11.426 10.8046 11.8712 10.625 12.4024 10.625ZM12.8831 49.375C12.2431 49.375 11.7064 49.1585 11.2731 48.7256C10.8401 48.2923 10.6237 47.7556 10.6237 47.1156V34.375H9.84993C9.13826 34.375 8.55243 34.0969 8.09243 33.5406C7.63243 32.9848 7.48576 32.351 7.65243 31.6394L10.1524 19.9087C10.2666 19.3883 10.5324 18.961 10.9499 18.6269C11.3674 18.2923 11.842 18.125 12.3737 18.125H47.6237C48.1553 18.125 48.6299 18.2923 49.0474 18.6269C49.4649 18.961 49.7308 19.3883 49.8449 19.9087L52.3449 31.6394C52.5116 32.351 52.3649 32.9848 51.9049 33.5406C51.4449 34.0969 50.8591 34.375 50.1474 34.375H49.3737V47.5C49.3737 48.0312 49.1939 48.4765 48.8343 48.8356C48.4747 49.1952 48.0293 49.375 47.4981 49.375C46.9664 49.375 46.5212 49.1952 46.1624 48.8356C45.8033 48.4765 45.6237 48.0312 45.6237 47.5V34.375H34.3737V47.1156C34.3737 47.7556 34.1572 48.2923 33.7243 48.7256C33.291 49.1585 32.7543 49.375 32.1143 49.375H12.8831ZM14.3737 45.625H30.6237V34.375H14.3737V45.625ZM11.6618 30.625H48.3356L46.4268 21.875H13.5706L11.6618 30.625Z" fill="black" />
                                </svg>
                                <h6 class="fw-bold">Business</h6>
                                <div class="check-icon d-none position-absolute top-0 end-0 m-2">
                                     <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="12" fill="black" /><path d="M9.75 14.06L16.58 7.23C16.74 7.08 16.93 7 17.17 7C17.41 7 17.61 7.08 17.77 7.23C17.92 7.39 18 7.58 18 7.82C18 8.06 17.92 8.26 17.77 8.42L10.46 15.7C10.26 15.9 10.02 16 9.75 16C9.48 16 9.24 15.9 9.04 15.7L6.23 12.91C6.08 12.75 6 12.55 6 12.32C6 12.08 6.08 11.88 6.23 11.72C6.39 11.57 6.59 11.49 6.83 11.49C7.07 11.49 7.26 11.57 7.42 11.72L9.75 14.06Z" fill="white" /></svg>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('home') }}" class="btn btn-defualt">
                             <!-- Back Home Icon -->
                             <svg width="50" height="50" viewBox="0 0 50 50" fill="none"><rect x="-1" y="1" width="47" height="47" rx="24" transform="matrix(-1 0 0 1 48 0)" fill="white" stroke="black" stroke-width="2" /><path d="M20.9123 25.0026L29.3342 16.5807C29.6206 16.2943 29.7591 15.9553 29.7495 15.5638C29.74 15.1723 29.592 14.8333 29.3055 14.5469C29.0191 14.2604 28.6801 14.1172 28.2886 14.1172C27.8971 14.1172 27.5581 14.2604 27.2717 14.5469L18.4774 23.3698C18.2482 23.599 18.0764 23.8568 17.9618 24.1432C17.8472 24.4297 17.7899 24.7161 17.7899 25.0026C17.7899 25.2891 17.8472 25.5755 17.9618 25.862C18.0764 26.1484 18.2482 26.4063 18.4774 26.6354L27.3003 35.4583C27.5868 35.7448 27.921 35.8832 28.3029 35.8737C28.6849 35.8642 29.0191 35.7161 29.3055 35.4297C29.592 35.1432 29.7352 34.8043 29.7352 34.4128C29.7352 34.0213 29.592 33.6823 29.3055 33.3958L20.9123 25.0026Z" fill="black" /></svg>
                        </a>
                        <button type="button" class="btn btn-dark btn-sm px-5 py-3 rounded-5" id="btn-next-1" disabled onclick="nextStep()">Next</button>
                    </div>
                </div>

                <!-- Step 2: Personal / Business Details -->
                <div id="step-2" class="step-section d-none">
                     <div class="row">
                        <div class="col-6 col-md-8">
                            <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                        </div>
                        <div class="col-6 col-md-4 text-end">
                            <div class="d-flex justify-content-end align-items-center mb-2" id="step-indicator-2"></div>
                            <div class="d-flex justify-content-end align-items-center mb-3">
                                <span class="text-muted">Step <strong id="step-count-text">02 of 03</strong></span>
                            </div>
                        </div>
                    </div>
                    
                    <h6 class="text-muted fst-italic mb-3" id="step-2-subtitle">"Just a few details..."</h6>
                    <h5 class="fw-bold mb-4" id="step-2-title">Details</h5>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $user->name) }}">
                                <label>Name *</label>
                            </div>
                            <span class="text-danger error-text name-error"></span>
                        </div>
                         <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone', $user->phone) }}" maxlength="10">
                                <label>Phone *</label>
                            </div>
                            <span class="text-danger error-text phone-error"></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $user->email) }}">
                                <label>Email *</label>
                            </div>
                             <span class="text-danger error-text email-error"></span>
                        </div>
                        
                         <!-- Business Specific Fields -->
                        <div class="col-12 col-md-6 mb-3 business-field d-none">
                            <div class="form-floating">
                                <input type="text" name="gst_number" class="form-control" placeholder="GST">
                                <label>GST Number</label>
                            </div>
                             <span class="text-danger error-text gst_number-error"></span>
                        </div>
                    </div>

                    <h5 class="fw-bold mb-4">Address</h5>
                    <div class="row">
                        <div class="col-12 mb-3 business-field d-none">
                             <div class="form-floating">
                                <input type="text" name="address" class="form-control" placeholder="Address">
                                <label>Business Address *</label>
                            </div>
                             <span class="text-danger error-text address-error"></span>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <select class="form-select" name="state" id="stateSelect">
                                    <option value="">Select State</option>
                                    @foreach($stateOptions as $state)
                                        <option value="{{ $state }}">{{ $state }}</option>
                                    @endforeach
                                </select>
                                <label>State *</label>
                            </div>
                             <span class="text-danger error-text state-error"></span>
                        </div>
                         <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <select class="form-select" name="city" id="citySelect">
                                    <option value="">Select City</option>
                                </select>
                                <label>City *</label>
                            </div>
                             <span class="text-danger error-text city-error"></span>
                        </div>
                    </div>

                     <div class="mb-3 business-field d-none">
                        <div class="form-floating">
                            <input type="text" name="google_map_link" class="form-control" placeholder="Map Link">
                            <label>Google Map Link *</label>
                        </div>
                         <span class="text-danger error-text google_map_link-error"></span>
                    </div>

                    <div class="mt-5">
                        <button type="button" class="btn btn-defualt" onclick="prevStep()"><i class="bi bi-arrow-left-circle fs-1"></i></button>
                        <button type="button" class="btn btn-dark btn-sm px-5 py-3 rounded-5" onclick="nextStep()" id="btn-next-2">Next</button>
                    </div>
                </div>
                
                <!-- Step 3: Confirmation (Individual) OR Offerings (Business) -->
                <div id="step-3" class="step-section d-none">
                    <div class="row">
                        <div class="col-6 col-md-8">
                             <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                        </div>
                        <div class="col-6 col-md-4 text-end">
                            <div class="d-flex justify-content-end align-items-center mb-2" id="step-indicator-3"></div>
                            <div class="d-flex justify-content-end align-items-center mb-3">
                                <span class="text-muted">Step <strong id="step-count-text-3">03 of 03</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Individual Final -->
                    <div id="individual-step-3" class="d-none">
                         <div class="text-center">
                            <img class="mb-5 w-100" src="{{ asset('assets/image/final.png') }}">
                        </div>
                         <div class="mt-5">
                            <button type="button" class="btn btn-defualt" onclick="prevStep()"><i class="bi bi-arrow-left-circle fs-1"></i></button>
                            <button type="button" class="btn btn-dark btn-sm px-5 py-3 rounded-5" onclick="saveData()">Done</button>
                        </div>
                    </div>

                    <!-- Business Offering -->
                    <div id="business-step-3" class="d-none">
                        <h6 class="text-muted fst-italic mb-3">"Great! Share some more about your business"</h6>
                        <h5 class="fw-bold mb-4">Business Offerings</h5>
                        
                        <input type="hidden" name="offering" id="offering">
                        
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-2" onclick="selectOffering('product')">
                                <button type="button" class="border border-2 rounded-2 p-3 w-100 offering-btn" id="btn-product">
                                    Product
                                </button>
                            </div>
                             <div class="col-lg-6 col-md-12" onclick="selectOffering('service')">
                                <button type="button" class="border border-2 rounded-2 p-3 w-100 offering-btn" id="btn-service">
                                    Service
                                </button>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div id="categories-section" class="mt-3 d-none">
                            <h4 class="fw-bold mt-3">Categories (<span id="cat-count">0</span>/3)</h4>
                            <div id="product-cats" class="d-none">
                                @foreach($productCategories as $cat)
                                    <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 p-3 m-1 cat-pill" data-id="{{$cat->id}}" onclick="toggleCategory({{$cat->id}}, this)">{{$cat->title}}</span>
                                @endforeach
                            </div>
                            <div id="service-cats" class="d-none">
                                @foreach($serviceCategories as $cat)
                                    <span role="button" class="badge rounded-pill text-dark border border-2 fs-6 p-3 m-1 cat-pill" data-id="{{$cat->id}}" onclick="toggleCategory({{$cat->id}}, this)">{{$cat->title}}</span>
                                @endforeach
                            </div>
                        </div>

                         <div class="mt-5">
                            <button type="button" class="btn btn-defualt" onclick="prevStep()"><i class="bi bi-arrow-left-circle fs-1"></i></button>
                            <button type="button" class="btn btn-dark btn-sm px-5 py-3 rounded-5" onclick="nextStep()" id="btn-next-3" disabled>Next</button>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Business Final -->
                 <div id="step-4" class="step-section d-none">
                     <div class="row">
                        <div class="col-6 col-md-8">
                             <img class="mb-5 logo-img" src="{{ asset('assets/logo/logo.png') }}">
                        </div>
                        <div class="col-6 col-md-4 text-end">
                            <div class="d-flex justify-content-end align-items-center mb-2" id="step-indicator-4"></div>
                            <div class="d-flex justify-content-end align-items-center mb-3">
                                <span class="text-muted">Step <strong>04 of 04</strong></span>
                            </div>
                        </div>
                    </div>
                     <div class="text-center">
                        <img class="mb-5 mt-5 w-100" src="{{ asset('assets/image/final.png') }}">
                    </div>
                     <div class="mt-5">
                        <button type="button" class="btn btn-defualt" onclick="prevStep()"><i class="bi bi-arrow-left-circle fs-1"></i></button>
                        <button type="button" class="btn btn-dark btn-sm px-5 py-3 rounded-5" onclick="saveData()">Done</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 text-end d-none d-md-block">
            <img src="{{ asset('assets/image/rectangle_3.png') }}" alt="Onboarding Image" class="img-fluid">
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
    .h-180 { height: 180px !important; }
    .type-btn.active { border-color: black !important; }
    .cat-pill.active { background-color: #dee2e6; border-color: black !important; }
    .offering-btn.active { border-color: black !important; background-color: #f8f9fa; }
</style>
@endpush

@push('scripts')
<script>
    const states = @json($states);
    let selectedCategories = [];

    $(document).ready(function() {
        $('#stateSelect').on('change', function() {
            var state = $(this).val();
            var $city = $('#citySelect');
            $city.empty().append('<option value="">Select City</option>');
            
            if (state && states[state]) {
                states[state].forEach(function(city) {
                    $city.append('<option value="'+city+'">'+city+'</option>');
                });
            }
        });
    });

    function selectType(type) {
        $('#userType').val(type);
        $('.type-btn').removeClass('active');
        $('.type-btn[data-type="'+type+'"]').addClass('active');
        $('.type-btn .check-icon').addClass('d-none');
        $('.type-btn[data-type="'+type+'"] .check-icon').removeClass('d-none');
        
        $('#iam-text').addClass('text-muted');
        $('#selected-type-text').removeClass('text-muted').text(type.charAt(0).toUpperCase() + type.slice(1));
        $('#btn-next-1').prop('disabled', false);

        if(type === 'business') {
            $('.business-field').removeClass('d-none');
            $('#step-count-text').text('02 of 04');
        } else {
             $('.business-field').addClass('d-none');
             $('#step-count-text').text('02 of 03');
        }
    }

    function selectOffering(type) {
        $('#offering').val(type);
        $('.offering-btn').removeClass('active');
        $('#btn-'+type).addClass('active');
        
        $('#categories-section').removeClass('d-none');
        $('#product-cats, #service-cats').addClass('d-none');
        $('#'+type+'-cats').removeClass('d-none');
        
        // Reset categories
        selectedCategories = [];
        $('.cat-pill').removeClass('active');
        $('#cat-count').text(0);
        $('#btn-next-3').prop('disabled', true);
    }

    function toggleCategory(id, el) {
        if(selectedCategories.includes(id)) {
            selectedCategories = selectedCategories.filter(item => item !== id);
            $(el).removeClass('active');
        } else {
            if(selectedCategories.length >= 3) {
                alert('Max 3 categories');
                return;
            }
            selectedCategories.push(id);
            $(el).addClass('active');
        }
        $('#cat-count').text(selectedCategories.length);
        if(selectedCategories.length > 0) $('#btn-next-3').prop('disabled', false);
        else $('#btn-next-3').prop('disabled', true);
    }

    function nextStep() {
        let step = parseInt($('#currentStep').val());
        let type = $('#userType').val();

        // If step 1, just go to 2
        if(step === 1) {
             setStep(2);
             return;
        }

        // Validate step 2
        if(step === 2) {
             validateStep(2, () => {
                 if(type === 'individual') setStep(3); // Final
                 else setStep(3); // Offering
             });
        }
        
        // Step 3 Business
        if(step === 3 && type === 'business') {
            setStep(4);
        }
    }

    function prevStep() {
        let step = parseInt($('#currentStep').val());
        setStep(step - 1);
    }

    function setStep(step) {
        $('.step-section').addClass('d-none');
        $('#step-' + step).removeClass('d-none');
        $('#currentStep').val(step);
        let type = $('#userType').val();

        if(step === 3) {
            if(type === 'individual') {
                $('#individual-step-3').removeClass('d-none');
                $('#business-step-3').addClass('d-none');
                $('#step-count-text-3').text('03 of 03');
            } else {
                $('#individual-step-3').addClass('d-none');
                $('#business-step-3').removeClass('d-none');
                $('#step-count-text-3').text('03 of 04');
            }
        }
        updateIndicators(step, type === 'business' ? 4 : 3);
    }
    
    function updateIndicators(current, total) {
        for(let i=1; i<=total; i++) {
             // Logic to draw indicators if needed, simplifed for now
        }
    }

    function validateStep(step, successCallback) {
        $('.error-text').text('');
        let formData = new FormData(document.getElementById('onboardingForm'));
        
        $.ajax({
            url: "{{ route('onboarding.validate') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                if(resp.success) {
                    successCallback();
                } else {
                    $.each(resp.errors, function(key, val) {
                        $('.'+key+'-error').text(val[0]);
                    });
                }
            }
        });
    }

    function saveData() {
        let formData = new FormData(document.getElementById('onboardingForm'));
        selectedCategories.forEach(id => formData.append('categoryIds[]', id));
        
        $.ajax({
            url: "{{ route('onboarding.save') }}",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(resp) {
                if(resp.success) {
                    window.location.href = resp.redirect;
                } else {
                    alert('Error: ' + resp.message);
                }
            }
        });
    }
</script>
@endpush
