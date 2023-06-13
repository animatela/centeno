<script setup lang="ts">
import { computed } from 'vue'
import { Head, Link } from '@inertiajs/vue3'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

interface Props {
    hasCustomer: boolean;
}

const props = defineProps<Props>()

const customerRoute = computed(() =>
    props.hasCustomer
        ? route('customer.edit')
        : route('customer.create')
)
</script>

<template>
    <Head title="Dashboard">
        <title>Dashboard</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 place-content-center sm:place-content-stretch sm:h-48">
                    <Link
                        :href="customerRoute"
                        class="flex flex-col max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                    >
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Mi Información
                        </h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">
                            Valoramos tu privacidad y te ofrecemos la opción de gestionar tu información personal de manera segura y confidencial.
                        </p>
                    </Link>

                    <Link
                        v-if="hasCustomer"
                        href="#"
                        class="flex flex-col max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                    >
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Mis Vehículos
                        </h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Registra tu vehículo con nosotros y experimenta un servicio automotriz de calidad y personalizado.</p>
                    </Link>

                    <Link
                        v-if="hasCustomer"
                        href="#"
                        class="flex flex-col max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                    >
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Mis Reservas
                        </h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Desde mantenimiento básico hasta reparaciones complejas, nos aseguraremos de que tu automóvil esté en las mejores manos.</p>
                    </Link>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
