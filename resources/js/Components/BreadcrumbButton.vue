<script setup lang="ts">
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

interface Props {
    current?: boolean;
}

const props = withDefaults(defineProps<Props>(), { current: false })

const textStyles = computed(() =>
    props.current
        ? 'text-slate-950 dark:text-white'
        : 'text-slate-500 dark:text-slate-400'
)

const classNames = computed(() => [
    'inline-flex items-center px-3 py-1.5 text-sm font-normal text-center bg-white rounded-md',
    'hover:bg-slate-100 hover:text-slate-950 focus:ring-4 focus:outline-none focus:ring-gray-100',
    'dark:bg-slate-800 dark:hover:bg-slate-900 dark:hover:text-amber-600 dark:focus:ring-gray-700',
    textStyles.value,
])
</script>

<template>
    <Link href="#" :class="classNames">
        <slot />
    </Link>
</template>
