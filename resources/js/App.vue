<template lang="">
    <div>

        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar  ">
            <div class="layout-container">

                <!-- Menu -->
                <Menu v-if="store.get_token" />

                <!-- Layout container -->
                <div class="layout-page" :class="{'no-menu': !store.get_token}">
                    <!-- Navbar -->
                    <nav v-if="store.get_token" class="layout-navbar container-fluid navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                        id="layout-navbar">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none" 
                        @click="toggleMenu">
                            <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                                <i class="icon-base bx bx-menu icon-md"></i>
                            </a>
                        </div>
                        <div class="navbar-nav-right d-flex align-items-center justify-content-end"
                            id="navbar-collapse">
                            <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                                <!-- Language -->
                                <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                        data-bs-toggle="dropdown">
                                        <i class="icon-base bx bx-globe icon-md"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-language="en"
                                                data-text-direction="ltr">
                                                <span>English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" data-language="fr"
                                                data-text-direction="ltr">
                                                <span>Lao</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!--/ Language -->

                                <!-- Style Switcher -->
                                <li class="nav-item dropdown me-2 me-xl-0">
                                    <a class="nav-link dropdown-toggle hide-arrow" id="nav-theme"
                                        href="javascript:void(0);" data-bs-toggle="dropdown">
                                        <i class="icon-base bx bx-sun icon-md theme-icon-active"></i>
                                        <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                                        <li>
                                            <button type="button" class="dropdown-item align-items-center active" @click="switchToLight"
                                                data-bs-theme-value="light" aria-pressed="false">
                                                <span><i class="icon-base bx bx-sun icon-md me-3"
                                                        data-icon="sun"></i>Light</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item align-items-center" @click="switchToDark"
                                                data-bs-theme-value="dark" aria-pressed="true">
                                                <span><i class="icon-base bx bx-moon icon-md me-3"
                                                        data-icon="moon"></i>Dark</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item align-items-center" @click="switchToLight"
                                                data-bs-theme-value="system" aria-pressed="false">
                                                <span><i class="icon-base bx bx-desktop icon-md me-3"
                                                        data-icon="desktop"></i>System</span>
                                            </button>
                                        </li>
                                    </ul>
                                </li>
                                <!-- / Style Switcher-->

                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                        data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            <img :src="url + '/assets/img/avatars/1.png'" alt="" class="rounded-circle">
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            <img :src="url + '/assets/img/avatars/1.png'" alt=""
                                                                class="w-px-40 h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-0">John Doe</h6>
                                                        <small class="text-body-secondary">Admin</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider my-1"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="pages-profile-user.html"> <i
                                                    class="icon-base bx bx-user icon-md me-3"></i><span>My
                                                    Profile</span> </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="pages-account-settings-account.html"> <i
                                                    class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="pages-account-settings-billing.html">
                                                <span class="d-flex align-items-center align-middle">
                                                    <i
                                                        class="flex-shrink-0 icon-base bx bx-credit-card icon-md me-3"></i><span
                                                        class="flex-grow-1 align-middle">Billing Plan</span>
                                                    <span class="flex-shrink-0 badge rounded-pill bg-danger">4</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider my-1"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="pages-pricing.html"> <i
                                                    class="icon-base bx bx-dollar icon-md me-3"></i><span>Pricing</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="pages-faq.html"> <i
                                                    class="icon-base bx bx-help-circle icon-md me-3"></i><span>FAQ</span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider my-1"></div>
                                        </li>
                                        <li>
                                            <a class="dropdown-item cursor-pointer" @click="Logout()"> 
                                                <i class="icon-base bx bx-power-off icon-md me-3"></i><span>ອອກຈາກລະບົບ</span> 
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!--/ User -->

                            </ul>
                        </div>

                    </nav>
                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">

                        <!-- Content -->
                        <div class="container-fluid flex-grow-1 container-p-y">

                            <router-view />
                            
                        </div>

                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme" v-if="store.get_token">
                            <div class="container-xxl">
                                <div
                                    class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                    <div class="mb-2 mb-md-0">
                                        © 2025 PSG
                                    </div>
                                    <div class="d-none d-lg-inline-block">

                                        Developed by <a href="#" class="footer-link fw-bolder">IT Team PSG</a>

                                    </div>
                                </div>
                            </div>
                        </footer>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>

        </div>
        <!-- / Layout wrapper -->

    </div>
</template>
<script>

import axios from 'axios';
import { useStore } from './Store/Auth';

    export default {
        setup() {
            // useStore
            const store = useStore();

            // toggle the menu on mobile view
            const toggleMenu = () => {
                const html = document.documentElement;

                const isMobile = window.innerWidth < 992; // Bootstrap XL breakpoint

                if (isMobile) {
                    // Mobile view
                    if (html.classList.contains('layout-menu-expanded')) {
                        html.classList.remove('layout-menu-expanded');
                        html.classList.add('layout-menu-collapsed');
                    } else {
                        html.classList.add('layout-menu-expanded');
                        html.classList.remove('layout-menu-collapsed');
                    }
                } else {
                    // Desktop view
                    if (html.classList.contains('layout-menu-collapsed')) {
                        html.classList.remove('layout-menu-collapsed');
                    } else {
                        html.classList.add('layout-menu-collapsed');
                    }
                }
            };

            const switchToDark = () => {
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            };

            const switchToLight = () => {
                document.documentElement.setAttribute('data-bs-theme', 'light');
            };

            return { store, toggleMenu, switchToDark, switchToLight };
        },
        data() {
            return {
                url: window.location.origin
            }
        },
        methods: {
            Logout(){
                axios.get('api/logout',{ headers:{ Authorization: 'Bearer '+this.store.get_token } }).then((res)=>{
                    if(res.data.success){
                        // clear data from localstorage
                        localStorage.removeItem('web_token');
                        localStorage.removeItem('web_user');
                        //clear data from pinia
                        this.store.remove_token();
                        this.store.remove_user();
                        //user go to login page
                        this.$router.push('/login');
                    }
                }).catch((error)=>{
                    console.log(error);
                })
            }
        },
    }

</script>
<style>
    .no-menu {
  padding-left: 0 !important;
}
</style>
