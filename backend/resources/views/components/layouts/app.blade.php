<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Shandong Angel Home Textile Co., Ltd.' }}</title>
    
    <!-- CSS Assets from CDN/Public -->
    <link rel="stylesheet" media="all" href="https://cdn.angelhometex.com/cdn/ff/-psXFuc24ykZjq7hquc-TXEYxkw-sw5TDnvtmUunNtM/1768407679/public/css/css_n8erzsZTpmHgtX-SjxBEDg3k8ftf0bKi41XONfkhNl0.css" />
    <link rel="stylesheet" media="all" href="https://cdn.angelhometex.com/cdn/ff/IJdgMkYWmQVwP5xMRG_JJDus4qPmBDo_Q9jRvvSmgGM/1768407679/public/css/css_pFK7wxEub3FiM03-7WwIO6i63gxlds4j2pUbTHwu6Pk.css" />
    
    <link rel="shortcut icon" href="https://cdn.angelhometex.com/cdn/ff/HeybrJINms4LkUlCVmEAYemeYkG2v76lxRoVk2ogjOY/1745978382/public/2025-04/ico.jpg" />

    @livewireStyles
</head>
<body class="en path-frontpage has-glyphicons">
    <div class="wrapper">
        <div class="dialog-off-canvas-main-canvas" data-off-canvas-main-canvas>
            <div class="page-container">
                <div class="region region-header">
                    <!-- Header Section extracted from index.html -->
                    <div class="full_page_wrapper general_page">
                        <div class="front-page-wrapper">
                            <div class="layout layout--onecol">
                                <div class="layout__region layout__region--content">
                                    <div class="top_banner immersion_banner">
                                        <div class="navbar-wrapper hover_style1">
                                            <div class="container">
                                                <nav class="navbar-mobile bootsnav" role="navigation">
                                                    <div class="logo-menu-wrapper">
                                                        <a href="/" title="Home" rel="home" class="shou-top">
                                                            <img src="https://cdn.angelhometex.com/cdn/ff/Rr5P2tzZE7EcJlFlPJwTTn3uxLdhuDyEsGkQ9T7_3a0/1736929852/public/2025-01/logo1.png" width="230" height="57" alt="Logo" class="img-responsive" />
                                                        </a>
                                                    </div>
                                                    <div class="main-navbar">
                                                        <div class="navbar-collapse-box collapse navbar-collapse" id="navbar-collapse">
                                                            <ul class="nav">
                                                                <li class="dropdown"><a href="/">Home</a></li>
                                                                <li class="dropdown"><a href="/products">Products</a></li>
                                                                <li class="dropdown"><a href="/about-us">About us</a></li>
                                                                <li class="dropdown"><a href="/cases">Cases</a></li>
                                                                <li class="dropdown"><a href="/news">News</a></li>
                                                                <li class="dropdown"><a href="/contact">Contact</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <main>
                    {{ $slot }}
                </main>

                <div class="region region-footer">
                    <!-- Footer Section extracted from index.html -->
                    <div class="footer-wrapper footer3">
                        <div class="container footer-container">
                            <div class="row">
                                <div class="col-md-3 footer-col">
                                    <div class="footer-logo-img">
                                        <img src="https://cdn.angelhometex.com/cdn/ff/DhvvArcGvdM_nZSTMX2znlsTa51F5qDl_UHYoDIFg1A/1736929852/public/logo1.png" alt="Logo" class="img-responsive" />
                                    </div>
                                </div>
                                <div class="col-md-7 footer-col">
                                    <ul class="footer-menu-box">
                                        <li><a href="/products">Products</a></li>
                                        <li><a href="/about-us">About us</a></li>
                                        <li><a href="/news">News</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-copyright">
                            <div class="container">
                                <div>Copyright © 2024 Shandong Angel Home Textile Co., Ltd. All rights reserved</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
    <script src="https://cdn.angelhometex.com/cdn/ff/KwDSSNAoSvILilGtfiuFSCJb3_xvr-MOXZmTTsLi5N0/1768407679/public/js/js_SNWQe2Fo-xoGesYaA8aO71OpaiN-dQwu6x64sRwiHQw.js"></script>
    <script src="https://cdn.angelhometex.com/cdn/ff/eV76smkqjYuqI0UTVYVo5V0QtNObgAYjVaI8DMXN7GA/1768407679/public/js/js_mux-MPQJYAUQQVvxpPc8b8LQdnvuw24rzf0pdwIC2Ys.js"></script>
</body>
</html>
