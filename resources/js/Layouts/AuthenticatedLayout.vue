<script setup lang="ts">
import { ref } from 'vue';
import OnNotification from '@/Components/Notifications/OnNotification.vue'
import PrimaryNavigationMenu from '@/Components/Navigation/PrimaryNavigationMenu.vue'
import ResponsiveNavigationMenu from '@/Components/Navigation/ResponsiveNavigationMenu.vue'
import { usePage } from '@inertiajs/vue3'

const flashMessages: string = usePage().props.flash.message

const showingNavigationDropdown = ref(false)

const toggleNavigationDropdown = () => showingNavigationDropdown.value = !showingNavigationDropdown.value
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <PrimaryNavigationMenu
                    :showing="showingNavigationDropdown"
                    @showingNavigation="toggleNavigationDropdown"
                />

                <!-- Responsive Navigation Menu -->
                <ResponsiveNavigationMenu
                    :showing="showingNavigationDropdown"
                />
            </nav>

            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Flash Messages -->
            <section>
                <div v-if="flashMessages" class="alert">
                    {{ flashMessages }}
                </div>
            </section>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>

        <!-- Notifications -->
        <OnNotification />
    </div>
</template>
