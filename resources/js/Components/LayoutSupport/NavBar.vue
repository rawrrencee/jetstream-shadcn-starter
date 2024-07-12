<script setup>
import DarkModeToggle from "@/Components/LayoutSupport/DarkModeToggle.vue";
import {Icon} from "@iconify/vue";
import {Button} from "@/Components/ui/button"
import {Sheet, SheetContent, SheetDescription, SheetTitle, SheetTrigger} from "@/Components/ui/sheet/index.js";
import ApplicationMark from "@/Components/ApplicationLogo.vue";
import {DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger} from "@/Components/ui/dropdown-menu";
import {Link, router} from "@inertiajs/vue3";
import AccordionNavigationItems from "@/Components/LayoutSupport/AccordionNavigationItems.vue";

defineProps({
    navigationSectionsWithItems: Array
})

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div
        class="top-0 flex min-h-16 items-center gap-4 border-b bg-background z-10">
        <nav
            class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-6 flex flex-1 flex-row flex-wrap items-center justify-between gap-5 text-sm lg:gap-6">

            <Link :href="route('dashboard')" class="hidden sm:flex items-center gap-2 text-lg font-semibold">
                <span>Lunex</span>
            </Link>

            <Sheet>
                <SheetTrigger as-child>
                    <Button class="sm:hidden" variant="outline">
                        <Icon class="h-5 w-5" icon="tabler:layout-sidebar-left-expand"/>
                        <span class="sr-only">Toggle Sidebar</span>
                    </Button>
                </SheetTrigger>
                <SheetContent class="sm:max-w-xs overflow-y-scroll scrollbar-none [&::-webkit-scrollbar]:hidden"
                              side="left">
                    <SheetTitle>
                        <Link
                            :href="route('dashboard')"
                            class="group flex h-10 w-10 shrink-0 items-center justify-center gap-2 text-lg font-semibold text-primary-foreground md:text-base"
                        >
                            <ApplicationMark class="h-10 w-10"/>
                            <span class="sr-only">Lunex</span>
                        </Link>
                    </SheetTitle>
                    <SheetDescription>
                        <AccordionNavigationItems :navigationSectionsWithItems/>
                    </SheetDescription>
                </SheetContent>
            </Sheet>

            <div class="flex flex-shrink flex-row gap-1 items-center">
                <DarkModeToggle variant="outline"/>
                <DropdownMenu>
                    <DropdownMenuTrigger as-child>
                        <Button variant="outline">
                            <img v-if="$page.props.jetstream.managesProfilePhotos" :alt="$page.props.auth.user.name"
                                 :src="$page.props.auth.user.profile_photo_url"
                                 class="h-6 w-6 rounded-full object-cover"/>
                            <Icon v-else class="h-5 w-5" icon="solar:smile-square-outline"/>
                        </Button>
                        <span class="sr-only">Manage account</span>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuItem class="p-0">
                            <Link :href="route('profile.show')" class="w-full">
                                <Button class="w-full" size="lg" variant="ghost">
                                    Profile
                                </Button>
                            </Link>
                        </DropdownMenuItem>
                        <DropdownMenuItem class="p-0">
                            <Button class="w-full" size="lg" variant="ghost" @click="logout">
                                Logout
                            </Button>
                        </DropdownMenuItem>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>
        </nav>
    </div>
</template>
