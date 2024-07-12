<script setup>
import {ref} from 'vue';
import {Head, useForm} from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/Laravel/AuthenticationCard.vue';
import InputError from '@/Components/Laravel/InputError.vue';
import InputLabel from '@/Components/Laravel/InputLabel.vue';
import {Button} from "@/Components/ui/button/index.js";
import {Input} from "@/Components/ui/input/index.js";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const form = useForm({
    password: '',
});

const passwordInput = ref(null);

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();

            passwordInput.value.focus();
        },
    });
};
</script>

<template>
    <Head title="Secure Area"/>

    <AuthenticationCard>
        <template #logo>
            <ApplicationLogo/>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="Password"/>
                <Input
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.password"/>
            </div>

            <div class="flex justify-end mt-4">
                <Button class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Confirm
                </Button>
            </div>
        </form>
    </AuthenticationCard>
</template>
