<template>
    <main class="dashboard-container" ref="dashboard">
        <!-- Overlay for mobile -->
        <div v-if="isSidebarOpen" class="sidebar-overlay" @click="isSidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside class="sidebar shadow-sm" :class="{ 'show': isSidebarOpen }">
            <div class="sidebar-content">
                <div class="d-flex justify-content-end">
                    <button @click="isSidebarOpen = false" class="btn-close d-lg-none p-3" aria-label="Close"></button>
                </div>
                <!-- Logo/Header -->
                <div class="sidebar-header">
                    <div class="logo-icon">
                        <img src="/Images/scst.png" class="w-100" alt="">
                    </div>

                </div>

                <!-- Navigation Items -->
                <nav class="sidebar-nav">
                    <div>
                        <div class="accordion accordion-flush" id="overviewAccordion">
                            <div class="accordion-item">
                                <div class="side-bar-header">
                                    <p class="text-dark text-uppercase">overview</p>
                                </div>
                                <div id="overview" class="accordion-collapse collapse show"
                                    data-bs-parent="#overviewAccordion">
                                    <div class="accordion-body pt-0 px-1">
                                        <div class="nav-item text-black">
                                            <Link :href="route('dashboard')" class="nav-link" v-bind:class="{
                                                active: addActiveClass(['dashboard']),
                                            }">
                                            <i class="fa-solid fa-chart-simple"></i>
                                            Dashboard
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link position-relative">
                                            <i class="fa-solid fa-cash-register"></i>
                                            <span class="position-relative">
                                                Notifications
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger ms-2">
                                                    2
                                                </span>
                                            </span>

                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                            <i class="fa-solid fa-calendar"></i>
                                            Calender
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="accordion accordion-flush" id="salesAccordion">
                            <div class="accordion-item">


                                <div class="side-bar-header">
                                    <p class="text-dark text-uppercase">Sales & CRM</p>
                                </div>


                                <div id="sales" class="accordion-collapse collapse show"
                                    data-bs-parent="#salesAccordion">
                                    <div class="accordion-body pt-0 px-1">
                                         <div class="nav-item text-black">
                                            <Link :href="route('product.index')" class="nav-link" v-bind:class="{
                                                active: addActiveClass(['product.index', 'product.create'])
                                            }"
                                            >
                                            <i class="fa-solid fa-bag-shopping"></i>
                                            Products 
                                            </Link>
                                        </div>
                                         <div class="nav-item text-black">
                                            <Link :href="route('pcategory.index')" class="nav-link" v-bind:class="{
                                                active: addActiveClass(['pcategory.index', 'pcategory.create', 'pcategory.edit'])
                                            }">
                                        <i class="fa-solid fa-shapes"></i>
                                            Products Categories
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link :href="route('customer.index')" class="nav-link" v-bind:class="{
                                                active: addActiveClass(['customer.index', 'customer.create', 'customer.edit']),
                                            }">
                                            <i class="fa-solid fa-users"></i>
                                            Customers
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                         <i class="fa-solid fa-store"></i>
                                            Sales
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                          <i class="fa-solid fa-truck"></i>
                                            Deliveries
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                          <i class="fa-solid fa-retweet"></i>
                                            Returns
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="accordion accordion-flush" id="purchasingAccordion">
                            <div class="accordion-item">
                                <div class="side-bar-header">
                                    <p class="text-dark text-uppercase">Purchasing</p>
                                </div>
                                <div id="purchasing" class="accordion-collapse collapse show"
                                    data-bs-parent="#purchasingAccordion">
                                    <div class="accordion-body pt-0 px-1">
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                           <i class="fa-solid fa-boxes-packing"></i>
                                            Suppliers
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                           <i class="fa-solid fa-bookmark"></i>
                                            Purchase Orders
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                           <i class="fa-solid fa-share"></i>
                                            Supplier Returns
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="accordion accordion-flush" id="inventoryAccordion">
                            <div class="accordion-item">
                                <div class="side-bar-header">
                                    <p class="text-dark text-uppercase">Inventory</p>
                                </div>
                                <div id="inventory" class="accordion-collapse collapse show"
                                    data-bs-parent="#inventoryAccordion">
                                    <div class="accordion-body pt-0 px-1">
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                          <i class="fa-solid fa-boxes-stacked"></i>
                                            Materials
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                          <i class="fa-solid fa-layer-group"></i>
                                            Categories
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                           <i class="fa-solid fa-warehouse"></i>
                                            Locations
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                            <i class="fa-solid fa-braille"></i>
                                            Stock On Hand
                                            </Link>
                                        </div>
                                        <div class="nav-item text-black">
                                            <Link href="" class="nav-link">
                                           <i class="fa-solid fa-location-crosshairs"></i>
                                            Serial Tracking
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </nav>

                <!-- User Profile Section -->
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="main-wrapper">
            <!-- Top Navigation Bar -->
            <header class="top-navbar shadow-sm mx-3 mt-3 rounded-4">
                <div class="d-flex align-items-center justify-content-between">
                    <button @click="isSidebarOpen = true" class="btn btn-link d-lg-none p-0">
                        <i class="fa-solid fa-bars fs-3 text-dark"></i>
                    </button>
                    <div class="d-none d-lg-block">

                    </div>
                    <div class="d-flex align-items-center profile">
                        <!-- <button class="btn btn-link position-relative p-2">
              <i class="bi bi-bell fs-5 text-secondary"></i>
              <span class="notification-badge"></span>
            </button> -->
                        <div class="d-none d-lg-block pe-4">
                            <div type="button" @click="toggleFullscreen()">
                                <i class="text-secondary fa-solid" :class="isFullScreen
                                    ? 'fa-down-left-and-up-right-to-center'
                                    : 'fa-up-right-and-down-left-from-center'"></i>
                            </div>
                        </div>
                        <div class="dropdown">
                            <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"
                                style="cursor: pointer;">
                                <img :src="$page.props.auth.user.profile_photo_url" alt="Profile" class="rounded-circle"
                                    style="width: 40px; height: 40px; object-fit: cover;">
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end mt-3 border-0 p-2 shadow rounded-4">
                                <li class="dropdown-header">
                                    <div class="d-flex align-items-center">
                                        <img :src="$page.props.auth.user.profile_photo_url" alt="Profile"
                                            class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                        <div>
                                            <div class="fw-bold text-black">{{ $page.props.auth.user.name }}</div>
                                            <small class="text-muted">{{ $page.props.auth.user.email }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <Link class="dropdown-item text-danger" @click="logout()">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </Link>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="main-content py-3 px-1 mx-3 mt-3 shadow-sm bg-white">
                <div class="container-fluid p-4">
                    <slot />
                </div>
            </main>
        </div>
    </main>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    data() {
        return {
            isSidebarOpen: false,
            currentRoute: "",
            isFullScreen: false,
        };
    },
    components: {
        Link,
    },
    methods: {
        logout() {
            this.$inertia.post(this.route('logout'));
        },
        addActiveClass(routes) {
            if (routes.includes(route().current())) {
                return true;
            } else {
                return false;
            }
        },
        sync() {
            this.isFullscreen = !!document.fullscreenElement;
        },
        async toggleFullscreen() {
            try {
                if (!document.fullscreenElement) {
                    await document.documentElement.requestFullscreen();
                    this.isFullScreen = true;
                } else {
                    await document.exitFullscreen();
                    this.isFullScreen = false;
                }
            } catch (e) {
                console.error("Fullscreen error:", e);
            }
        },
    },
    mounted() {
        document.addEventListener("fullscreenchange", this.sync);
        this.sync();
    },
    beforeUnmount() {
        document.removeEventListener("fullscreenchange", this.sync);
    },

}
</script>

<style></style>
