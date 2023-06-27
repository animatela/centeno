<script setup lang="ts">
import { onMounted, ref } from 'vue'

interface Props {
    modelValue: string | number
    options: Array<HtmlForm.Option>
}

defineProps<Props>();

const emit = defineEmits(['update:modelValue'])

const input = ref<HTMLInputElement | null>(null)

const updateModelValue = (event: Event) => emit('update:modelValue', (event.target as HTMLInputElement).value)

onMounted(() => {
    if (input.value?.hasAttribute('autofocus')) {
        input.value?.focus()
    }
});

defineExpose({ focus: () => input.value?.focus() })
</script>

<template>
    <select
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
        :value="modelValue"
        @input="updateModelValue"
        ref="input"
    >
        <option v-for="option in options" :value="option.value">
            {{ option.name }}
        </option>
    </select>
</template>
