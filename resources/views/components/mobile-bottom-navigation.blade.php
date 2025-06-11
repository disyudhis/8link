<div>

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg z-40">
        @if (auth()->user()->user_type == \App\Models\User::ROLE_USER)
            @include('components.bottom-nav.user')
        @elseif(auth()->user()->user_type == \App\Models\User::ROLE_ADMIN)
            @include('components.bottom-nav.admin')
        @elseif(auth()->user()->user_type == \App\Models\User::ROLE_WORKER)
            @include('components.bottom-nav.worker')
        @endif
    </nav>

</div>
<!-- CSS Styles -->
<style>
    [x-cloak] {
        display: none !important;
    }

    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-ripple {
        position: relative;
        overflow: hidden;
    }

    .btn-ripple:after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }

    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }

        100% {
            transform: scale(100, 100);
            opacity: 0;
        }
    }

    .btn-ripple:focus:not(:active)::after {
        animation: ripple 1s ease-out;
    }

    /* Tambahkan padding bottom untuk konten agar tidak tertutup navbar */
    body {
        padding-bottom: 4rem;
    }
</style>
