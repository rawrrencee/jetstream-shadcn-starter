<!--suppress ALL -->
<script setup>
import {useColorMode} from '@vueuse/core'
import {Icon} from '@iconify/vue'
import {Button} from '@/Components/ui/button/index.js'

defineProps({
    variant: {type: String, default: 'ghost'}
})

const mode = useColorMode()
</script>

<template>
    <Button :variant=variant @click="mode = mode === 'light'? 'dark' : 'light'"
            class="min-w-14">
        <transition enter-active-class="transition ease-in duration-300"
                    enter-from-class="opacity-0 rotate-90"
                    enter-to-class="opacity-100 rotate-0"
                    leave-active-class="transition ease-in duration-300"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
        >
            <Icon v-show="mode === 'dark'"
                  class="absolute h-5 w-5"
                  icon="radix-icons:moon"/>
        </transition>
        <transition enter-active-class="transition ease-in duration-300"
                    enter-from-class="opacity-0 -rotate-90"
                    enter-to-class="opacity-100 rotate-0"
                    leave-active-class="transition ease-in duration-300"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
            <Icon v-show="mode === 'light'"
                  class="absolute h-5 w-5"
                  icon="radix-icons:sun"/>
        </transition>
        <span class="sr-only">Toggle theme</span>
    </Button>
</template>
