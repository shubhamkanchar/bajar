
<div>
    <div class="container">
        <form id="userUpdates" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 mt-4 position-relative">
                @if($user->bg_image)
                    <img class="w-100 h-250 object-fit-cover rounded-4" id="preview-bg" src="{{ asset('storage/' . $user->bg_image) }}">
                @else
                    <picture>
                        <source media="(max-width: 767px)" srcset="{{ asset('assets/image/mobile/banner_01.png') }}">
                         <img class="w-100 h-250 object-fit-cover rounded-4" id="preview-bg" src="{{ asset('assets/image/desktop/banner_01.png') }}" alt="Banner">
                    </picture>
                @endif
                <input type="file" name="bg_image" hidden id="bgImage" accept="image/*" onchange="previewImage(this, 'preview-bg')">
                {{-- <label role="button" class="position-absolute top-0 end-0 p-2 pe-4" style="z-index: 1" for="bgImage">
                    <i class="fa-solid fa-camera fa-2x text-white"></i>
                </label> --}}
            </div>

            <div class="col-12 mb-3">
                <div class="row">
                    <div class="col-md-4 col-lg-3 col-xl-2 col-6 offset-3 offset-sm-0 position-relative" style="margin-top:-70px">
                        @if($user->profile_image)
                            <img class="ms-md-4 square-img-profile" id="preview-profile" src="{{ asset('storage/' . $user->profile_image) }}">
                        @else
                            <img class="ms-md-4 square-img-profile" id="preview-profile" src="{{ asset('assets/image/profile.png') }}">
                        @endif
                        <input type="file" name="profile_image" hidden id="profileImage" accept="image/*" onchange="previewImage(this, 'preview-profile')">
                        <label for="profileImage" role="button" class="position-absolute top-0 end-0 p-2 pe-4 pe-md-0" style="z-index: 1">
                            <i class="fa-solid fa-pencil fa-2x text-dark bg-white rounded-circle p-1"></i>
                        </label>
                    </div>
                </div>
            </div>

            <hr>
            
            <div class="alert bg-custom-secondary fw-bold" role="alert">
                Personal Details
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ $user->name }}">
                        <label>Name</label>
                    </div>
                </div>
                <!-- Skipping complex responsive spacer div -->
                <div class="col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{ $user->phone }}">
                        <label>Phone Number</label>
                    </div>
                </div>
                <!-- Verification Buttons Logic (Skipped for initial conversion, can be added later) -->
                
                <div class="col-md-6">
                     <div class="form-floating mb-2 mt-2">
                        <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                        <label>Email</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="alert bg-custom-secondary fw-bold mt-3" role="alert">
                    Address
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating mb-2 mt-2">
                        <select class="form-select" id="state" name="state">
                            <option value="">Select State</option>
                            @foreach ($stateOptions as $stateOption)
                                <option value="{{ $stateOption }}" {{ ($user->address->state ?? '') == $stateOption ? 'selected' : '' }}>{{ $stateOption }}</option>
                            @endforeach
                        </select>
                        <label>State</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                     <div class="form-floating mb-2 mt-2">
                        <select class="form-select" id="city" name="city">
                            <option value="">Select City</option>
                             @foreach ($cityOptions as $cityOption)
                                <option value="{{ $cityOption }}" {{ ($user->address->city ?? '') == $cityOption ? 'selected' : '' }}>{{ $cityOption }}</option>
                            @endforeach
                        </select>
                        <label>City</label>
                    </div>
                </div>
            </div>
            
             <hr>
            <div class="col-md-12 mt-4 mb-5">
                <button type="submit" class="btn btn-dark btn-lg" id="btn-update">Update</button>
            </div>
        </div>
        </form>
    </div>
    
    <script>
        function previewImage(input, targetId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + targetId).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $(document).ready(function(){
            $('#userUpdates').on('submit', function(e){
                e.preventDefault();
                let btn = $('#btn-update');
                btn.prop('disabled', true);
                
                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('user.update', ['uuid' => $user->uuid]) }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.success) {
                             Toastify({
                                text: response.message,
                                duration: 3000,
                                close: true,
                                gravity: "top", 
                                position: "right", 
                                stopOnFocus: true, 
                                style: {
                                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                                },
                            }).showToast();
                        } else {
                             alert('Update failed');
                        }
                    },
                    error: function(xhr) {
                         let errors = xhr.responseJSON.errors;
                        let errorMessage = 'Something went wrong';
                        if(errors) {
                            errorMessage = Object.values(errors).flat().join('\n');
                        }
                        alert(errorMessage);
                    },
                    complete: function() {
                        btn.prop('disabled', false);
                    }
                });
            });
            
            $('#state').change(function(){
                let state = $(this).val();
                let $city = $('#city');
                $city.empty().append('<option value="">Select City</option>');
                
                // Assuming states is available globally or passed to this view
                // We can output it as a JS variable in the blade template
            });
        });
        
        const states = @json($states);
        
        $('#state').change(function(){
             let state = $(this).val();
             let $city = $('#city');
             $city.empty().append('<option value="">Select City</option>');
             
             if(state && states[state]) {
                 states[state].forEach(function(city){
                     $city.append('<option value="'+city+'">'+city+'</option>');
                 });
             }
        });
    </script>
</div>
