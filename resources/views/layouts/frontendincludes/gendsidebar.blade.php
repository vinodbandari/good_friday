<div class="single__widget widget__bg">
    <h2 class="widget__title h3">Filter By Gender</h2>

    <ul class="widget__categories--menu">

        <li class="widget__categories--sub__menu--list">
            <a class="widget__categories--sub__menu--link d-flex align-items-center"
                href="{{ request()->fullUrlWithQuery(['gend_by' => 'male']) }}">
                <span class="widget__categories--sub__menu--text">Male</span>
            </a>
            <a class="widget__categories--sub__menu--link d-flex align-items-center"
                href="{{ request()->fullUrlWithQuery(['gend_by' => 'female']) }}">
                <span class="widget__categories--sub__menu--text">Female</span>
            </a>
        </li>


    </ul>

</div>
