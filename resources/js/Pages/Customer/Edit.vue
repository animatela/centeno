<script setup lang="ts">
import { Head } from '@inertiajs/vue3'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import UpdateCustomerForm from './Partials/UpdateCustomerForm.vue'

interface Props {
    customer?: Workshop.Customer
    genders: Array<HtmlForm.Option>
    document_types: Array<HtmlForm.Option>
}

const props = defineProps<Props>()
</script>

<template>
    <Head title="Customer">
        <title>Actualizar Información de Cliente</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Información de Cliente
            </h2>
        </template>

        <div v-if="customer" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <UpdateCustomerForm
                        :customer="customer"
                        :document_types="document_types"
                        :genders="genders"
                        class="max-w-xl"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
