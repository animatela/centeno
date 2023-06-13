<script setup lang="ts">
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

interface Props {
    latest: boolean;
}

const props = withDefaults(defineProps<Props>(), { latest: false })

const textStyles = computed(() =>
    props.latest
        ? 'text-slate-950 dark:text-white'
        : 'text-gray-500 dark:text-gray-300'
)

const classNames = computed(() => [
    'inline-flex items-center px-3 py-2 text-sm font-normal text-center bg-white rounded-lg',
    'hover:bg-slate-100 hover:text-slate-950 focus:ring-4 focus:outline-none focus:ring-gray-100',
    'dark:bg-slate-800 dark:hover:bg-slate-900 dark:hover:text-amber-600 dark:focus:ring-gray-700',
    textStyles.value,
])
</script>

<template>
    <Link :class="classNames">
        <slot />
    </Link>
</template>
