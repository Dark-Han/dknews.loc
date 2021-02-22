<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css?v=13')}}">
    <link rel="stylesheet" href="{{asset('css/smoothbox.css')}}">
    <link rel="stylesheet" href="{{asset('css/hc-offcanvas-nav.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="shortcut icon" href="images/dk_icon.png" type="image/png">

    <meta name="google" content="notranslate">

    <!-- BACKEND DEVELOPER STYLES -->
    <style type="text/css">
        .container {
            max-width: 1154px !important;
        }

        .video_cover iframe {
            width: 100%;
            height: 200px;
        }

        @media screen and (max-width: 415px) {
            .search_lenta {
                display: none !important;
                visibility: hidden !important;
            }
        }

        /*iframe{
            height: 100% !important;
            width: 210px !important;
        }*/
        .inner-text iframe {
            max-width: 100% !important;
            /*height: 350px !important;*/
        }

        .inner-text blockquote {
            margin: 0 0 1rem;
            margin-left: 25px;
            border-left: 4px solid #0000003d;
            padding-left: 21px;
            padding-top: 12px;
            padding-bottom: 18.5px;
            font-family: 'Times New Roman', Times, serif;
            font-style: italic;
        }

        .inner-text blockquote>p {
            font-family: 'Times New Roman', Times, serif;
            font-style: italic;
            font-size: 16px;
            margin-bottom: 2px;
        }

        .info-img>img {
            height: auto;
            width: 170px;
        }

        .inner-text blockquote a {
            /* color: #2c6cc2;*/
            font-family: 'Times New Roman', Times, serif;
            font-style: italic;
            font-size: 16px;
        }

        strong a {
            font-weight: bolder !important;
        }

        /*картинки категории после главные новости сегодня на главной странице */
        .category-img img {
            width: 100%;
            height: 180px;
            max-height: 183.61px;
            display: block;
            margin: inherit;
            object-fit: fill;
        }

        /*картинки шелкового пути и окно в китай на главной странице*/

        /*для переноса текста вво внутренней странице новостей*/
        .inner-text,
        .main-white-section {
            word-wrap: break-word;
        }

        .inner-text img {
            width: 100% !important;
            height: auto !important;
        }

        /*шрифт валюты*/
        .kurs p {
            font-size: 10px;
        }

        /*картинки баннеров на главной странице в разделе категории после главные новости сегодня*/
        .banner-m img {
            display: block;
            margin: auto;
            height: 100%;
            max-height: 241px;
        }

        @media (min-width: 1200px) {
            #ban-13 img{
                width: 300px;
                position: absolute;
                display: block;
                /* margin: auto; */
                height: 600px;
                max-height: 600px;
                margin-left: -14px;
            }
            .main-banner-img {
                margin-bottom: 1.4rem
            }

            .main-banner-img .big-img-news {
                height: 100%;
            }

            .small-img-news {
                height: 160px;
            }
        }

        .inner-text p img {
            margin: 3px 0;
        }

        .inner-text td {
            border: 1px solid black;
            padding: 10px;
        }

        .inner-text td>p {
            margin: 0px !important;
        }

        .inner-text table {
            width: 100%;
            margin-bottom: 20px;
        }

        .inner-text em a {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="content">

        <!--    header-->
        @if(!empty($firstBanner))
            <div class="pre-header">
                <div class="container">
                    <a href="{{$firstBanner->link}}"><img src="{{asset('storage/'.$firstBanner->cover)}}" style="height: 49px;width: 100%" class="img-fluid" alt=""></a>
                </div>
            </div>
        @endif
        <div class="blue-bg" data-wow-delay="0.1s">
            <div class="container">
                <div class="blue bg-mob">
                    <div class="row">
                        <div class="col-6">
                            <div class="logo-mob">
                                <a href="/"><img src="{{asset('images/logo.png')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-6">
                            <select name="" id="" onchange="window.location = this.value">
                                @foreach($languages as $lng)
                                    <option value=""><a href="/{{strtolower($lng->name)}}">{{$lng->name}}</a></option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="socials">
                            @foreach($links as $item)
                                @if($item->link_type_id<10)
                                    <a href="{{$item->link}}"><i class="fab fa-{{$item->linkTypes->name}}"></i></a>
                                @endif
                             @endforeach
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="weather-wrap weather-desctop">
                            <div class="weather">
                                <i class="fas fa-temperature-high"></i>
                                <p>Нур-Султан</p>
                                <div class="weather-icon" id="weat_icon_nur">

                                </div>
                                <p id="weat_nur"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="weather-wrap weather-desctop">
                            <div class="weather">
                                <i class="fas fa-temperature-high"></i>
                                <p>Алматы</p>
                                <div class="weather-icon" id="weat_icon_ala">

                                </div>
                                <p id="weat_ala"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="lang">
                            <ul>
                               @foreach($languages as $lng)
                                    <li><a href="/{{strtolower($lng->name)}}">{{$lng->name}}</a></li>
                               @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="white-bg" data-wow-delay="0.2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-sm-2">
                        <div class="logo">
                            <a href="/"><img src="images/logo.png" alt=""></a>
                        </div>
                        <div class="app-btn">
                            @foreach($links as $item)
                                @if($item->link_type_id>9)
                                    <a href="{{$item->link}}" target="_blank">
                                    <img style="height:44px !important;width:118px !important" src="{{asset('storage/'.$item->linkTypes->name)}}.png?v=2" alt="">
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-2">
                        <div class="currency currency-desktop kurs kurs-2">
                            <p id="hang"> </p>
                            <p id="ftse"> </p>
                            <p id="dow"> </p>
                            <p id="kase"> </p>
                        </div>
                    </div>
                    <div class="col-xl-2 col-sm-2 p-0" style='padding:0px !important'>
                        <div class="currency currency-desktop kurs-2">
                            <p id="brent"> </p>
                            <p id="wti"> </p>
                            <p id="gold"> </p>
                            <p id="ptc"> </p>
                        </div>
                    </div>
                    <div class="col-sm-1 p-0">
                        <div class="currency currency-desktop kurs-2">
                            <p id="usa"> </p>
                            <p id="rub"> </p>
                            <p id="eur"> </p>
                            <p id="cny"> </p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-4">
                        <div class="semi-logo">
                            <a href="/"><img src="{{asset('images/dk_logo.jpg')}}" class="img-fluid" alt=""></a>
                        </div>
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="dropdown">
                                    <button class="dropdown-toggle" data-toggle="dropdown">Газета
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="topics.php?id_cat=27">Читайте в номере</a></li>
                                        <li><a onclick="window.open('{{asset($lastNewsPaper->newspaper)}}')" style="color: white;cursor: pointer;">Свежий выпуск ДК</a></li>
                                        <li><a href="archive.php"> Архив газеты</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="search">
                                    <input type="text" id="search" name="search">
                                    <a style="margin-left: 10px;cursor: pointer;" onclick="header_search()"><img src="../images/search.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blue-line"></div>
            <div class="container">
                <div class="menu">
                    <ul>
                        @foreach($headerCategories as $category)
                            <li><a  href="{{"$locale/$category->slug"}}">{{$category->name}}</a></li>
                        @endforeach
                        <li>
                            <div class="dropdown show">
                                <button class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #172f47;font:15px 'RCB',sans-serif;margin-top: 6px;">
                                    Еще
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-7">
                    <nav id="main-nav">
                        <ul>
                            <li>
                                <div class="row weather-mob">
                                    <div class="col-6">
                                        <div class="weather">
                                            <p>Нур-Султан</p>
                                            <div class="weather-icon weat_icon_nur-mob">

                                            </div>
                                            <p class="weat_nur_mob"></p>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="weather">
                                            <p>Алматы</p>
                                            <div class="weather-icon weat_icon_ala-mob">

                                            </div>
                                            <p class="weat_ala_mob"></p>
                                        </div>
                                    </div>

                                </div>
                                <div class="row d-flex currency-mob-bg">
                                    <div class="col-6">
                                        <div class="currency currency-mob kurs-2">
                                            <p class="usa-mob"> </p>
                                            <p class="rub-mob"> </p>
                                            <p class="eur-mob"> </p>
                                            <p class="cny-mob"> </p>
                                        </div>
                                        <br>
                                        <div class="currency currency-mob kurs-2">
                                            <p class="brent-mob"> </p>
                                            <p class="wti-mob"> </p>
                                            <p class="gold-mob"> </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="currency currency-mob kurs">
                                            <p class="kase-mob"> </p>
                                            <p class="dow-mob"> </p>
                                            <p class="ptc-mob"> </p>
                                            <p class="ftse-mob"> </p>
                                            <p class="hang-mob"> </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
        <!--    end header-->
        @yield('main')
        <footer class="footer">
            <div class="container">
                <div class="row wow fadeInUp">
                    <div class="col-sm-3">
                        <div class="fot-logo">
                            <a href=""><img src="images/logo.png" alt=""></a>
                        </div>
                        <div class="app-btn">

                        </div>
                        <div class="fot-socials">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="fot-menu">
                            <ul>
                                <li><a href="about-us.php">О нас</a></li>
                                <li><a href="ads.php">Реклама</a></li>
                                <li><a href="rights-info.php">Правовая информация</a></li>
                                <li><a href="contacts.php">Контакты</a></li>
                                <li><a href="site-map.php">Карта сайта</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="fot-title">
                            <h6>ПОДПИСКА НА НОВОСТИ </h6>
                        </div>
                        <div class="fot-text">
                            <p>Подписывайтесь на наши новости и оставайтесь в курсе последних событий</p>
                        </div>
                        <div class="fot-form">
                            <input type="text" id="v_email" placeholder="Ваша почта">
                            <button onclick="podpiska(v_email.value)"></button>
                        </div>
                        <span id="_zero_52144">
                            <noscript>
                                <a href="http://zero.kz/?s=52144" target="_blank">
                                    <img src="http://c.zero.kz/z.png?u=52144" width="88" height="31" alt="ZERO.kz" />
                                </a>
                            </noscript>
                        </span>
                        <!--LiveInternet logo--><a href="//www.liveinternet.ru/click" target="_blank"><img src="//counter.yadro.ru/logo?14.11" title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодня" alt="" border="0" width="88" height="31" /></a>
                        <!--/LiveInternet-->
                    </div>
                </div>

            </div>
            </div>
            <div class="fot-line"></div>
            <div class="container">
                <div class="row wow fadeInUp">
                    <div class="col-sm-6">
                        <div class="rights">
                            <p>2006 - 2021 © Деловой Казахстан. 16+</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="rights">

                        </div>
                    </div>
                </div>
            </div>
        </footer>

        </body>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/hc-offcanvas-nav.js"></script>
        <script>
            jQuery(document).ready(function($) {
                $('#main-nav').hcOffcanvasNav({
                    maxWidth: 980
                });
            });
        </script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js"></script>
        <script src="{{asset('js/smoothbox.min.js')}}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/wow.min.js')}}"></script>

        <script src="{{asset('js/select-option.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script>
            new WOW().init();
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll-infinite.min.js"></script>
        <script src="{{asset('js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('js/wow.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
        </html>