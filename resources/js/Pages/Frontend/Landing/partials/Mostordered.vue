<template>
    <div class="container-fluid px-lg-5 mt-5">
        <div>
            <h3 class="">Most Ordered Products</h3>
        </div>
        <div class="row mt-5">
            <div class="col-md-3" v-for="product in 4">
                <div class="product-wrapper">
                    <Link class="card rounded-4 p-1" href="/product">
                        <img src="/Images/frontend/watch.png" class="card-img-top w-100 rounded-3" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <div>
                                    <p class="product-category-text">Electronics</p>
                                </div>
                                <div>
                                    <h5 class="card-title">Rs 12000.00</h5>
                                </div>
                            </div>

                            <h4 class="card-title comfortaa">Apex Pro SmartWatch</h4>
                            <div class="mb-2 d-flex align-items-center">
                                <div class="stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <div class="review-count">
                                    <p class="mb-0 ps-1">4.0</p>
                                </div>
                            </div>
                            <p class="card-text two-line-clamp">Featuring a vibrant
                                touch display, fitness tracking and a
                                durable comfortable design</p>

                            <div class="buy-bar w-100 mt-3">
                                <Link href="#" class="buy-link">
                                Add to Cart
                                </Link>
                            </div>
                        </div>
                    </Link>
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
    }
}
</script>

<style></style>