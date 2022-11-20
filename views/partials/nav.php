<header>
    <nav class="nav">
        <a class="navbar-brand" href="<?php echo URL_SERVER?>">
            <img src="<?php echo URL_VISTA?>img/logo.webp" height="36" alt="<?php echo URL_SERVER?>" loading="lazy"
                style="margin-top: -3px" />
        </a>
        <ul class="nav-item">
            <li class="menu "> <a href="<?php echo URL_SERVER?>">INICIO</a></li>
            <li id="servicios" class="menu">
                <a href="<?php echo URL_SERVER?>products">TIENDA </a>
                <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 28 16">
                    <path d="M1.57 1.59l12.76 12.77L27.1 1.59" stroke-width="2" fill="none" fill-rule="evenodd"></path>
                </svg>
                <ul class="submenu">
                    <li><a class="d-block " style="text-align:left" href="<?php echo URL_SERVER?>products?category=perdidapeso">Control de peso </a></li>
                    <li> <a class="d-block " style="text-align:left" href="<?php echo URL_SERVER?>products?category=modulosproteicos">Ganar masa muscular </a>
                    </li>
                    <li> <a class="d-block " style="text-align:left" href="<?php echo URL_SERVER?>products?category=hipercaloricos">Hipercalóricos</a></li>
                    <li><a class="d-block " style="text-align:left" href="<?php echo URL_SERVER?>products?category=energiarecuperacion">Aminoácidos </a></li>
                </ul>



            </li>
            <li class="menu"> <a href="<?php echo URL_SERVER?>#info-servicios">
                    ASESORÍAS</a>
                <svg aria-hidden="true" focusable="false" role="presentation" viewBox="0 0 28 16">
                    <path d="M1.57 1.59l12.76 12.77L27.1 1.59" stroke-width="2" fill="none" fill-rule="evenodd"></path>
                </svg>
                <ul class="submenu width160">
                    <li>Glúteos 24kl</li>
                    <li>Asesoría nutricional</li>
                    <li>Entrenamiento</li>
                </ul>


            </li>
            <li id="pagos" class="menu"> <a>PAGOS</a></li>
            <li id="contacto" class="menu"> <a href="<?php echo URL_SERVER?>#contacto-info">CONTACTO</a> </li>
        </ul>
        <span id="showCard" class="car-shopping me-3 me-md-5">
            <span class="counter">
                6
            </span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z">
                </path>
            </svg>
        </span>
        <span id="menu-bar" class="car-shopping me-2 ">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </span>
    </nav>
