<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import InputError from '@/Components/Laravel/InputError.vue';
import ApplicationMark from "@/Components/ApplicationLogo.vue";
import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/Components/ui/card/index.js";
import {Input} from "@/Components/ui/input/index.js";
import {Label} from "@/Components/ui/label/index.js";
import {Button} from "@/Components/ui/button/index.js";

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password"/>
    <div class="flex flex-col w-full bg-background gap-12 pt-12">
        <Link class="self-center" :href="route('landing')">
            <ApplicationMark class="h-12 w-12"/>
        </Link>

        <Card class="mx-auto max-w-sm">
            <CardHeader>
                <CardTitle class="text-2xl">
                    Reset Password
                </CardTitle>
                <CardDescription>
                    Forgot your password? No problem. Just let us know your email address and we will email you a
                    password reset link that will allow you to choose a new one.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form class="grid gap-4" @submit.prevent="submit">
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            v-model="form.email"
                            required
                            type="email"
                        />
                        <InputError :message="form.errors.email"/>
                    </div>

                    <Button :loading="form.processing" class="w-full" type="submit">
                        Email Password Reset Link
                    </Button>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
