<template>
    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid px-lg-5">
                <Link class="navbar-brand">
                <div class="nav-bar-logo-wrapper">
                    <img src="/Images/resilimart-black.png" width="120" alt="">
                </div>
                </Link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item mx-1">
                            <Link class="nav-link px-3" :class="{ active: route().current('home') }" :href="route('home')">Home</Link>
                        </li>
                        <li class="nav-item mx-1">
                            <Link class="nav-link px-3" :class="{ active: route().current('allproducts') }" :href="route('allproducts')">All Products</Link>
                        </li>
                        <li class="nav-item mx-1">
                            <Link class="nav-link px-3" href="#">Categories</Link>
                        </li>
                        <li class="nav-item mx-1">
                            <Link class="nav-link px-3" href="#">FAQ</Link>
                        </li>
                        <li class="nav-item mx-1">
                            <Link class="nav-link px-3" href="#">About Us</Link>
                        </li>
                    </ul>
                    <div class="d-md-none">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                </div>
                <div class="d-none d-md-block">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </main>
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