<script setup lang="ts">
import { nextTick, ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import SearchButton from '@/Pages/Welcome/Partials/SearchButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const showingSearchForm = ref(false)
const keywordInput = ref<HTMLInputElement | null>(null)

const form = useForm({
    keyword: '',
})

const showSearchForm = () => {
    showingSearchForm.value = true;

    nextTick(() => keywordInput.value?.focus());
}

const search = () => {

}

const closeModal = () => {
    showingSearchForm.value = false;

    form.reset();
};
</script>

<template>
    <section class="mt-6 sm:mt-10 flex justify-center space-x-6 text-sm">
        <SearchButton @click="showSearchForm" />

        <Modal :show="showingSearchForm" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete your account?
                </h2>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput
                        id="keyword"
                        ref="keywordInput"
                        v-model="form.keyword"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Password"
                        @keyup.enter="search"
                    />

                    <InputError :message="form.errors.keyword" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="search"
                    >
                        Search
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
