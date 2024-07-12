<script setup>
import {watchEffect} from 'vue';
import {usePage} from '@inertiajs/vue3';
import {toast, Toaster} from "vue-sonner";

const page = usePage();

watchEffect(async () => {
    if (!page.props.jetstream.flash?.banner) {
        return;
    }

    switch (page.props.jetstream.flash?.bannerStyle) {
        case 'danger':
            toast.warning(page.props.jetstream.flash?.banner)
            break;
        case 'success':
            toast.success(page.props.jetstream.flash?.banner)
            break;
        default:
            toast(page.props.jetstream.flash?.banner)
            break;
    }
});
</script>

<template>
    <div>
        <Toaster class="z-10" position="top-center" closeButton/>
    </div>
</template>
