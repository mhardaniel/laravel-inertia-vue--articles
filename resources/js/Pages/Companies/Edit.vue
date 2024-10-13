<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps(['company']);

const form = useForm({
    id: props.company.id,
    logo: props.company.logo,
    name: props.company.name,
    status: props.company.status,
});

const submit = () => {
    form.put(route('companies.update', props.company.id), {});
};
</script>

<template>
    <Head title="Company Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Company
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
                                    Company
                                </h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">
                                    Update the company details here
                                </p>

                                <div
                                    class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                                >
                                    <div class="sm:col-span-3">
                                        <label
                                            for="logo"
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                            >Logo</label
                                        >
                                        <div class="mt-2">
                                            <input
                                                type="text"
                                                v-model="form.logo"
                                                id="logo"
                                                autocomplete="logo"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            />
                                            <InputError
                                                :message="form.errors.logo"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label
                                            for="name"
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                            >Name</label
                                        >
                                        <div class="mt-2">
                                            <input
                                                type="text"
                                                v-model="form.name"
                                                id="name"
                                                autocomplete="name"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                            />
                                            <InputError
                                                :message="form.errors.name"
                                                class="mt-2"
                                            />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label
                                            for="status"
                                            class="block text-sm font-medium leading-6 text-gray-900"
                                            >Status</label
                                        >
                                        <div class="mt-2">
                                            <select
                                                id="status"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                                v-model="form.status"
                                            >
                                                <option disabled value="">
                                                    Please select one
                                                </option>
                                                <option value="active">
                                                    Active
                                                </option>
                                                <option value="inactive">
                                                    Inactive
                                                </option>
                                            </select>
                                            <InputError
                                                :message="form.errors.status"
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
                                    :href="route('companies.index')"
                                    class="text-sm font-semibold leading-6 text-gray-900"
                                >
                                    Cancel
                                </Link>
                                <PrimaryButton
                                    type="submit"
                                    class="bg-indigo-800 hover:bg-blue-500"
                                    >Save</PrimaryButton
                                >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
