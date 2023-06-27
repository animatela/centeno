<script setup lang="ts">
import { Head } from '@inertiajs/vue3'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import CreateNewReservationForm from './Partials/CreateNewReservationForm.vue'
import BreadcrumbButton from '@/Components/BreadcrumbButton.vue'

interface Props {
    customer: Workshop.Customer
    currencies: Array<HtmlForm.Option>
    vehicles: Array<HtmlForm.Option>
    services: Array<HtmlForm.Option>
}

const props = defineProps<Props>()
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
                            <BreadcrumbButton :href="route('reservations')" current>
                                <span>Mis Reservas</span>
                            </BreadcrumbButton>
                        </div>
                    </div>
                    <div class="mx-1 text-gray-400">/</div>
                    <div aria-current="page">
                        <div class="flex items-center">
                            <BreadcrumbButton :href="route('reservations.create')" current>
                                <span>Nueva Reserva</span>
                            </BreadcrumbButton>
                        </div>
                    </div>
                </div>
            </nav>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <CreateNewReservationForm
                        :customer-id="customer.id"
                        :currencies="currencies"
                        :services="services"
                        :vehicles="vehicles"
                        class="max-w-xl"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
