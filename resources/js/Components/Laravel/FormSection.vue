<script setup>
import {computed, useSlots} from 'vue';
import SectionTitle from './SectionTitle.vue';

defineEmits(['submitted']);

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <SectionTitle>
            <template #title>
                <slot name="title"/>
            </template>
            <template #description>
                <slot name="description"/>
            </template>
        </SectionTitle>

        <div class="mt-5 md:mt-0 md:col-span-2 dark:border dark:border-gray-600 dark:rounded-md">
            <form @submit.prevent="$emit('submitted')">
                <div
                    class="px-4 py-5 bg-background sm:p-6 shadow"
                    :class="hasActions ? 'rounded-tl-md rounded-tr-md' : 'rounded-md'"
                >
                    <div class="grid grid-cols-6 gap-6">
                        <slot name="form"/>
                    </div>
                </div>

                <div v-if="hasActions"
                     class="flex items-center justify-end px-4 py-3 bg-background text-end sm:px-6 shadow rounded-bl-md rounded-br-md">
                    <slot name="actions"/>
                </div>
            </form>
        </div>
    </div>
</template>
