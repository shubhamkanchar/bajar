<div>
    @switch($tab)
        @case('product-review')
            <livewire:admin.product-review />
            @break
        @case('service-review')
            <livewire:admin.service-review />
            @break
        @case('approved-product')
            <livewire:admin.approved-product />
            @break
        @case('approved-service')
            <livewire:admin.approved-service />
            @break
        @case('product-sellers')
            <livewire:admin.product-seller type="product"/>
            @break
        @case('service-providers')
            <livewire:admin.product-seller type="service"/>
            @break
        @case('individuals')
            <livewire:admin.product-seller type="individual"/>
            @break
        @case('blogs')
            <livewire:admin.blogs/>
            @break
        @case('tc')
            <livewire:admin.tc/>
            @break
        @case('setting')
            <livewire:admin.setting/>
            @break
        @default
            <livewire:admin.product-review />
    @endswitch
</div>

@section('style')
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
    </style>
@endsection