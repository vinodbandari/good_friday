<div class="my__account--section__inner border-radius-10 d-flex">
    <div id="success_message"></div>
    <div class="account__left--sidebar">
        <h2 class="account__content--title h3 mb-20">My Profile</h2>
        <ul class="account__menu">
            {{-- @if(Auth::user()->is_admin == 1) --}}
            {{-- <li class="account__menu--list"><a href="{{ url('/home') }}">Admin</a></li> --}}
            {{-- @endif --}}
            <li class="account__menu--list"><a href="{{ url('my-orders') }}">Dashboard</a></li>
            <li class="account__menu--list"><a href="{{url('view-address/'.auth()->id())}}">Addresses</a></li>
            <li class="account__menu--list"><a href="{{ url('wishlist') }}">Wishlist</a></li>
            <li class="account__menu--list">
                <a  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 Log Out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>





















    <div class="account__wrapper">
        <div class="account__content">
            <h2 class="account__content--title h3 mb-20">Addresses</h2>
            {{-- <button class="new__address--btn primary__btn mb-25" type="button" data-bs-toggle="modal" data-bs-target="#AddAddressModal">Add a new address</button> --}}
            <a href="/newaddress" class="new__address--btn primary__btn mb-25" type="button">Add a new address</a>

            @foreach ($address as $user)
            <div class="account__details two">
                <h3 class="account__details--title h4">Default</h3>

                <p class="account__details--desc"> {{ $user->address1 ?? '' }} <br> {{ $user->address2 ?? '' }} <br>{{ $user->state }}<br> {{ $user->country ?? '' }} <br>{{ $user->phone }}</p>

            </div>
            @endforeach
            <br><br>

            <a class="account__details--link" href="/viewnewaddress">View Addresses({{ $new_address_count }})</a>
            {{-- <div class="account__details--footer d-flex">
                <button class="account__details--footer__btn" data-bs-toggle="modal" data-bs-target="#AddAddressModal" type="button" >Edit</button>
                <button class="account__details--footer__btn" type="button">Delete</button>
            </div> --}}
        </div>
    </div>


</div>

