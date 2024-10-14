<script setup lang="ts">
import DangerButton from '@/Components/DangerButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps(['companies']);

const form = useForm({});

const deleteCompany = (id: number) => {
    if (confirm('Are you sure you want to move this to trash')) {
        form.delete(route('companies.destroy', { id: id }), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Company Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Company Management
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex justify-between">
                        <div class="p-6 text-gray-900">List of companies</div>
                        <div class="my-auto px-5">
                            <Link
                                :href="route('companies.create')"
                                class="my-auto rounded bg-blue-500 p-3 text-white"
                            >
                                Create Company
                            </Link>
                        </div>
                    </div>
                    <div class="flex flex-col p-6">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="inline-block min-w-full py-2 sm:px-6 lg:px-8"
                            >
                                <div class="overflow-hidden">
                                    <table
                                        class="text-surface min-w-full rounded border text-left text-sm font-light"
                                    >
                                        <thead
                                            class="border-b border-neutral-200 font-medium dark:border-white/10"
                                        >
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    #
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Logo
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Status
                                                </th>

                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(
                                                    company, index
                                                ) in companies"
                                                :key="index"
                                                class="border-b border-neutral-200 dark:border-white/10"
                                            >
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ index + 1 }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ company.logo }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ company.name }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ company.status }}
                                                </td>

                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    <Link
                                                        :href="
                                                            route(
                                                                'companies.edit',
                                                                {
                                                                    id: company.id,
                                                                },
                                                            )
                                                        "
                                                        class="my-auto ml-2 rounded bg-blue-500 p-3 text-white"
                                                    >
                                                        Edit
                                                    </Link>
                                                    <DangerButton
                                                        class="my-auto ml-2 rounded bg-red-500 py-3 text-white"
                                                        @click="
                                                            deleteCompany(
                                                                company.id,
                                                            )
                                                        "
                                                    >
                                                        Delete
                                                    </DangerButton>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
