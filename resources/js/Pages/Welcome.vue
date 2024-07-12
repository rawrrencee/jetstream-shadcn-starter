<script setup>
import {Link} from '@inertiajs/vue3';
import {Icon} from '@iconify/vue'
import {Button} from "@/Components/ui/button";
import UnauthenticatedLayout from "@/Layouts/UnauthenticatedLayout.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <UnauthenticatedLayout title="Welcome">
        <div class="overflow-hidden dark:bg-gray-900 h-full">
            <div aria-hidden="true"
                 class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div
                    class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"/>
            </div>
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl py-20">
                    <Icon class="block mx-auto h-16 w-16 md:h-24 md:w-24 lg:h-32 lg:w-32"
                          icon="line-md:sunny-outline-to-moon-alt-loop-transition"/>
                    <div class="text-center pt-12">
                        <h1 class="text-4xl font-bold tracking-tight sm:text-6xl">Welcome to Lunex</h1>
                        <p class="mt-6 text-lg leading-8 text-gray-700 dark:text-gray-300">An all-in-one solution for
                            small and medium businesses looking for Point-of-Sales, Inventory, Employee management and
                            more.</p>
                        <div class="mt-10 flex items-center justify-center gap-x-6">
                            <Link :href="route('login')">
                                <Button variant="default">Get Started</Button>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </UnauthenticatedLayout>
</template>
