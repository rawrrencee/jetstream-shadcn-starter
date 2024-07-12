<script setup>

import {Icon} from "@iconify/vue";
import {Accordion, AccordionContent, AccordionItem, AccordionTrigger} from "@/Components/ui/accordion/index.js";
import {Button} from "@/Components/ui/button/index.js";
import {Link} from "@inertiajs/vue3";

defineProps({
    navigationSectionsWithItems: Array
})
</script>

<template>
    <nav class="grid gap-6 text-lg font-medium pt-4">
        <template v-for="section in navigationSectionsWithItems">
            <span class="text-primary">{{ section.sectionName }}</span>
            <Accordion :defaultValue="section.items.map(item => item.name)" type="multiple">
                <AccordionItem v-for="(item, index) in section.items" :key="index"
                               :value="item.name" class="border-0">
                    <AccordionTrigger class="p-0 hover:no-underline">
                        <Button class="px-0 w-full flex flex-row gap-2 justify-start"
                                variant="link">
                            <Icon :icon="item.icon" class="h-5 w-5"/>
                            {{ item.name }}
                        </Button>
                    </AccordionTrigger>
                    <AccordionContent class="hover:no-underline">
                        <template v-for="subsectionItem in item.subsectionItems">
                            <Link :href="route(subsectionItem.route)" class="flex py-1">
                                <Button
                                    class="px-0 w-full flex flex-row gap-2 justify-start pl-4"
                                    variant="link">
                                    <Icon :icon="subsectionItem.icon"
                                          class="h-5 w-5 text-muted-foreground"/>
                                    {{ subsectionItem.name }}
                                </Button>
                            </Link>
                        </template>
                    </AccordionContent>
                </AccordionItem>
            </Accordion>
        </template>
    </nav>
</template>
