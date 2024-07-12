<script setup>
import {Tooltip, TooltipContent, TooltipProvider, TooltipTrigger,} from '@/Components/ui/tooltip';
import ApplicationMark from "@/Components/ApplicationLogo.vue";
import {Icon} from "@iconify/vue";
import {Link} from '@inertiajs/vue3';
import {DropdownMenu} from "@/Components/ui/dropdown-menu/index.js";
import {Button} from "@/Components/ui/button/index.js";
import AccordionNavigationItems from "@/Components/LayoutSupport/AccordionNavigationItems.vue";

defineProps({
    navigationSectionsWithItems: Array,
    isSideBarNarrow: Boolean
})

defineEmits(['toggleSideBarWidth'])
</script>

<template>
    <aside :class="['fixed inset-y-0 left-0 z-10 flex-col border-r bg-background', isSideBarNarrow ? '' : 'px-4']">
        <nav v-if="isSideBarNarrow" class="flex flex-col items-center gap-4 px-2 sm:py-4">
            <TooltipProvider>
                <Tooltip>
                    <TooltipTrigger as-child>
                        <Link
                            :href="route('dashboard')"
                            class="flex h-9 w-9 items-center justify-center rounded-lg text-muted-foreground transition-colors hover:text-foreground md:h-8 md:w-8"
                        >
                            <ApplicationMark class="block h-8 w-auto"/>
                            <span class="sr-only">Dashboard</span>
                        </Link>
                    </TooltipTrigger>
                    <TooltipContent side="right">
                        Dashboard
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
            <template v-for="section in navigationSectionsWithItems">
                <div class="pt-4">
                    <TooltipProvider>
                        <Tooltip>
                            <TooltipTrigger as-child>
                                <Icon :icon="section.icon" class="h-5 w-5 text-muted-foreground"/>
                            </TooltipTrigger>
                            <TooltipContent side="right">
                                {{ section.sectionName }}
                            </TooltipContent>
                        </Tooltip>
                    </TooltipProvider>
                </div>
                <template v-for="item in section.items">
                    <DropdownMenu>
                        <TooltipProvider :delay-duration="0" disable-closing-trigger>
                            <Tooltip>
                                <TooltipTrigger as-child>
                                    <Button variant='ghost'>
                                        <Icon
                                            :icon="item.icon"
                                            class="h-5 w-5"/>
                                    </Button>
                                </TooltipTrigger>
                                <TooltipContent side="right" align="start"
                                                class="flex flex-col gap-1 p-1 bg-background text-primary shadow-lg dark:border dark:border-secondary">
                                    <span class="uppercase text-muted-foreground pl-2 pt-1 pb-2">{{ item.name }}</span>
                                    <template v-for="subsectionItem in item.subsectionItems">
                                        <Link :href="route(subsectionItem.route)">
                                            <Button variant="ghost"
                                                    class="w-full justify-start flex flex-row gap-2 pl-2 py-5">
                                                <Icon :icon="subsectionItem.icon" class="h-4 w-4"/>
                                                {{ subsectionItem.name }}
                                            </Button>
                                        </Link>
                                    </template>
                                </TooltipContent>
                            </Tooltip>
                        </TooltipProvider>
                    </DropdownMenu>
                </template>
            </template>
        </nav>

        <AccordionNavigationItems v-else :navigationSectionsWithItems/>

        <nav class="mt-auto flex flex-col items-center pb-4">
            <Button variant="ghost" @click="$emit('toggleSideBarWidth')" class="w-full">
                <Icon :icon="isSideBarNarrow ? 'icon-park-outline:expand-left' : 'icon-park-outline:expand-right'"
                      class="h-5 w-5"/>
            </Button>
        </nav>
    </aside>
</template>

<style scoped>

</style>
