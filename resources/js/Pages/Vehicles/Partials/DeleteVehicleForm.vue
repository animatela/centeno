<script setup lang="ts">
import { nextTick, ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { useNotification } from '@/Composables/useNotification'

import DangerButton from '@/Components/DangerButton.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Modal from '@/Components/Modal.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

interface Props {
    vehicleId: number;
}

const props = defineProps<Props>()

const { showSuccessMessage } = useNotification()

const confirmingVehicleDeletion = ref(false);
const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    vehicleId: props.vehicleId,
    password: '',
});

const confirmVehicleDeletion = () => {
    confirmingVehicleDeletion.value = true;

    nextTick(() => passwordInput.value?.focus());
};

const deleteVehicle = () => {
    form.delete(route('vehicles.destroy', { id: props.vehicleId }), {
        preserveScroll: true,
        onSuccess: () => {
            showSuccessMessage('Vehicle Deleted', 'Your Vehicle has been deleted.')
            closeModal()
        },
        onError: () => passwordInput.value?.focus(),
        //
    });
};

const closeModal = () => {
    confirmingVehicleDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Eliminar Vehículo</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Una vez que se elimine su vehículo, todos sus recursos y datos se eliminarán de forma permanente. Antes
                de eliminar su vehículo, descargue cualquier dato o información que desee conservar.
            </p>
        </header>

        <DangerButton @click="confirmVehicleDeletion">Delete Account</DangerButton>

        <Modal :show="confirmingVehicleDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteVehicle"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancelar </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteVehicle"
                    >
                        Eliminar Vehículo
                    </DangerButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
