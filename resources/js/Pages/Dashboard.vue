<script setup lang="ts">
import Article from '@/Components/Article.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps(['articles']);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-4xl space-y-6 sm:px-6 lg:px-8">
                <div class="flex">
                    <Link
                        class="p-4"
                        :class="{
                            'bg-indigo-400 text-white':
                                $page.url === '/dashboard',
                        }"
                        href="/dashboard"
                        :only="['articles']"
                    >
                        {{
                            $page.props.auth.user.type === 'editor'
                                ? 'For Publish'
                                : 'For Edit'
                        }}</Link
                    >
                    <Link
                        class="p-4"
                        :class="{
                            'bg-indigo-400 text-white': $page.url.includes('?'),
                        }"
                        href="/dashboard?filterByStatus=published"
                        :only="['articles']"
                        >Published</Link
                    >
                </div>

                <div>
                    <Article
                        v-for="article in articles"
                        :key="article.id"
                        :article="article"
                        class="my-4 py-20"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
