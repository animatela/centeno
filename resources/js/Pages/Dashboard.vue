<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
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

                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 place-items-center">
                    <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Información</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Valoramos tu privacidad y te ofrecemos la opción de gestionar tu información personal de manera segura y confidencial.</p>
                    </a>

                    <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Reservas</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Desde mantenimiento básico hasta reparaciones complejas, nos aseguraremos de que tu automóvil esté en las mejores manos.</p>
                    </a>


                    <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Servicios</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Nuestros servicios de mantenimiento automotriz incluyen tanto el mantenimiento preventivo como el correctivo.</p>
                    </a>

                    <a href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Vehículos</h5>
                        <p class="font-normal text-gray-700 dark:text-gray-400">Registra tu vehículo con nosotros y experimenta un servicio automotriz de calidad y personalizado.</p>
                    </a>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