</header>
<div class="modal">
    <div class="menu-panel">
        <div class="ratio ratio16x9 mb-4 appear-animation" data-class-appear="appear-delay-2">
            <div class="swiper mySwiper ">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"
                        style="background-image: url('<?php echo URL_VISTA?>img/carousels/packages.webp'); background-size: cover; background-position: top center;  ">



                    </div>
                    <div class="swiper-slide"
                        style="background-image: url('<?php echo URL_VISTA?>img/carousels/packages.webp'); background-size: cover; background-position: top center;  ">


                    </div>
                    <div class="swiper-slide"
                        style="background-image: url('<?php echo URL_VISTA?>img/carousels/facility.webp'); background-size: cover; background-position: top center;  ">


                    </div>
                    <div class="swiper-slide"
                        style="background-image: url('<?php echo URL_VISTA?>img/carousels/classes.webp'); background-size: cover; background-position: top center;  ">


                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
        <ul class=" mb-4 ">
            <li id="inicio" class="appear-animation " data-class-appear="appear-delay-2"><a
                    href="<?php echo URL_SERVER?>">INICIO</a> </li>
            <li class="appear-animation" data-class-appear="appear-delay-3"><a
                    href="<?php echo URL_SERVER?>products">TIENDA </a></li>
            <li class="appear-animation" data-class-appear="appear-delay-4"><a
                    href="<?php echo URL_SERVER?>#info-servicios">ASESORÍAS</a></li>
            <li class="appear-animation" data-class-appear="appear-delay-5"> <a
                    href="<?php echo URL_SERVER?>#contacto-info">CONTACTO</a></li>
            <li class="appear-animation" data-class-appear="appear-delay-6">
                <div class="mobile-nav__has-sublist">
                    <button id="collapse" type="button" aria-controls="Linklist-6"
                        class="mobile-nav__link--button mobile-nav__link--top-level collapsible-trigger collapsible--auto-height is-open"
                        aria-expanded="true">
                        <span class="mobile-nav__faux-link">
                            SUPLEMENTACIÓN
                        </span>
                        <div class="mobile-nav__toggle">
                            <span class="faux-button"><span
                                    class="collapsible-trigger__icon collapsible-trigger__icon--open"
                                    role="presentation">
                                    <svg aria-hidden="true" focusable="false" role="presentation"
                                        class="icon icon--wide " viewBox="0 0 28 16">
                                        <path d="M1.57 1.59l12.76 12.77L27.1 1.59" stroke-width="2" fill="none"
                                            fill-rule="evenodd"></path>
                                    </svg>
                                </span>
                            </span>
                        </div>
                    </button>
                </div>


            </li>
        </ul>

        <div id="Linklist-6" class="mb-4 mobile-nav__sublist collapsible-content collapsible-content--all">
            <div class="collapsible-content__inner">
                <ul class="mobile-nav__sublist">
                    <li class="mobile-nav__item">
                        <div class="mobile-nav__child-item">
                            <a href="<?php echo URL_SERVER?>products?category=perdidapeso">Control de peso </a>
                        </div>
                    </li>
                    <li class="mobile-nav__item">
                        <div class="mobile-nav__child-item">

                            <a href="<?php echo URL_SERVER?>products?category=modulosproteicos">Ganar masa muscular </a>
                        </div>
                    </li>
                    <li class="mobile-nav__item">
                        <div class="mobile-nav__child-item">
                            <a href="<?php echo URL_SERVER?>products?category=hipercaloricos">Hipercalóricos</a>
                        </div>
                    </li>
                    <li class="mobile-nav__item">
                        <div class="mobile-nav__child-item">
                            <a href="<?php echo URL_SERVER?>products?category=energiarecuperacion">Aminoácidos</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


        <ul class="mobile-nav__social appear-animation " data-class-appear="appear-delay-7">
            <li class="mobile-nav__social-item">
                <a target="_blank" rel="noopener" href="https://www.instagram.com/mulatafit/"
                    title="silBe by Silvy en Instagram">
                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-instagram"
                        viewBox="0 0 32 32">
                        <path fill="#00BF40"
                            d="M16 3.094c4.206 0 4.7.019 6.363.094 1.538.069 2.369.325 2.925.544.738.287 1.262.625 1.813 1.175s.894 1.075 1.175 1.813c.212.556.475 1.387.544 2.925.075 1.662.094 2.156.094 6.363s-.019 4.7-.094 6.363c-.069 1.538-.325 2.369-.544 2.925-.288.738-.625 1.262-1.175 1.813s-1.075.894-1.813 1.175c-.556.212-1.387.475-2.925.544-1.663.075-2.156.094-6.363.094s-4.7-.019-6.363-.094c-1.537-.069-2.369-.325-2.925-.544-.737-.288-1.263-.625-1.813-1.175s-.894-1.075-1.175-1.813c-.212-.556-.475-1.387-.544-2.925-.075-1.663-.094-2.156-.094-6.363s.019-4.7.094-6.363c.069-1.537.325-2.369.544-2.925.287-.737.625-1.263 1.175-1.813s1.075-.894 1.813-1.175c.556-.212 1.388-.475 2.925-.544 1.662-.081 2.156-.094 6.363-.094zm0-2.838c-4.275 0-4.813.019-6.494.094-1.675.075-2.819.344-3.819.731-1.037.4-1.913.944-2.788 1.819S1.486 4.656 1.08 5.688c-.387 1-.656 2.144-.731 3.825-.075 1.675-.094 2.213-.094 6.488s.019 4.813.094 6.494c.075 1.675.344 2.819.731 3.825.4 1.038.944 1.913 1.819 2.788s1.756 1.413 2.788 1.819c1 .387 2.144.656 3.825.731s2.213.094 6.494.094 4.813-.019 6.494-.094c1.675-.075 2.819-.344 3.825-.731 1.038-.4 1.913-.944 2.788-1.819s1.413-1.756 1.819-2.788c.387-1 .656-2.144.731-3.825s.094-2.212.094-6.494-.019-4.813-.094-6.494c-.075-1.675-.344-2.819-.731-3.825-.4-1.038-.944-1.913-1.819-2.788s-1.756-1.413-2.788-1.819c-1-.387-2.144-.656-3.825-.731C20.812.275 20.275.256 16 .256z">
                        </path>
                        <path fill="#00BF40"
                            d="M16 7.912a8.088 8.088 0 0 0 0 16.175c4.463 0 8.087-3.625 8.087-8.088s-3.625-8.088-8.088-8.088zm0 13.338a5.25 5.25 0 1 1 0-10.5 5.25 5.25 0 1 1 0 10.5zM26.294 7.594a1.887 1.887 0 1 1-3.774.002 1.887 1.887 0 0 1 3.774-.003z">
                        </path>
                    </svg>

                </a>
            </li>
            <li class="mobile-nav__social-item">
                <a target="_blank" rel="noopener" href="https://www.facebook.com/mulatafit"
                    title="silBe by Silvy en Facebook">
                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-facebook"
                        viewBox="0 0 32 32">
                        <path fill="#1E85FF"
                            d="M18.56 31.36V17.28h4.48l.64-5.12h-5.12v-3.2c0-1.28.64-2.56 2.56-2.56h2.56V1.28H19.2c-3.84 0-7.04 2.56-7.04 7.04v3.84H7.68v5.12h4.48v14.08h6.4z">
                        </path>
                    </svg>

                </a>
            </li>
            <li class="mobile-nav__social-item">
                <a target="_blank" rel="noopener" href="https://www.youtube.com/channel/UCCdilQ85P1s0zd_S_t928Jw"
                    title="silBe by Silvy en YouTube">
                    <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-youtube"
                        viewBox="0 0 21 20">
                        <path fill="#D00C00"
                            d="M-.196 15.803q0 1.23.812 2.092t1.977.861h14.946q1.165 0 1.977-.861t.812-2.092V3.909q0-1.23-.82-2.116T17.539.907H2.593q-1.148 0-1.969.886t-.82 2.116v11.894zm7.465-2.149V6.058q0-.115.066-.18.049-.016.082-.016l.082.016 7.153 3.806q.066.066.066.164 0 .066-.066.131l-7.153 3.806q-.033.033-.066.033-.066 0-.098-.033-.066-.066-.066-.131z">
                        </path>
                    </svg>

                </a>
            </li>
        </ul>
    </div>
</div>