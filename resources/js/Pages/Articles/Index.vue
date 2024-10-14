<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps(['articles']);

//const form = useForm({});

//const deleteArticle = (id) => {
//    if (confirm('Are you sure you want to move this to trash')) {
//        form.delete(route('articles.destroy', { id: id }), {
//            preserveScroll: true,
//        });
//    }
//};
</script>

<template>
    <Head title="Article Management" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Article Management
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex justify-between">
                        <div class="p-6 text-gray-900">List of articles</div>
                        <div class="my-auto px-5">
                            <Link
                                v-if="
                                    $page.props.auth.user['type'] === 'writer'
                                "
                                :href="route('articles.create')"
                                class="my-auto rounded bg-blue-500 p-3 text-white"
                            >
                                Create Article
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
                                                    Image
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Title
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Link
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Writer
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-6 py-4"
                                                >
                                                    Editor
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
                                                    article, index
                                                ) in articles"
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
                                                    <img
                                                        :src="article.image"
                                                        :alt="article.title"
                                                    />
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ article.title }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ article.link }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{
                                                        article.writer.full_name
                                                    }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{
                                                        article.editorInfo
                                                            ? article.editorInfo
                                                                  .lastname
                                                            : ''
                                                    }}
                                                </td>

                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    {{ article.status }}
                                                </td>

                                                <td
                                                    class="whitespace-nowrap px-6 py-4"
                                                >
                                                    <Link
                                                        v-if="
                                                            $page.props.auth
                                                                .user[
                                                                'type'
                                                            ] === 'editor' ||
                                                            ($page.props.auth
                                                                .user[
                                                                'type'
                                                            ] === 'writer' &&
                                                                article.status ===
                                                                    'for-edit')
                                                        "
                                                        :href="
                                                            route(
                                                                'articles.edit',
                                                                {
                                                                    id: article.id,
                                                                },
                                                            )
                                                        "
                                                        class="my-auto ml-2 rounded bg-blue-500 p-3 text-white"
                                                    >
                                                        Edit
                                                    </Link>
                                                    <!--
                                                    <DangerButton
                                                        class="my-auto ml-2 rounded bg-red-500 py-3 text-white"
                                                        @click="
                                                            deleteArticle(
                                                                article.id,
                                                            )
                                                        "
                                                    >
                                                        Delete
                                                    </DangerButton>
-->
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
