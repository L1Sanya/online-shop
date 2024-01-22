<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Store</title>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<header class="header">
    <div class="container">
        <a href="/" class="logo" title="Store">
            <img src="https://imdiz.ru/files/store/img/logo.png" alt="Logo">
        </a>
        <div class="header-right">
            <form class="search-form">
                <input type="text" name="search" value="" placeholder="Search" class="search-input">
                <button><i class="fa fa-search search-i"></i></button>
            </form>
            <div class="cart-informer">
                <button class="cart-informer__button">
                    <span class="cart-informer__count">1</span>
                    <span class="cart-informer__icon"><i class="fa fa-shopping-cart cart-informer__icon-i"></i></span>
                    <span class="cart-informer__value">$100.00</span>
                    <i class="fa fa-chevron-down cart-informer__i"></i>
                </button>
            </div>
        </div>
        <div class="container logout">
            <a style="color: #e0e0e0" href="src/actions/logout.php">Выход</a>
        </div>
    </div>
</header>


<!-- NEW -->
<div class="menu">
    <div class="container menu__container">
        <div class="catalog">
            <div class="catalog__wrapper">
                <div class="catalog__header"><span>Categories</span><i class="fa fa-bars catalog__header-icon"></i></div>
                <ul class="catalog__list">
                    <li class="catalog__item">
                        <a href="/" class="catalog__link">
                            <img src="https://imdiz.ru/files/store/img/icons_catalog/desktops.png" alt="Desktops" class="catalog__link-img">
                            Desktops
                        </a>
                        <div class="catalog__subcatalog">
                            <a href="/" class="catalog__subcatalog-link">PC (0)</a>
                            <a href="/" class="catalog__subcatalog-link">Mac (1)</a>
                        </div>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="https://imdiz.ru/files/store/img/icons_catalog/laptops.png" alt="Laptops & Notebooks" class="catalog__link-img">Laptops & Notebooks</a>
                        <div class="catalog__subcatalog">
                            <a href="/" class="catalog__subcatalog-link">Macs (0)</a>
                            <a href="/" class="catalog__subcatalog-link">Windows (1)</a>
                        </div>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="https://imdiz.ru/files/store/img/icons_catalog/components.png" alt="Components" class="catalog__link-img">Components</a>
                        <div class="catalog__subcatalog">
                            <a href="/" class="catalog__subcatalog-link">Mice and Trackballs (0)</a>
                            <a href="/" class="catalog__subcatalog-link">Monitors (1)</a>
                            <a href="/" class="catalog__subcatalog-link">Printers (0)</a>
                            <a href="" class="catalog__subcatalog-link">Scanners (0)</a>
                            <a href="" class="catalog__subcatalog-link">Web Cameras (0)</a>
                        </div>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="https://imdiz.ru/files/store/img/icons_catalog/tablets.png" alt="Tablets" class="catalog__link-img">Tablets</a>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="https://imdiz.ru/files/store/img/icons_catalog/software.png" alt="Software" class="catalog__link-img">Software</a>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="https://imdiz.ru/files/store/img/icons_catalog/phones.png" alt="Phones & PDAs" class="catalog__link-img">Phones & PDAs</a>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="https://imdiz.ru/files/store/img/icons_catalog/cameras.png" alt="Cameras" class="catalog__link-img">Cameras</a>
                    </li>
                    <li class="catalog__item">
                        <a href="/" class="catalog__link"><img src="https://imdiz.ru/files/store/img/icons_catalog/mp3.png" alt="MP3 Players" class="catalog__link-img">MP3 Players</a>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="menu__nav">
            <a href="/" class="menu__nav-link">My Account</a>
            <a href="/" class="menu__nav-link">Wish List</a>
            <a href="/" class="menu__nav-link">Shopping Cart</a>
            <a href="/" class="menu__nav-link">Checkout</a>
        </nav>
        <a href="tel:+99999999999" class="menu__phone"><i class="fa fa-phone menu__phone-icon"></i> <span class="menu__phone-span">Call us:</span> +9 999 99 999 99</a>
    </div>
</div>
<div class="slider">
    <div class="container">
        <div class="slider__wrapper">
            <div class="slider__carousel">
                <div class="slider__carousel_item">
                    <div class="slider__carousel_desc">
                        <p class="slider__carousel_desc-title">Belkinon</p>
                        <p class="slider__carousel_desc-text">New powerfull</p>
                        <p class="slider__carousel_desc-text">Headphones</p>
                        <a href="/" class="slider__carousel_button">More</a>
                    </div>
                    <img src="https://imdiz.ru/files/store/img/banner/headphone.webp" class="slider__img" alt="Slide 1">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END -->



</body>
</html>

