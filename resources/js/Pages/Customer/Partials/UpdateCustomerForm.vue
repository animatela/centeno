<script setup lang="ts">
import { computed } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'

import { User } from '@/types'
import { useNotification } from '@/Composables/useNotification'

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';

interface Props {
    customer: Workshop.Customer;
    genders: Array<HtmlForm.Option>;
    document_types: Array<HtmlForm.Option>;
}

const props = defineProps<Props>();

const user: User = usePage().props.auth.user;

const { showSuccessMessage } = useNotification()

const form = useForm({
    name: props.customer.name || '',
    email: props.customer.email || '',
    phone: props.customer.phone || '',
    gender: props.customer.gender || '',
    document_type: props.customer.document_type || '',
    document_number: props.customer.document_number || '',
});

const customerId = computed(() => props.customer.id)

const updateCustomer = () => {
    form.patch(route('customer.update', { id: customerId.value }), {
        preserveScroll: true,
        onSuccess: () => showSuccessMessage('Success', 'Your information was updated!')
    })
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Information</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                En nuestro taller automotriz, valoramos tu privacidad y te ofrecemos la opción de gestionar tu
                información personal de manera segura y confidencial.
            </p>
        </header>

        <form @submit.prevent="updateCustomer" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="phone" value="Phone" />

                <TextInput
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    autocomplete="phone"
                />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div>
                <InputLabel for="gender" value="Gender" />

                <SelectInput
                    id="gender"
                    class="mt-1 block w-full"
                    v-model="form.gender"
                    :options="genders"
                    required
                />

                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <div>
                <InputLabel for="document_type" value="Document Type" />

                <SelectInput
                    id="document_type"
                    class="mt-1 block w-full"
                    v-model="form.document_type"
                    :options="document_types"
                    required
                />

                <InputError class="mt-2" :message="form.errors.document_type" />
            </div>

            <div>
                <InputLabel for="document_number" value="Document Number" />

                <TextInput
                    id="document_number"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.document_number"
                />

                <InputError class="mt-2" :message="form.errors.document_number" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
