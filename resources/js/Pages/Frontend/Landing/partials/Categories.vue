<template>
    <div class="container-fluid px-lg-5 mt-5">
        <div class="row row-wrapper justify-content-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="p-4 rounded rounded-4 left-column card h-100 border-0 shadow-0 text-center">
                    <h1 class="">Browse by Categories</h1>
                    <p>Explore collections designed to complement your lifestyle and express your individuality.</p>
                </div>
            </div>
        </div>
        <div class="category-slider">
            <div class="swiper mySwiper categorySlider">
                <div class="swiper-wrapper">
                    <Link class="swiper-slide rounded-4" v-for="category in categories" :key="category.id">
                    <div class="wrapper">
                        <div class="cimage-wrapper p-3">
                            <img :src="category.media[0]?.original_url" class="w-100 h-100" alt="">
                        </div>
                        <div class="category-name text-center">
                            <p class="text-black">{{ category.name }}</p>
                        </div>
                    </div>
                    </Link>
                </div>
                <!-- <div class="swiper-pagination"></div> -->
                <!-- <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div> -->
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';


export default {
    data() {
        return {

        };
    },
    props: {
        categories: Object
    },
    components: {
        Link
    },
    mounted() {
        var swiper = new Swiper(".categorySlider", {
            slidesPerView: 7,
            spaceBetween: 10,
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
            // navigation: {
            //     nextEl: ".swiper-button-next",
            //     prevEl: ".swiper-button-prev",
            // },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            loop:true,
            breakpoints: {
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        480: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 15,
        },
        992: {
            slidesPerView: 5,
            spaceBetween: 15,
        },
        1200: {
            slidesPerView: 7,
            spaceBetween: 10,
        },
    },
        });
    }
}
</script>

<style>
.category-slider .swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: #7e7e7e;
    opacity: 1;
    margin: 0 3px !important;
    position: relative;
}

.category-slider .swiper-pagination-bullet-active {
    width: 27px;
    border-radius: 18px;
    background: #000000;
}
</style>