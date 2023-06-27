<script setup lang="ts">
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon, ArrowTopRightOnSquareIcon, TrashIcon } from '@heroicons/vue/20/solid'
</script>

<template>
    <Menu as="div" class="relative inline-block text-left">
        <div>
            <MenuButton
                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
            >
                <ChevronDownIcon class="w-5 h-5 mr-1.5 -ml-1" aria-hidden="true" />
                <span>Actions</span>
            </MenuButton>
        </div>
        <transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0"
        >

            <MenuItems
                class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-lg bg-white dark:bg-gray-700 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            >
                <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                        <button
                            :class="[
                                active ? 'bg-gray-800 text-white' : 'text-gray-900 dark:text-gray-200',
                                'group flex w-full items-center rounded-lg px-2 py-2 text-sm',
                            ]"
                        >
                            <ArrowTopRightOnSquareIcon
                                :active="active"
                                class="mr-2 h-5 w-5 text-yellow-400"
                                aria-hidden="true"
                            />
                            <span>Exportar</span>
                        </button>
                    </MenuItem>
                    <MenuItem v-slot="{ active }" disabled>
                        <button
                            :class="[
                                active ? 'bg-gray-800 text-white' : 'text-gray-900 dark:text-gray-200',
                                'group flex w-full items-center rounded-lg px-2 py-2 text-sm disabled:opacity-50',
                            ]"
                        >
                            <TrashIcon
                                :active="active"
                                class="mr-2 h-5 w-5 text-gray-400 opacity-25"
                                aria-hidden="true"
                            />
                            <span class="opacity-50">Delete</span>
                        </button>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>
