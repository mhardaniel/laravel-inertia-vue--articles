<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";

defineProps({
    users: {
        type: Array,
    },
});

const form = useForm({});

const deleteUser = (id) => {
    if (confirm("Are you sure you want to move this to trash")) {
        form.delete(route("users.destroy", { id: id }), {
            preserveScroll: true,
        });
    }
};

</script>

<template>
    <Head title="User Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Management
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-between">
                        <div class="p-6 text-gray-900">List of users</div>
                        <div class="my-auto px-5">
                            <Link
                                :href="route('users.create')"
                                class="p-3 rounded my-auto text-white bg-blue-500"
                            >
                                Create User
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
                                        class="min-w-full border rounded text-left text-sm font-light text-surface "
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
                                                    First Name
                                                </th>
                                                 <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Last Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Email
                                                </th>
                                                 <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Type
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
                                                v-for="(user, index) in users"
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
                                                    {{ user.firstname }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ user.lastname }}
                                                </td>
                                                 <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ user.email }}
                                                </td>

                                                   <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ user.type }}
                                                </td>

                                                   <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ user.status }}
                                                </td>

                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >

                                                    <Link
                                                        :href="
                                                            route(
                                                                'users.edit',
                                                                { id: user.id }
                                                            )
                                                        "
                                                        class="ml-2 p-3 rounded my-auto text-white bg-blue-500"
                                                    >
                                                        Edit
                                                    </Link>
                                                    <DangerButton
                                                        class="ml-2 py-3 rounded my-auto text-white bg-red-500"
                                                        @click="
                                                            deleteUser(
                                                                user.id
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
