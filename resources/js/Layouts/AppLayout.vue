<script setup>
import {Head, router} from '@inertiajs/vue3';
import NavBar from "@/Components/LayoutSupport/NavBar.vue";
import SideBar from "@/Components/LayoutSupport/SideBar.vue";
import NavBreadcrumbs from "@/Components/LayoutSupport/NavBreadcrumbs.vue";
import {computed, ref} from "vue";

defineProps({
    title: String,
});

// Constants
const navigationSectionsWithItems = [
    {
        sectionName: 'Employee',
        icon: 'clarity:employee-line',
        items: [
            {
                name: 'Employee Tools',
                icon: 'fluent:window-dev-tools-16-regular',
                subsectionItems: [
                    {
                        name: 'Timecards',
                        icon: 'fluent:phone-screen-time-24-regular',
                        route: 'dashboard'
                    },
                    {
                        name: 'Point of Sales',
                        icon: 'material-symbols-light:point-of-sale-rounded',
                        route: 'dashboard',
                    }
                ]
            }
        ]
    },
    {
        sectionName: 'Admin',
        icon: 'clarity:administrator-line',
        items: [
            {
                name: 'Analytics',
                icon: 'hugeicons:analytics-up',
                subsectionItems: [
                    {
                        name: 'Employees',
                        icon: 'clarity:employee-group-line',
                        route: 'dashboard'
                    },
                    {
                        name: 'Inventory',
                        icon: 'material-symbols:inventory-rounded',
                        route: 'dashboard'
                    }
                ]
            },
            {
                name: 'Users',
                icon: 'clarity:users-line',
                subsectionItems: [
                    {
                        name: 'Customers',
                        icon: 'carbon:customer',
                        route: 'dashboard'
                    },
                    {
                        name: 'Employees',
                        icon: 'clarity:employee-line',
                        route: 'dashboard'
                    }
                ]
            }
        ]
    }
];

// UI
const sideBarWidth = ref('narrow');

// Functions
const logout = () => {
    router.post(route('logout'));
};

const toggleSideBarWidth = () => {
    sideBarWidth.value = isSideBarNarrow.value ? 'default' : 'narrow';
}
const isSideBarNarrow = computed(() => sideBarWidth.value === 'narrow');

</script>

<template>
    <div class="flex-grow flex flex-col">
        <Head :title="title"/>
        <Toast/>
        <NavBar :class="['transition-all', isSideBarNarrow ? 'sm:ml-14' : 'sm:ml-52']"
                :navigationSectionsWithItems/>
        <SideBar :class="['hidden sm:flex transition-all', isSideBarNarrow ? 'w-14' : 'w-52' ]"
                 :navigationSectionsWithItems
                 :isSideBarNarrow
                 @toggle-side-bar-width="() => toggleSideBarWidth()"/>

        <main :class="['h-full transition-all', isSideBarNarrow ? 'sm:ml-14' : 'sm:ml-52']">
            <div class="max-w-7xl mx-auto pt-4 pb-8 px-2 sm:px-4 lg:px-6">
                <NavBreadcrumbs/>
                <slot/>
            </div>
        </main>
    </div>
</template>
