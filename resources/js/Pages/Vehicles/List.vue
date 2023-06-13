<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { BookmarkIcon, HomeIcon } from '@heroicons/vue/20/solid'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BreadcrumbButton from '@/Components/BreadcrumbButton.vue'

interface Props {
    vehicles: Array<Workshop.Vehicle>;
}

const props = defineProps<Props>()

console.log(props.vehicles)
</script>

<template>
    <Head title="Dashboard">
        <title>Dashboard</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <!-- Breadcrumb -->
            <nav class="flex justify-between" aria-label="Breadcrumb">
                <div class="inline-flex items-center">
                    <div>
                        <div class="flex items-center">
                            <BreadcrumbButton
                                :href="route('dashboard')"
                            >
                                <HomeIcon class="mr-1.5 w-3 h-3" aria-hidden="true" />
                                <span>Dashboard</span>
                            </BreadcrumbButton>
                        </div>
                    </div>
                    <div class="mx-1 text-gray-400">/</div>
                    <div aria-current="page">
                        <div class="flex items-center">
                            <BreadcrumbButton
                                :href="route('vehicles')"
                                latest>
                                <BookmarkIcon class="mr-1.5 w-3 h-3" aria-hidden="true" />
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
                                Customer Vehicles
                            </h5>
                            <p class="text-gray-500 dark:text-gray-400">
                                Manage all your existing vehicles or add a new one
                            </p>
                        </div>
                        <button
                            type="button"
                            class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                        >
                            Add vehicle
                        </button>
                    </div>
                </section>

                <section class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 place-content-center sm:place-content-stretch sm:h-48">

                    <Link
                        v-for="vehicle in vehicles"
                        href="#"
                        class="flex flex-col max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                    >
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ vehicle.name }}
                        </h5>
                        <div class="font-normal text-gray-700 dark:text-gray-400">
                            <p>Tipo: {{ vehicle.body_type }}</p>
                            <p>Modelo: {{ vehicle.model }}</p>
                            <p>Color: {{ vehicle.color }}</p>
                            <p>KM: {{ vehicle.mileage }}</p>
                        </div>
                    </Link>

                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
