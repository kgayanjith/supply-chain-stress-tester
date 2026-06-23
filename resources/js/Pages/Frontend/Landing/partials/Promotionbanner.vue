<template>
    <div class="container-fluid px-lg-5 mt-5">
        <div>
            <h3 class="">Promotions!</h3>
        </div>
        <div class="banner-wrapper mt-5">
            <div class="swiper mySwiper BannersSlider">
                <div class="swiper-wrapper">
                    <Link class="swiper-slide" v-for="banner in banners" :key="banner.id">
                    <div class="banner-inner-wrapper">
                        <img :src="banner.media[0]?.original_url" class="w-100 rounded-4" alt="">
                    </div>
                    </Link>
                </div>
                <div class="swiper-pagination"></div>
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
        var swiper = new Swiper(".BannersSlider", {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 1.3,
                    spaceBetween: 10,
                },
                1024: {
                    slidesPerView: 1.3,
                    spaceBetween: 10,
                }
            }
        });
    }

}
</script>

<style>
.banner-wrapper .swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: #7e7e7e;
    opacity: 1;
    margin: 0 3px !important;
    position: relative;
}

.banner-wrapper .swiper-pagination-bullet-active {
    width: 27px;
    border-radius: 18px;
    background: #000000;
}
</style>