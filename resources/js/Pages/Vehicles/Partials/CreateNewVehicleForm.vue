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
    customerId: number,
    fuelTypes: Array<HtmlForm.Option>;
    transmissionTypes: Array<HtmlForm.Option>;
}

const props = defineProps<Props>();

const user: User = usePage().props.auth.user;

const { showSuccessMessage } = useNotification()

const form = useForm({
    customer_id: props.customerId,
    name: '',
    body_type: '',
    maker: '',
    model: '',
    color: '',
    year: '',
    fuel_type: '',
    transmission_type: '',
    plate: '',
    mileage: 0,
});

const createVehicle = () => {
    form.post(route('vehicles.store'), {
        preserveScroll: true,
        onSuccess: () => showSuccessMessage(
            'Vehicle registered',
            'Your vehicle was registered successfully!'
        )
    })
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ form.name }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                En nuestro taller automotriz, valoramos tu privacidad y te ofrecemos la opción de gestionar tu
                información personal de manera segura y confidencial.
            </p>
        </header>

        <form @submit.prevent="createVehicle" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="body_type" value="Tipo de Carrocería" />

                <TextInput
                    id="body_type"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.body_type"
                    required
                />

                <InputError class="mt-2" :message="form.errors.body_type" />
            </div>

            <div>
                <InputLabel for="maker" value="Marca / Fabricante" />

                <TextInput
                    id="maker"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.maker"
                />

                <InputError class="mt-2" :message="form.errors.maker" />
            </div>

            <div>
                <InputLabel for="model" value="Modelo" />

                <TextInput
                    id="model"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.model"
                />

                <InputError class="mt-2" :message="form.errors.model" />
            </div>

            <div>
                <InputLabel for="year" value="Año de Fabricación" />

                <TextInput
                    id="year"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.year"
                />

                <InputError class="mt-2" :message="form.errors.year" />
            </div>

            <div>
                <InputLabel for="year" value="Color" />

                <TextInput
                    id="color"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.color"
                />

                <InputError class="mt-2" :message="form.errors.color" />
            </div>

            <div>
                <InputLabel for="fuel_type" value="Tipo de Combustible" />

                <SelectInput
                    id="fuel_type"
                    class="mt-1 block w-full"
                    v-model="form.fuel_type"
                    :options="fuelTypes"
                    required
                />

                <InputError class="mt-2" :message="form.errors.fuel_type" />
            </div>

            <div>
                <InputLabel for="transmission_type" value="Tipo de Transmisión" />

                <SelectInput
                    id="document_type"
                    class="mt-1 block w-full"
                    v-model="form.transmission_type"
                    :options="transmissionTypes"
                    required
                />

                <InputError class="mt-2" :message="form.errors.transmission_type" />
            </div>

            <div>
                <InputLabel for="plate" value="Número de Placa" />

                <TextInput
                    id="plate"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.plate"
                />

                <InputError class="mt-2" :message="form.errors.plate" />
            </div>

            <div>
                <InputLabel for="mileage" value="Kilometraje" />

                <TextInput
                    id="mileage"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.mileage"
                />

                <InputError class="mt-2" :message="form.errors.mileage" />
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
