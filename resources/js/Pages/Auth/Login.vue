<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import {Checkbox} from '@/Components/ui/checkbox';
import InputError from '@/Components/Laravel/InputError.vue';
import Socialstream from '@/Components/Laravel/Socialstream.vue';
import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/Components/ui/card/index.js";
import {Label} from "@/Components/ui/label"
import {Input} from "@/Components/ui/input"
import {Button} from "@/Components/ui/button";
import ApplicationMark from "@/Components/ApplicationLogo.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in"/>
    <div class="flex flex-col w-full bg-background gap-12 pt-12">
        <Link class="self-center" :href="route('landing')">
            <ApplicationMark class="h-12 w-12"/>
        </Link>
        <Card class="mx-auto max-w-sm">
            <CardHeader>
                <CardTitle class="text-2xl">
                    Login to Lunex
                </CardTitle>
                <CardDescription>
                    Enter your email below to login to your account
                </CardDescription>
            </CardHeader>
            <CardContent>
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
                    <div class="grid gap-2">
                        <div class="flex items-center flex-row flex-wrap gap-2">
                            <Label for="password">Password</Label>
                            <Link v-if="canResetPassword"
                                  :href="route('password.request')" class="ml-auto inline-block text-sm underline">
                                Forgot password?
                            </Link>
                        </div>
                        <Input id="password" v-model="form.password" required type="password"/>
                        <InputError :message="form.errors.password"/>

                        <div class="flex flex-row gap-2 items-center">
                            <Checkbox id="remember"/>
                            <Label for="remember">Remember me</Label>
                        </div>
                    </div>
                    <Button :loading="form.processing" class="w-full" type="submit">
                        Login
                    </Button>
                    <Socialstream v-if="$page.props.socialstream.show && $page.props.socialstream.providers.length"
                                  :error="$page.props?.errors?.socialstream || null"
                                  :labels="$page.props.socialstream.labels"
                                  :prompt="$page.props.socialstream.prompt"
                                  :providers="$page.props.socialstream.providers"/>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
