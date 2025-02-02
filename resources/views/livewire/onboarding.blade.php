<div>
    <!-- Step 1: Select User Type -->
    @if ($step === 1)
        <div class="row p-5">
            <!-- Left Side Content (col-8) -->
            <div class="col-md-8">
                <h6 class="text-muted fst-italic mb-3">Welcome to Bajar Bhaw!</h6>
                <h6 class="text-muted fst-italic mb-4">"Let's get to know you better."</h6>
                <div>
                    <h3 class="fw-bold">
                        <span class="{{ $userType ? 'text-muted' : '' }}">I am</span>
                        <span
                            class="{{ $userType ? '' : 'text-muted' }}">{{ $userType ? ucfirst($userType) : 'Individual / Business' }}</span>
                    </h3>

                    <!-- User Selection Buttons -->
                    <button class="btn btn-outline-primary w-100 my-2 {{ $userType === 'individual' ? 'active' : '' }}"
                        wire:click="selectUserType('individual')">
                        Individual
                    </button>

                    <button class="btn btn-outline-primary w-100 my-2 {{ $userType === 'business' ? 'active' : '' }}"
                        wire:click="selectUserType('business')">
                        Business
                    </button>

                    <!-- Navigation Buttons -->
                    <div class="d-flex mt-4">
                        <button class="btn btn-secondary me-2" disabled>Back</button>
                        <button class="btn btn-primary" wire:click="nextStep" {{ $userType ? '' : 'disabled' }}>
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Side Image (col-4) -->
            <div class="col-md-4">
                <img src="{{ asset('cartoon-style-architecture.jpg') }}" alt="Onboarding Image" class="img-fluid">
            </div>
        </div>
    @endif

    <!-- Step 2: User Info -->
    @if ($step == 2 && $userType === 'individual')
        <div class="row p-5">
            <!-- Left Side Content (col-8) -->
            <div class="col-md-8">
                <h6 class="text-muted fst-italic mb-3">"Great! Just a few details to tailor your experience."</h6>
                <h5 class="fw-bold mb-4">Personal Details</h5>

                <!-- Name -->
                <div class="mb-3 form-floating">
                    <input type="text" id="name" class="form-control" wire:model="name"
                        placeholder="Please enter your name">
                    <label for="name">Name</label>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row mb-5">
                    <!-- Phone Number -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <input type="number" id="phone" class="form-control" wire:model="phone"
                            placeholder="Please enter your phone number">
                        <label for="phone">Phone Number*</label>
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <input type="email" id="email" class="form-control" wire:model="email"
                            placeholder="Please enter your email">
                        <label for="email">Email ID*</label>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h5 class="fw-bold mb-4">Address</h5>

                <div class="row">
                    <!-- State Dropdown -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <select class="form-select" id="state" wire:model="state">
                            <option value="">Select State</option>
                            @foreach ($states as $stateOption)
                                <option value="{{ $stateOption }}">{{ $stateOption }}</option>
                            @endforeach
                        </select>
                        <label for="state">State</label>
                        @error('state')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City Dropdown -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <select class="form-select" id="city" wire:model="city">
                            <option value="">Select City</option>
                            @foreach ($cities as $cityOption)
                                <option value="{{ $cityOption }}">{{ $cityOption }}</option>
                            @endforeach
                        </select>
                        <label for="city">City</label>
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex mt-4 mb-4">
                    <button class="btn btn-secondary me-2" wire:click="prevStep">Back</button>
                    <button class="btn btn-primary" wire:click="nextStep">Next</button>
                </div>
            </div>

            <!-- Right Side Image (col-4) -->
            <div class="col-md-4">
                <img src="{{ asset('cartoon-style-architecture.jpg') }}" alt="Onboarding Image" class="img-fluid">
            </div>
        </div>
    @endif

    @if ($step == 2 && $userType === 'business')
        <div class="row p-5">
            <!-- Left Side Content (col-8) -->
            <div class="col-md-8">
                <h6 class="text-muted fst-italic mb-3">"Awesome! Share some quick info to get started."</h6>
                <h5 class="fw-bold mb-4">Business Details</h5>

                <div class="row mb-3">
                    <!-- Business Name -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <input type="text" id="business_name" class="form-control" wire:model="business_name"
                            placeholder="Please enter your business name">
                        <label for="business_name">Business Name *</label>
                        @error('business_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- GST Number -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <input type="number" id="gst_number" class="form-control" wire:model="gst_number"
                            placeholder="Please enter your GST number">
                        <label for="gst_number">GST Number</label>
                        @error('gst_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <!-- Phone Number -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <input type="text" id="phone" class="form-control" wire:model="phone"
                            placeholder="Please enter your phone number">
                        <label for="phone">Phone Number *</label>
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <input type="email" id="email" class="form-control" wire:model="email"
                            placeholder="Please enter your email">
                        <label for="email">Email ID *</label>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <h5 class="fw-bold mb-4">Business Address</h5>

                <div class="row">
                    <!-- Business Address -->
                    <div class="col-12 mb-3 form-floating">
                        <input type="text" id="business_address" class="form-control"
                            wire:model="business_address" placeholder="Please enter your business address">
                        <label for="business_address">Business Address</label>
                        @error('business_address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State Dropdown -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <select class="form-select" id="state" wire:model="state">
                            <option value="">Select State</option>
                            @foreach ($states as $stateOption)
                                <option value="{{ $stateOption }}">{{ $stateOption }}</option>
                            @endforeach
                        </select>
                        <label for="state">State</label>
                        @error('state')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- City Dropdown -->
                    <div class="col-12 col-md-6 mb-3 form-floating">
                        <select class="form-select" id="city" wire:model="city">
                            <option value="">Select City</option>
                            @foreach ($cities as $cityOption)
                                <option value="{{ $cityOption }}">{{ $cityOption }}</option>
                            @endforeach
                        </select>
                        <label for="city">City</label>
                        @error('city')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Google Map Link -->
                <div class="mb-3 form-floating">
                    <input type="text" id="google_map_link" class="form-control" wire:model="google_map_link"
                        placeholder="Please enter your Google Map link">
                    <label for="google_map_link">Google Map Link</label>
                    @error('google_map_link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Navigation Buttons -->
                <div class="d-flex mt-4 mb-4">
                    <button class="btn btn-secondary me-2" wire:click="prevStep">Back</button>
                    <button class="btn btn-primary" wire:click="nextStep">Next</button>
                </div>
            </div>

            <!-- Right Side Image (col-4) -->
            <div class="col-md-4">
                <img src="{{ asset('cartoon-style-architecture.jpg') }}" alt="Onboarding Image" class="img-fluid">
            </div>
        </div>
    @endif

    <!-- Step 3 -->
    @if ($step === 3)
    @endif
</div>
