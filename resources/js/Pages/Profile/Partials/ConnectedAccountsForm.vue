<script setup>
import {ref} from 'vue';
import {useForm, usePage} from '@inertiajs/vue3';
import ActionSection from '@/Components/Laravel/ActionSection.vue';
import ConnectedAccount from '@/Components/Laravel/ConnectedAccount.vue';
import DialogModal from '@/Components/Laravel/DialogModal.vue';
import InputError from '@/Components/Laravel/InputError.vue';
import {Button} from "@/Components/ui/button/index.js";
import {Input} from "@/Components/ui/input/index.js";

const accountId = ref(null);
const confirmingRemoveAccount = ref(false);
const passwordInput = ref(null);

const page = usePage();

const form = useForm({
    password: '',
});

const getAccountForProvider = (provider) => page.props.socialstream.connectedAccounts
    .filter(account => account.provider === provider.id)
    .shift();


const setProfilePhoto = (id) => {
    form.put(route('user-profile-photo.set', {id}), {
        preserveScroll: true
    });
};

const confirmRemoveAccount = (id) => {
    accountId.value = id;
    confirmingRemoveAccount.value = true;
};

const removeAccount = () => {
    form.delete(route('connected-accounts.destroy', {id: accountId.value}), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingRemoveAccount.value = false;

    form.reset();
};

</script>

<template>
    <ActionSection>
        <template #title>
            Connected Accounts
        </template>

        <template #description>
            Connect your social media accounts to enable Sign In with OAuth.
        </template>

        <template #content>
            <div class="p-4 bg-red-500/10 text-red-500 border-l-4 border-red-600 rounded font-medium text-sm">
                If you feel any of your connected accounts have been compromised, you should disconnect them
                immediately and change your password.
            </div>

            <div class="space-y-6 mt-6">
                <div v-for="(provider) in $page.props.socialstream.providers" :key="provider">
                    <ConnectedAccount :created-at="getAccountForProvider(provider)?.created_at"
                                      :provider="provider">
                        <template #action>
                            <template v-if="getAccountForProvider(provider)">
                                <div class="flex items-center space-x-6">
                                    <button
                                        v-if="$page.props.jetstream.managesProfilePhotos && getAccountForProvider(provider).avatar_path"
                                        class="cursor-pointer ms-6 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 focus:outline-none"
                                        @click="setProfilePhoto(getAccountForProvider(provider).id)">
                                        Use Avatar as Profile Photo
                                    </button>

                                    <Button
                                        v-if="$page.props.socialstream.connectedAccounts.length > 1 || $page.props.socialstream.hasPassword"
                                        variant="destructive"
                                        @click="confirmRemoveAccount(getAccountForProvider(provider).id)">
                                        Remove
                                    </Button>
                                </div>
                            </template>

                            <template v-else>
                                <Button variant="link">
                                    <a :href="route('oauth.redirect', { provider })">
                                        Connect
                                    </a>
                                </Button>
                            </template>
                        </template>
                    </ConnectedAccount>
                </div>
            </div>

            <!-- Confirmation Modal -->
            <DialogModal :show="confirmingRemoveAccount" @close="closeModal">
                <template #title>
                    Are you sure you want to remove this account?
                </template>

                <template #content>
                    Please enter your password to confirm you would like to remove this account.

                    <div class="mt-4">
                        <Input
                            ref="passwordInput"
                            v-model="form.password"
                            autocomplete="current-password"
                            class="mt-1 block w-3/4"
                            placeholder="Password"
                            type="password"
                            @keyup.enter="removeAccount"
                        />

                        <InputError :message="form.errors.password" class="mt-2"/>
                    </div>
                </template>

                <template #footer>
                    <Button variant="ghost" @click="closeModal">
                        Cancel
                    </Button>

                    <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                            class="ml-2" @click="removeAccount">
                        Remove Account
                    </Button>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