<style>/* NEW */
@font-face {
font-family: Roboto;
font-display:swap;
src: url(https://imdiz.ru/files/store/fonts/Roboto.ttf);
}
*{
box-sizing: border-box;
}
/* END */



html, body{
margin: 0;


/* NEW */
font-size: 16px;
font-family: Roboto;
/* END */



}
.header{
background: #cb2d41;
padding: 35px 0;
}
.container{
width: 1140px;
display: flex;
align-items: center;
padding-left: 15px;
padding-right: 15px;
margin-top: 0;
margin-bottom: 0;
margin-left: auto;
margin-right: auto;
}
.header-right{
display: flex;
align-items: center;
margin-left: auto;
}
.search-form {
display: flex;
align-items: center;
margin: 0 auto;
width: 270px;
height: 50px;
border: 1px solid rgba(255,255,255,.2);
padding-left: 5px;
padding-right: 10px;
}
input {
outline: 0;
border: none;
background: none;
}
.search-input {
color: #fff;
width: 90%;
height: 100%;
font-size: 12px;
}
::-webkit-input-placeholder {
color: #fff
}

:-moz-placeholder {
color: #fff
}

::-moz-placeholder {
color: #fff
}

:-ms-input-placeholder {
color: #fff
}
button {
outline: 0;
border: none;
background: none;
cursor: pointer;
}
.search-i {
color: #fff;
}
.cart-informer {
color: #fff;
padding-top: 0;
padding-left: 20px;
}
.cart-informer__button {
margin-left: auto;
margin-right: auto;
display: flex;
align-items: center;
}
.cart-informer__count {
color: #111;
font-size: 10px;
background-color: #fff;
width: 23px;
height: 23px;
margin-right: -4px;
margin-left: 4px;
display: flex;
align-items: center;
justify-content: center;
}
.cart-informer__icon {
width: 45px;
height: 45px;
border: 1px solid rgba(255,255,255,.2);
display: flex;
align-items: center;
justify-content: center;
}
.cart-informer__icon-i {
color: #fff;
}
.cart-informer__i, .cart-informer__value {
color: #fff;
font-weight: 700;
font-size: 12px;
padding-left: 10px;
}
.cart-informer__i {
font-size: 11px;
margin-top: -2px;
}



/* NEW */
.menu {
height: 60px;
}
.menu__container {
position: relative;
}
.catalog {
position: absolute;
width: 260px;
top: 0;
background-color: #fff;
}
.catalog__header {
height: 60px;
font-weight: bold;
padding-left: 20px;
padding-right: 20px;
border: 1px solid #e0e0e0;
border-bottom: none;
border-top: none;
justify-content: space-between;
align-items: center;
display: flex;
}
.catalog__header-icon {
font-size: 21px;
}
.catalog__list {
position: relative;
z-index: 2;
}
ul {
padding: 0;
margin: 0;
}
li {
list-style: none;
margin: 0;
padding: 0;
}
.catalog__link {
height: 60px;
font-size: 14px;
padding-left: 20px;
padding-right: 20px;
border: 1px solid #e0e0e0;
border-bottom: none;
align-items: center;
display: flex;
}
.catalog__link-img {
margin-right: 10px;
margin-top: -3px;
}
.catalog__subcatalog {
width: 867px;
display: flex;
flex-direction: column;
flex-wrap: wrap;
background-color: #fff;
position: absolute;
opacity: 0;
visibility: hidden;
left: 280px;
top: 0;
height: 100%;
padding: 20px;
transition: all .3s;
}
.catalog__item:hover .catalog__subcatalog {
opacity: 1;
visibility: visible;
left: 260px;
}
.catalog__subcatalog-link {
font-size: 14px;
color: #111;
padding-top: 5px;
padding-bottom: 5px;
}
.menu__nav {
padding-left: 290px;
height: 100%;
display: flex;
align-items: center;
}
.menu__nav-link {
font-weight: bold;
font-size: 14px;
padding-right: 20px;
transition: all .3s;
}
.menu__phone {
display: flex;
align-items: center;
justify-content: flex-end;
color: #cb2d41;
font-size: 14px;
font-weight: bold;
margin-left: auto;
border-left: 1px solid #e0e0e0;
padding-left: 40px;
height: 60px;
}
.menu__phone-icon {
font-size: 18px;
}
.menu__phone-span {
padding-left: 10px;
padding-right: 5px;
color: #111;
transition: all .3s;
}
.menu__phone:hover .menu__phone-span {
color: #cb2d41;
}
.slider {
background: url(https://imdiz.ru/files/store/img/banner/bg-slider.png) no-repeat;
height: 541px;
}
.slider__wrapper {
width: 600px;
margin-left: 400px;
height: 541px;
}
.slider__carousel_desc {
position: absolute;
top: 110px;
color: #fff;
}
.slider__carousel_desc-title {
font-size: 90px;
}
.slider__carousel_desc-text {
font-size: 35px;
padding-top: 5px;
}
.slider__carousel_desc-text {
font-size: 35px;
padding-top: 5px;
}
.slider__carousel_button {
color: #fff;
font-size: 14px;
font-weight: bold;
text-transform: uppercase;
background-color: #cb2d41;
width: 160px;
height: 50px;
margin-top: 20px;
transition: all .3s;
display: flex;
justify-content: center;
align-items: center;
}
.slider__carousel_button:hover {
background-color: #111;
color: #fff;
}
.slider__img {
display: block;
width: 100%;
}
.slider__carousel{
width: 100%;
position: relative;
z-index: 1;
}
p {
margin: 0;
padding: 0;
}
img {
border-style: none;
}
a {
color: #111;
text-decoration: none;
}
a:hover {
color: #cb2d41;
}
/* END */</style>
