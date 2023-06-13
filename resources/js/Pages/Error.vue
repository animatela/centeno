<script setup lang="ts">
import { computed } from 'vue'

interface Props {
    status: number;
}

const props = defineProps<Props>()

const titles = {
    503: 'Service Unavailable',
    500: 'Server Error',
    404: 'Page Not Found',
    403: 'Forbidden',
}

const descriptions = {
    503: 'Sorry, we are doing some maintenance. Please check back soon.',
    500: 'Whoops, something went wrong on our servers.',
    404: 'Sorry, the page you are looking for could not be found.',
    403: 'Sorry, you are forbidden from accessing this page.',
}

const title = computed(() => titles[props.status])
const description = computed(() => descriptions[props.status])
</script>

<template>
    <div class="bg-white text-white dark:bg-slate-950 grid min-h-screen place-content-center">
        <article class="p-8 text-center">
            <h1 class="text-7xl font-black text-slate-950 dark:text-white">{{ status }}</h1>
            <section class="mt-8 text-center">
                <p class="text-2xl font-medium text-slate-950 dark:text-white">{{ title }}</p>
                <p class="text-sm font-light text-slate-700 dark:text-white">{{ description }}</p>
            </section>
        </article>
    </div>
</template>
