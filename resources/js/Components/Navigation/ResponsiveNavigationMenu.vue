<script setup lang="ts">
import { usePage } from '@inertiajs/vue3'
import { User } from '@/types'

import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'

interface Props {
    showing: boolean;
}

defineProps<Props>()

const user: User = usePage().props.auth.user
</script>

<template>
    <div :class="{ block: showing, hidden: !showing }" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Dashboard
            </ResponsiveNavLink>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                    {{ user.name }}
                </div>
                <div class="font-medium text-sm text-gray-500">{{ user.email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <ResponsiveNavLink :href="route('profile.edit')"> Profile</ResponsiveNavLink>
                <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                    Log Out
                </ResponsiveNavLink>
            </div>
        </div>
    </div>
</template>
