<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block font-medium text-sm text-muted-foreground">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot/></span>
    </label>
</template>
