<div class="user-profile">
    <div class="user-info text-center pb-2">
        @if(Auth::user()->profile_image)
            <img class="user-img img-fluid rounded-circle w-25 mt-2"
                 src="{{ asset('uploads/profile_images/' . Auth::user()->profile_image) }}" alt="avatar"/>
        @else
            <img class="user-img img-fluid rounded-circle w-25 mt-2"
                 src="{{Vite::asset('resources/images/avatar-s-19.png')}}" alt="avatar"/>
        @endif
        <div class="name-wrapper d-block dropdown mt-1">
            <a class="white dropdown-toggle" id="user-account" href="#" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <span class="user-name">{{Auth::user()->name}}</span>
            </a>
            <div class="text-light">{{Auth::user()->email}}</div>
            <div class="dropdown-menu arrow" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="{{route('profile.edit')}}">
                    <i class="material-icons align-middle mr-1">person</i>
                    <span class="align-middle">Profile</span>
                </a>

                <a class="dropdown-item" href="{{route('logout')}}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="material-icons align-middle mr-1">power_settings_new</i>
                    <span class="align-middle">Log Out</span>
                </a>
            </div>
        </div>
    </div>
</div>
