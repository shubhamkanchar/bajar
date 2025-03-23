<div>

    @if ($tab == 'product-review' || $tab == '')
        <livewire:admin.product-review is_approved="{{0}}"/>
    @elseif($tab == 'service-review')
        <livewire:admin.service-review />
    @elseif($tab == 'product-sellers')
        <livewire:admin.product-seller />
    @endif
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