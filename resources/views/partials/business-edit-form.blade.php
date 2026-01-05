<div class="container">
    <div class="row">
        <!-- Banner -->
        <div class="col-12 mt-4 position-relative">
             @if ($user->bg_image)
                <img id="bg-preview" class="w-100 h-250 object-fit-cover rounded-4" src="{{ asset('storage/' . $user->bg_image) }}">
            @else
                <img id="bg-preview" class="w-100 h-250 object-fit-cover rounded-4" src="{{ asset('assets/image/desktop/banner_01.png') }}">
            @endif
            <input type="file" id="bgImage" hidden accept="image/*">
            <label role="button" class="position-absolute top-0 end-0 p-2 pe-4" style="z-index: 1" for="bgImage">
                <i class="fa fa-camera fa-2x text-white"></i>
            </label>
            
            <a href="{{ route('view-shop', ['uuid' => $user->uuid]) }}" role="button" class="position-absolute top-0 start-0 p-2 ps-4" style="z-index: 1">
               <i class="fa fa-arrow-left fa-2x text-white"></i>
            </a>
        </div>

        <!-- Profile Image -->
        <div class="col-12 mb-3 mt-2">
            <div class="row">
                <div class="col-md-4 col-lg-3 col-xl-2 col-6 offset-3 offset-sm-0 position-relative" style="margin-top:-70px">
                     @if ($user->profile_image)
                        <img id="profile-preview" class="ms-md-4 p-2 p-sm-0 square-img-profile" src="{{ asset('storage/' . $user->profile_image) }}">
                    @else
                        <img id="profile-preview" class="ms-md-4 p-2 p-sm-0 square-img-profile" src="{{ asset('assets/image/business_profile.png') }}">
                    @endif
                    <input type="file" id="profileImage" hidden accept="image/*">
                    <label for="profileImage" role="button" class="position-absolute top-0 end-0 p-2 pe-4 pe-md-0" style="z-index: 1">
                        <i class="fa fa-camera fa-lg text-dark bg-light rounded-circle p-2"></i>
                    </label>
                </div>
                <div class="col-md-4 col-lg-5 col-xl-5 col-12">
                    <div class="d-xl-flex align-items-center ms-xl-2 text-md-start text-center p-md-2">
                        <span class="fw-bold fs-4">{{ $user->name }}</span>
                        @if($user->gst)
                            <span class="badge text-bg-light fs-6 ms-xl-2"><span class="fw-light">GST : </span> {{ $user->gst }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <form id="business-form">
            @csrf
            <div class="alert bg-custom-secondary fw-bold" role="alert">Business Details</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        <label>Business Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <input type="text" class="form-control" name="gst" value="{{ $user->gst }}">
                        <label>GST Number</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                        <label>Phone Number</label>
                    </div>
                </div>
                <!-- Phone Verify Button -->
                 <div class="col-md-6 pt-3">
                    @if ($user->phone_verified_at)
                         <button type="button" class="btn btn-success disabled"><i class="fa fa-check"></i> Verified</button>
                    @else
                         <button type="button" class="btn btn-dark" onclick="openVerify('phone')">Verify</button>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        <label>Email</label>
                    </div>
                </div>
                <!-- Email Verify Button -->
                <div class="col-md-6 pt-3">
                    @if ($user->email_verified_at)
                         <button type="button" class="btn btn-success disabled"><i class="fa fa-check"></i> Verified</button>
                    @else
                         <button type="button" class="btn btn-dark" onclick="openVerify('email')">Verify</button>
                    @endif
                </div>
            </div>

            <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">Business Address</div>
            <div class="row">
                <div class="col-12">
                     <div class="form-floating mb-2 mt-2">
                        <input type="text" class="form-control" name="address" value="{{ $user->address->address ?? '' }}">
                        <label>Address</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <select class="form-select" name="state" id="state-select">
                            <option value="">Select State</option>
                            @foreach ($stateOptions as $st)
                                <option value="{{ $st }}" {{ ($user->address->state ?? '') == $st ? 'selected' : '' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                        <label>State</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                         <select class="form-select" name="city" id="city-select">
                             @foreach ($cityOptions as $ct)
                                <option value="{{ $ct }}" {{ ($user->address->city ?? '') == $ct ? 'selected' : '' }}>{{ $ct }}</option>
                            @endforeach
                        </select>
                        <label>City</label>
                    </div>
                </div>
                 <div class="col-12">
                     <div class="form-floating mb-2 mt-2">
                        <input type="text" class="form-control" name="map_link" value="{{ $user->address->map_link ?? '' }}">
                        <label>Google Map Link</label>
                    </div>
                </div>
            </div>
            
            <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">Business Offerings</div>
            <div class="row mb-3">
                 <div class="col-md-6">
                     <div class="border rounded p-3 {{ $user->offering == 'product' ? 'border-dark bg-secondary-subtle' : '' }}" role="button" onclick="setOffering('product')">
                         <h5>I sell Building Material</h5>
                         <input type="radio" name="offering" value="product" {{ $user->offering == 'product' ? 'checked' : '' }} hidden>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="border rounded p-3 {{ $user->offering == 'service' ? 'border-dark bg-secondary-subtle' : '' }}" role="button" onclick="setOffering('service')">
                         <h5>I offer Services</h5>
                         <input type="radio" name="offering" value="service" {{ $user->offering == 'service' ? 'checked' : '' }} hidden>
                     </div>
                 </div>
            </div>
            
            <div id="category-section">
                <!-- JS will populate based on offering -->
                @php 
                    // Prepare data for JS
                    $pCats = $productCategories->map(fn($c) => ['id'=>$c->id, 'title'=>$c->title])->toArray();
                    $sCats = $serviceCategories->map(fn($c) => ['id'=>$c->id, 'title'=>$c->title])->toArray();
                    $myCats = $categoryIds; 
                @endphp
            </div>
            
            <!-- Subscription -->
             <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">Subscription Details</div>
             @if($user->activeSubscription)
                 <div class="border border-primary p-3 rounded bg-primary bg-opacity-10 mb-3">
                     <span class="d-block fw-bold display-6">{{$user->activeSubscription->plan_name}}</span>
                     <span>Valid Till : {{ \Carbon\Carbon::parse($user->activeSubscription->end_at)->format('d M Y');}}</span>
                 </div>
             @else
                @include('partials.subscription-form', ['user' => $user])
             @endif
             
             <!-- Business Hours -->
             <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">Business Hours</div>
             @foreach ($days as $day)
                <div class="row mb-2">
                    <div class="col-md-2 fw-bold text-center pt-3">{{ $day }}</div>
                    <div class="col-md-5">
                         <div class="form-floating">
                            <input type="time" class="form-control" name="store_hours[{{$day}}][open]" value="{{ $storeHours[$day]['open'] }}">
                            <label>Open</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                         <div class="form-floating">
                            <input type="time" class="form-control" name="store_hours[{{$day}}][close]" value="{{ $storeHours[$day]['close'] }}">
                            <label>Close</label>
                        </div>
                    </div>
                </div>
             @endforeach
             
             <div class="mt-4 mb-5">
                 <button type="submit" class="btn btn-dark btn-lg w-100">Update Profile</button>
             </div>
        </form>
    </div>
</div>

<!-- OTP Slider -->
<div class="slider-form" id="otp-slider">
    <div class="slider-content">
        <div class="text-end"><button type="button" class="btn btn-close" onclick="closeVerify()"></button></div>
        <h3 class="fw-bold mt-4">OTP Verification</h3>
         <p>Enter OTP sent to <span id="otp-target"></span></p>
         <div class="otp-inputs d-flex justify-content-center gap-2 my-4">
             @for($i=0;$i<6;$i++) <input type="text" class="form-control text-center otp-digit" maxlength="1" style="width:40px;height:40px"> @endfor
         </div>
         <button class="btn btn-dark w-100" onclick="verifyOtp()">Verify</button>
    </div>
</div>

@push('style')
<style>
    .slider-form { position: fixed; top: 0; right: -100%; width: 100%; height: 100%; background: #fff; transition: right 0.3s; z-index: 1060; box-shadow: -5px 0 15px rgba(0,0,0,0.1); }
    .slider-form.open { right: 0; }
    @media(min-width: 768px) { .slider-form { width: 400px; } }
</style>
@endpush

@push('scripts')
<script>
    let productCats = @json($pCats);
    let serviceCats = @json($sCats);
    let myCats = @json($myCats);
    let currentOffering = "{{ $user->offering }}";

    $(document).ready(function() {
        renderCategories();
        
        // Image Previews
        $('#bgImage').change(function(){
            if(this.files && this.files[0]){
                let reader = new FileReader();
                reader.onload = function(e){ $('#bg-preview').attr('src', e.target.result); }
                reader.readAsDataURL(this.files[0]);
            }
        });
        $('#profileImage').change(function(){
             if(this.files && this.files[0]){
                let reader = new FileReader();
                reader.onload = function(e){ $('#profile-preview').attr('src', e.target.result); }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // State Change
        $('#state-select').change(function(){
             let state = $(this).val();
             let states = @json(config('state'));
             let cities = states[state] || [];
             let html = '<option value="">Select City</option>';
             cities.forEach(c => html += `<option value="${c}">${c}</option>`);
             $('#city-select').html(html);
        });

        // Form Submit
        $('#business-form').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            if($('#bgImage')[0].files[0]) formData.append('bg_image', $('#bgImage')[0].files[0]);
            if($('#profileImage')[0].files[0]) formData.append('profile_image', $('#profileImage')[0].files[0]);
            
            // Add categories
            myCats.forEach(id => formData.append('category_ids[]', id));
            
            $.ajax({
                url: "{{ route('business.update', ['uuid' => $user->uuid]) }}",
                method: 'POST',
                data: formData,
                processData: false, contentType: false,
                success: function(resp){
                    if(resp.success) alert('Profile Updated Successfully');
                    else alert(resp.message || 'Error updating profile');
                },
                error: function(xhr) {
                    alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
                }
            });
        });
    });

    function setOffering(type) {
        currentOffering = type;
        $('[name="offering"][value="'+type+'"]').prop('checked', true);
        renderCategories();
    }

    function renderCategories() {
        let cats = currentOffering == 'product' ? productCats : serviceCats;
        let html = '<h4 class="mt-3">Select Categories ('+myCats.length+'/3)</h4><div class="d-flex flex-wrap gap-2">';
        cats.forEach(c => {
            let selected = myCats.includes(c.id);
            let style = selected ? 'bg-dark text-white' : 'bg-light text-dark border';
            html += `<span class="badge ${style} p-2" role="button" onclick="toggleCategory(${c.id})">${c.title}</span>`;
        });
        html += '</div>';
        $('#category-section').html(html);
    }

    function toggleCategory(id) {
        if(myCats.includes(id)) {
            myCats = myCats.filter(c => c !== id);
        } else {
            if(myCats.length >= 3) { alert('Max 3 categories allowed'); return; }
            myCats.push(id);
        }
        renderCategories();
    }
    
    // OTP Logic
    let otpModel = '';
    function openVerify(model) {
        otpModel = model;
        let val = (model == 'email') ? $('#email').val() : $('#phone').val();
         if(!val) { alert('Please enter value first'); return; }
         
         $('#otp-target').text(val);
         // Send OTP AJAX
         $.post("{{ route('profile.send-otp') }}", { model: model, value: val, _token: "{{ csrf_token() }}" }, function(resp){
             if(resp.success) {
                 $('#otp-slider').addClass('open');
             } else {
                 alert(resp.message);
             }
         });
    }
    function closeVerify() { $('#otp-slider').removeClass('open'); }
    
    function verifyOtp() {
        let otp = '';
        $('.otp-digit').each(function(){ otp += $(this).val(); });
        let val = (otpModel == 'email') ? $('#email').val() : $('#phone').val();
        
        $.post("{{ route('profile.verify-otp') }}", { 
            model: otpModel, 
            otp: otp, 
            value: val, 
            _token: "{{ csrf_token() }}" 
        }, function(resp){
            if(resp.success) {
                alert(resp.message);
                closeVerify();
                location.reload();
            } else {
                alert(resp.message);
            }
        });
    }
    
    // OTP Inputs Auto-focus
    $(document).on('input', '.otp-digit', function() {
        if(this.value.length >= 1) {
            $(this).next('.otp-digit').focus();
        }
    });
</script>
@endpush
