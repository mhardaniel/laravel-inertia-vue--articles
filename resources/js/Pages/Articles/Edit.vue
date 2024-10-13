<script setup lang="ts">
import Editor from '@/Components/Editor.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { useTemplateRef } from 'vue';

const props = defineProps(['article', 'companies']);

const form = useForm({
    id: props.article.id,
    company: props.article.company,
    title: props.article.title,
    link: props.article.link,
    date: props.article.date,
    content: props.article.content,
    image: null,
});

const inputFile = useTemplateRef('input-file');

<!-- @vue-ignore -->
const submit = () => {
    form.transform((data) => ({
        ...data,
        ...(inputFile &&
            inputFile.value.files[0] && { image: inputFile.value.files[0] }),
        _method: 'put',
    })).post(route('articles.update', props.article.id), {
        forceFormData: true,
    });
};

const publish = () => {
    form.transform((data) => ({
        ...data,
        status: 'published',
    })).put(route('articles.update', props.article.id), {});
};
</script>

<template>
    <Head title="Article Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Article
            </h2>
        </template>

        <div class="p-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="space-y-12 p-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2
                                    class="text-base font-semibold leading-7 text-gray-900"
                                >
                                    Article
                                </h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Update the article details here
                                </p>

                                <div
                                    class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                                >
                                    <div class="sm:col-span-3">
                                        <label
                                            for="company"
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                            >Company</label
                                        >
                                        <div class="mt-2">
                                            <select
                                                id="company"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                v-model="form.company"
                                            >
                                                <option disabled value="">
                                                    Please select one
                                                </option>

                                                <option
                                                    v-for="company in companies"
                                                    :key="company.id"
                                                    :value="company.id"
                                                >
                                                    {{ company.name }}
                                                </option>
                                            </select>
                                            <InputError
                                                :message="form.errors.company"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label
                                            for="image"
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                            >Image</label
                                        >
                                        <div class="mt-2">
                                            <input
                                                ref="input-file"
                                                type="file"
                                                id="image"
                                                autocomplete="image"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            />
                                            <!-- @vue-ignore -->
                                            <InputError
                                                :message="
                                                    form.errors.image
                                                        ? form.errors.image
                                                        : ''
                                                "
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label
                                            for="title"
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                            >Title</label
                                        >
                                        <div class="mt-2">
                                            <input
                                                type="text"
                                                v-model="form.title"
                                                id="title"
                                                autocomplete="title"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            />

                                            <InputError
                                                :message="form.errors.title"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label
                                            for="link"
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                            >Link</label
                                        >
                                        <div class="mt-2">
                                            <input
                                                type="text"
                                                v-model="form.link"
                                                id="link"
                                                autocomplete="link"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            />

                                            <InputError
                                                :message="form.errors.link"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label
                                            for="date"
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                            >Date</label
                                        >
                                        <div class="mt-2">
                                            <VueDatePicker
                                                uid="date"
                                                v-model="form.date"
                                                :enable-time-picker="false"
                                                :teleport="true"
                                                :ui="{
                                                    input: 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
                                                }"
                                                :format="'yyyy-MM-dd'"
                                                model-type="yyyy-MM-dd"
                                            ></VueDatePicker>

                                            <InputError
                                                :message="form.errors.date"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                            >Content</label
                                        >
                                        <div class="mt-2">
                                            <Editor v-model="form.content" />

                                            <InputError
                                                :message="form.errors.content"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-6 flex items-center justify-end gap-x-6"
                            >
                                <Link
                                    :href="route('articles.index')"
                                    class="text-sm font-semibold leading-6 text-gray-900"
                                >
                                    Cancel
                                </Link>
                                <PrimaryButton
                                    type="submit"
                                    class="bg-indigo-800 hover:bg-blue-500"
                                    >Save</PrimaryButton
                                >
                                <SecondaryButton
                                    @click="publish"
                                    class="bg-indigo-800 hover:bg-blue-500"
                                    >Publish</SecondaryButton
                                >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
