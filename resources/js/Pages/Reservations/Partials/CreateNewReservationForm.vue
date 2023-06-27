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
    customerId: number
    currencies: Array<HtmlForm.Option>
    services: Array<HtmlForm.Option>
    vehicles: Array<HtmlForm.Option>
}

const props = defineProps<Props>();

const user: User = usePage().props.auth.user;

const { showSuccessMessage } = useNotification()

const form = useForm({
    customer_id: props.customerId,
    vehicle_id: 0,
    service_id: 0,
    number: '',
    date_time: '',
    notes: '',
});

const createReservation = () => {
    form.post(route('reservations.store'), {
        preserveScroll: true,
        onSuccess: () => showSuccessMessage(
            'Reservation registered',
            'Your reservation was registered successfully!'
        )
    })
}
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Nueva Reserva
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                En nuestro taller automotriz, valoramos tu privacidad y te ofrecemos la opción de gestionar tu
                información personal de manera segura y confidencial.
            </p>
        </header>

        <form @submit.prevent="createReservation" class="mt-6 space-y-6">
            <div>
                <InputLabel for="vehicle_id" value="Vehículo" />

                <SelectInput
                    id="vehicle_id"
                    class="mt-1 block w-full"
                    v-model="form.vehicle_id"
                    :options="vehicles"
                    required
                />

                <InputError class="mt-2" :message="form.errors.vehicle_id" />
            </div>

            <div>
                <InputLabel for="service_id" value="Servicio" />

                <SelectInput
                    id="service_id"
                    class="mt-1 block w-full"
                    v-model="form.service_id"
                    :options="services"
                    required
                />

                <InputError class="mt-2" :message="form.errors.service_id" />
            </div>

            <div>
                <InputLabel for="number" value="Número de Reserva" />

                <TextInput
                    id="number"
                    type="text"
                    class="mt-1 block w-full read-only:bg-gray-100 dark:read-only:bg-gray-800"
                    placeholder="Ej: RE123456. Se genera automáticamente."
                    v-model="form.number"
                    readonly
                />

                <InputError class="mt-2" :message="form.errors.number" />
            </div>

            <div>
                <InputLabel for="date_time" value="Fecha y Hora" />

                <TextInput
                    id="date_time"
                    type="datetime-local"
                    class="mt-1 block w-full"
                    v-model="form.date_time"
                />

                <InputError class="mt-2" :message="form.errors.date_time" />
            </div>

            <div>
                <InputLabel for="notes" value="Notas" />

                <TextInput
                    id="notes"
                    type="text"
                    class="mt-1 block w-full"
                    placeholder="Ej: Notas adicionales"
                    v-model="form.notes"
                />

                <InputError class="mt-2" :message="form.errors.notes" />
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
