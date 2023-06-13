<script setup lang="ts">
import { computed } from 'vue'
import { Head } from '@inertiajs/vue3'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import BreadcrumbButton from '@/Components/BreadcrumbButton.vue'
import UpdateVehicleForm from './Partials/UpdateVehicleForm.vue'
import DeleteVehicleForm from './Partials/DeleteVehicleForm.vue'

interface Props {
    vehicle?: Workshop.Vehicle
    fuelTypes: Array<HtmlForm.Option>
    transmissionTypes: Array<HtmlForm.Option>
}

const props = defineProps<Props>()

const vehicleId = computed(() => props.vehicle?.id.toString())
</script>

<template>
    <Head title="Editar Vehículo">
        <title>Editar Vehículo</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <!-- Breadcrumb -->
            <nav class="flex justify-between" aria-label="Breadcrumb">
                <div class="inline-flex items-center">
                    <div>
                        <div class="flex items-center">
                            <BreadcrumbButton :href="route('dashboard')">
                                <span>Dashboard</span>
                            </BreadcrumbButton>
                        </div>
                    </div>
                    <div class="mx-1 text-gray-400">/</div>
                    <div aria-current="page">
                        <div class="flex items-center">
                            <BreadcrumbButton :href="route('vehicles')" current>
                                <span>Mis Vehículos</span>
                            </BreadcrumbButton>
                        </div>
                    </div>
                    <div class="mx-1 text-gray-400">/</div>
                    <div aria-current="page">
                        <div class="flex items-center">
                            <BreadcrumbButton :href="route('vehicles.edit', { id: vehicleId })" current>
                                <span>{{ vehicle.name }}</span>
                            </BreadcrumbButton>
                        </div>
                    </div>
                </div>
            </nav>
        </template>

        <div v-if="vehicle" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <UpdateVehicleForm
                        :vehicle="vehicle"
                        :fuel-types="fuelTypes"
                        :transmission-types="transmissionTypes"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <DeleteVehicleForm :vehicle-id="vehicle.id" class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
