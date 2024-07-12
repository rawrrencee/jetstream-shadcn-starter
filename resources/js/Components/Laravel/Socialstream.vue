<script setup>
import InputError from '@/Components/Laravel/InputError.vue';
import ProviderIcon from '@/Components/SocialstreamIcons/ProviderIcon.vue';
import {Button} from "@/Components/ui/button/index.js"

defineProps({
    prompt: {
        type: String,
        default: null,
    },
    error: {
        type: String,
        default: null,
    },
    providers: {
        type: Array,
    },
    labels: {
        type: Object,
    }
});
</script>

<template>
    <div v-if="providers.length" class="space-y-6">
        <div v-if="prompt" class="relative flex items-center">
            <div class="flex-grow border-t border-gray-400"></div>
            <span class="flex-shrink text-gray-400 px-6">
                {{ prompt }}
             </span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>

        <InputError v-if="error" :message="error" class="text-center"/>

        <div class="grid gap-4">
            <template v-for="provider in providers" :key="provider.id">
                <Button variant="outline" type="button">
                    <a
                        :href="route('oauth.redirect', provider.id)"
                        class="flex flex-row gap-2 items-center w-full justify-center">
                        <ProviderIcon :provider="provider" classes="h-6 w-6 mx-2"/>
                        <span class="block font-medium text-sm">Login with {{
                                provider.buttonLabel || provider.name
                            }}</span>
                    </a>
                </Button>
            </template>
        </div>
    </div>
</template>
