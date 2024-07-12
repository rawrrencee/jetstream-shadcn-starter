<script setup>
import ApplicationMark from "@/Components/ApplicationLogo.vue";
import {Button} from "@/Components/ui/button";
import {Head, Link} from "@inertiajs/vue3";
import DarkModeToggle from "@/Components/LayoutSupport/DarkModeToggle.vue";

defineProps({
    title: String,
});
</script>

<template>
    <Head :title="title"/>

    <div class="sticky top-0 flex min-h-16 items-center gap-4 border-b bg-background px-4 md:px-6 z-10">
        <nav
            class="flex flex-1 flex-row flex-wrap items-center justify-between gap-5 text-sm lg:gap-6">
            <div class="flex items-center gap-2 text-lg font-semibold">
                <ApplicationMark class="block h-8 w-auto"/>
                <span>Lunex</span>
            </div>

            <div class="flex flex-shrink flex-row items-center">
                <DarkModeToggle/>
                <Link :href="route('login')">
                    <Button variant="ghost">
                        <span>Login</span>
                    </Button>
                </Link>
            </div>
        </nav>
    </div>
</template>
