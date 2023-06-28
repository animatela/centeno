<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3'
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BreadcrumbButton from '@/Components/BreadcrumbButton.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TableFilterDropdown from '@/Components/Tables/ListDropdownFilter.vue'
import Table from '@/Components/Tables/Table.vue'
import TableHead from '@/Components/Tables/TableHead.vue'
import TableHeadRow from '@/Components/Tables/TableHeadRow.vue'
import TableHeadColumn from '@/Components/Tables/TableHeadColumn.vue'
import TableBody from '@/Components/Tables/TableBody.vue'
import TableBodyHeader from '@/Components/Tables/TableBodyHeader.vue'
import TableBodyColumn from '@/Components/Tables/TableBodyColumn.vue'
import TableBodyRow from '@/Components/Tables/TableBodyRow.vue'
import ListActionsButton from '@/Components/Tables/ListDropdownActions.vue'

interface Props {
    currencies: Array<HtmlForm.Option>
    services: Array<Workshop.Service>
    reservations: {
        data: Array<Workshop.Reservation>
        path: string
        per_page: number
        next_cursor: string | null
        next_page_url: string | null
        prev_cursor: string | null
        prev_page_url: string | null
    }
    vehicles: Array<Workshop.Vehicle>
}

const props = defineProps<Props>()

const findElement = (items: Array<any>, needle: string | number) => {
    const element = items.find((item) => item.id === needle || item.name || needle)

    return element.name ?? needle.toString()
}

const currencyName = (name: string) => findElement(props.currencies, name)
const serviceName = (id: number) => props.services.find(service => service.id === id)?.name
const vehicleName = (id: number) => props.vehicles.find(vehicle => vehicle.id === id)?.name

const newReservation = () => router.visit(route('reservations.create'), {
    preserveScroll: true,
})

console.log(props.currencies)
</script>

<template>
    <Head title="Mis Reservas">
        <title>Mis Reservas</title>
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
                </div>
            </nav>
        </template>

        <div class="py-12">
            <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
                <!-- Start coding here -->
                <section class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <div
                        class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/2">
                            <form class="flex items-center">
                                <label for="simple-search" class="sr-only">Search</label>
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                             fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        id="simple-search"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Search"
                                        required
                                    >
                                </div>
                            </form>
                        </div>
                        <div
                            class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <PrimaryButton type="button" @click="newReservation">
                                Agregar
                            </PrimaryButton>

                            <div class="flex items-center space-x-3 w-full md:w-auto">
                                <ListActionsButton />
                                <TableFilterDropdown />
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <Table v-if="reservations">
                            <TableHead>
                                <TableHeadRow>
                                    <TableHeadColumn scope="col">Number</TableHeadColumn>
                                    <TableHeadColumn scope="col">Vehicle</TableHeadColumn>
                                    <TableHeadColumn scope="col">Service</TableHeadColumn>
                                    <TableHeadColumn scope="col">Date / Time</TableHeadColumn>
                                    <TableHeadColumn scope="col">Currency</TableHeadColumn>
                                    <TableHeadColumn scope="col">Price</TableHeadColumn>
                                    <TableHeadColumn scope="col">Status</TableHeadColumn>
                                    <TableHeadColumn scope="col">
                                        <span class="sr-only">Actions</span>
                                    </TableHeadColumn>
                                </TableHeadRow>
                            </TableHead>
                            <TableBody>
                                <TableBodyRow v-for="reservation in reservations.data">
                                    <TableBodyHeader scope="row">
                                        <Link :href="route('reservations.edit', reservation.id)">
                                            {{ reservation.number }}
                                        </Link>
                                    </TableBodyHeader>
                                    <TableBodyColumn>
                                        <a href="#" class="hover:underline">
                                            {{ vehicleName(reservation.vehicle_id) }}
                                        </a>
                                    </TableBodyColumn>
                                    <TableBodyColumn>
                                        {{ serviceName(reservation.service_id) }}
                                    </TableBodyColumn>
                                    <TableBodyColumn>
                                        {{ reservation.reservation_date }} / {{ reservation.reservation_time }}
                                    </TableBodyColumn>
                                    <TableBodyColumn>{{ currencyName(reservation.currency) }}</TableBodyColumn>
                                    <TableBodyColumn class="text-right">
                                        {{ reservation.price?.toFixed(2) }}
                                    </TableBodyColumn>
                                    <TableBodyColumn>
                                        {{ reservation.status }}
                                    </TableBodyColumn>
                                    <TableBodyColumn class="flex items-center justify-end">
                                        <button id="apple-imac-27-dropdown-button"
                                                data-dropdown-toggle="apple-imac-27-dropdown"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                                type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                 viewbox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="apple-imac-27-dropdown"
                                             class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                aria-labelledby="apple-imac-27-dropdown-button">
                                                <li>
                                                    <a href="#"
                                                       class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Show</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                       class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                </li>
                                            </ul>
                                            <div class="py-1">
                                                <a href="#"
                                                   class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                            </div>
                                        </div>
                                    </TableBodyColumn>
                                </TableBodyRow>
                            </TableBody>
                        </Table>
                    </div>

                    <nav
                        class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                        aria-label="Table navigation">
                        <span class="flex gap-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                            <span>Showing</span>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ reservations.per_page }}</span>
                        </span>
                        <ul class="inline-flex items-stretch -space-x-px">
                            <li>
                                <Link
                                    v-if="reservations.prev_page_url"
                                    :href="reservations.prev_page_url"
                                    class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >
                                    <span class="sr-only">Previous</span>
                                    <ChevronLeftIcon class="w-5 h-5" />
                                </Link>
                                <span v-else class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 opacity-50">
                                    <span class="sr-only">Previous</span>
                                    <ChevronLeftIcon class="w-5 h-5" />
                                </span>
                            </li>
                            <li>
                                <Link
                                    v-if="reservations.next_page_url"
                                    :href="reservations.next_page_url"
                                    class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                >
                                    <span class="sr-only">Next</span>
                                    <ChevronRightIcon class="w-5 h-5" />
                                </Link>
                                <span v-else class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 opacity-50">
                                    <span class="sr-only">Next</span>
                                    <ChevronRightIcon class="w-5 h-5" />
                                </span>
                            </li>
                        </ul>
                    </nav>
                </section>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
