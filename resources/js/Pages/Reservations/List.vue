<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3'
import { BookmarkIcon, HomeIcon } from '@heroicons/vue/20/solid'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BreadcrumbButton from '@/Components/BreadcrumbButton.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

interface Props {
    reservations: Array<Workshop.Vehicle>;
}

const props = defineProps<Props>()

const newReservation = () => router.visit(route('reservations.create'), {
    preserveScroll: true,
})
</script>

<template>
    <Head title="Mis Vehículos">
        <title>Mis Vehículos</title>
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
                                <span>Mis Vehículos</span>
                            </BreadcrumbButton>
                        </div>
                    </div>
                </div>
            </nav>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Start coding here -->
                <section class="relative mb-4 overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
                        <div>
                            <h5 class="mr-3 font-semibold dark:text-white">
                                Mis Vehículos
                            </h5>
                            <p class="text-gray-500 dark:text-gray-400">
                                Administre todos sus vehículos existentes o agregue uno nuevo
                            </p>
                        </div>
                        <PrimaryButton type="button" @click="newReservation">
                            Agregar
                        </PrimaryButton>
                    </div>
                </section>

                <section class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 place-content-center sm:place-content-stretch sm:h-48">

                    <Link
                        v-for="reservation in reservations"
                        :href="route('reservations.edit', reservation.id)"
                        class="flex flex-col max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                    >
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ reservation.name }}
                        </h5>
                        <div class="font-normal text-gray-700 dark:text-gray-400">
                            <p>Tipo: {{ reservation.body_type }}</p>
                            <p>Modelo: {{ reservation.model }}</p>
                            <p>Color: {{ reservation.color }}</p>
                            <p>KM: {{ reservation.mileage }}</p>
                        </div>
                    </Link>

                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
