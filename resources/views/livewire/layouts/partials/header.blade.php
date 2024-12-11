<div>
    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3">
                            <div class="logo-img">
                                <a href="index.html">
                                    <img src="img/logo.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="menu_wrap d-none d-lg-block">
                                <div class="menu_wrap_inner d-flex align-items-center justify-content-end">
                                    <div class="main-menu">
                                        <nav>
                                            <ul id="navigation">
                                                <li><a class="{{ Request::routeIs('home') ? 'active' : '' }}"
                                                        href="{{ route('home') }}" wire:navigate>Home</a>
                                                </li>
                                                <li><a class="{{ Request::routeIs('service') ? 'active' : '' }}"
                                                        href="{{ route('service') }}" wire:navigate>Services</a></li>
                                                <li><a class="{{ Request::routeIs('about') ? 'active' : '' }}"
                                                        href="{{ route('about') }}" wire:navigate>About</a>
                                                </li>
                                                <li><a class="{{ Request::routeIs('contact') ? 'active' : '' }}"
                                                        href="{{ route('contact') }}" wire:navigate>Contact</a></li>
                                            </ul>
                                        </nav>

                                    </div>
                                    <div class="book_room">
                                        <div class="book_btn">
                                          
                                            <a class="popup-with-form"
                                                wire:click="$dispatch('showAppointmentModal')">Appointment</a>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @livewire('appointment-form')
    </header>
    {{-- header-end --}}
</div>
