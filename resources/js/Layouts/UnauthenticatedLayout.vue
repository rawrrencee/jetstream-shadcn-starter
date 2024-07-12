<script setup>
import UnauthenticatedNavBar from "@/Components/LayoutSupport/UnauthenticatedNavBar.vue";
import {Head} from "@inertiajs/vue3";

defineProps({
    title: String,
});
</script>

<template>
    <div class="flex-grow flex flex-col">
        <Head :title="title"/>
        <Toast/>
        <UnauthenticatedNavBar/>

        <!-- Page Content -->
        <main class="h-full">
            <slot/>
        </main>
    </div>
</template>
