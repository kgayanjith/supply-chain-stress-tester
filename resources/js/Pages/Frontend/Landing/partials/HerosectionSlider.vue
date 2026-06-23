<template>
    <div class="container-fluid px-lg-5">
        <div class="slider-wrapper">
            <div class="row row-wrapper justify-content-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="column-wrapper p-4 rounded rounded-4 left-column card h-100 border-0 shadow-0">
                        <h1 class="slider-header-text">Elevate your lifestyle with premium essentials. </h1>
                        <p class="pt-2">Discover a thoughtfully curated collection of premium essentials designed to
                            bring elegance,
                            comfort, and exceptional quality into every aspect of your everyday life.</p>

                        <div class="btn-browse-wrapper mt-3">
                            <Link class="btn-browse-main">Browse Products</Link>
                            <Link class="btn-browse-arrow">
                            <i class="fa-solid fa-arrow-right"></i>
                            </Link>
                        </div>
                        <div class="product-wrapper mt-5">
                            <div class="swiper mySwiper bg-white p-2 rounded-4 secondarySlider shadow-sm">
                                <div class="swiper-wrapper">
                                    <Link class="swiper-slide">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="mt-2">
                                                <span class="grey-shade py-2 px-4 rounded-pill">Featured</span>
                                            </div>
                                            <div class="descriptions px-2 mt-4">
                                                <h4 class="text-truncate">Apex X Pro Smartwatch</h4>
                                                <p class="mt-3">Featuring a vibrant
                                                    touch display, fitness tracking and a
                                                    durable comfortable design</p>
                                                <h5 class="mt-4">Rs 22500.00</h5>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="img-wrapper-product rounded-4 m-2">
                                                <img src="/Images/frontend/watch.png" class="w-100 h-100" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    </Link>
                                    <Link class="swiper-slide">
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="mt-2">
                                                <span class="grey-shade py-2 px-4 rounded-pill">Featured</span>
                                            </div>
                                            <div class="descriptions px-2 mt-4">
                                                <h4 class="text-truncate">Apex X Pro Smartwatch</h4>
                                                <p class="mt-3">Featuring a vibrant
                                                    touch display, fitness tracking and a
                                                    durable comfortable design</p>
                                                <h5 class="mt-4">Rs 22500.00</h5>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="img-wrapper-product rounded-4 m-2">
                                                <img src="/Images/frontend/watch.png" class="w-100 h-100" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    </Link>

                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="column-wrapper p-4 rounded rounded-4 right-column">

                        <div class="swiper mySwiper mainSlider">
                            <div class="swiper-wrapper">
                                <Link class="swiper-slide pb-1">
                                    <div class="mt-2">
                                        <span class="white-shade py-2 px-4 rounded-pill">Featured</span>
                                    </div>
                                    <div class="image-wrapper text-center">
                                        <img src="/Images/frontend/apple.png" class="w-75" alt="">
                                    </div>
                                    <div class="description-box bg-white p-3 rounded-4 shadow-sm">
                                        <h3 class="">Apple AirPods Max USB-C Noise Cancelling</h3>
                                        <p class="mt-3">Experience the pinnacle of performance and design with the Apple
                                            MacBook Pro 16-inch, featuring a stunning Retina display, </p>
                                        <h5 class="mt-4">Rs 750000.00</h5>

                                    </div>
                                </Link>
                                <Link class="swiper-slide mb-1">
                                    <div class="mt-2">
                                        <span class="white-shade py-2 px-4 rounded-pill">Featured</span>
                                    </div>
                                    <div class="image-wrapper text-center">
                                        <img src="/Images/frontend/apple.png" class="w-75" alt="">
                                    </div>
                                    <div class="description-box bg-white p-3 rounded-4 shadow-sm">
                                        <h3 class="">Apple AirPods Max USB-C Noise Cancelling</h3>
                                        <p class="mt-3">Experience the pinnacle of performance and design with the Apple
                                            MacBook Pro 16-inch, featuring a stunning Retina display, </p>
                                        <h5 class="mt-4">Rs 750000.00</h5>

                                    </div>
                                </Link>

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';


export default {
    components: {
        Link
    },
    props: {
        banners: Object
    },
    mounted() {
        var swiper1 = new Swiper(".secondarySlider", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
        var swiper1 = new Swiper(".mainSlider", {
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    }
}
</script>

<style>
.slider-wrapper .swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: #7e7e7e;
    opacity: 1;
    margin: 0 3px !important;
    position: relative;
}

.slider-wrapper .swiper-pagination-bullet-active {
    width: 27px;
    border-radius: 18px;
    background: #000000;
}

/* .slider-wrapper .product-wrapper .swiper-pagination {
    text-align: left;
    margin-left: 20px;
} */
</style>