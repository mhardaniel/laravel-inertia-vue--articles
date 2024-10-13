<script setup lang="ts">
defineProps(['article']);
</script>

<template>
    <div
        class="flex flex-col items-center justify-center bg-white p-4 shadow sm:rounded-lg"
    >
        <div class="text-center">
            <h2 class="text-2xl font-bold">{{ article.title }}</h2>
            <a class="text-sm text-blue-700" :href="article.link">{{
                article.link
            }}</a>
        </div>
        <div>
            <img :src="article.image" :alt="article.title" class="mx-auto" />

            <div class="flex flex-col items-center">
                <span class="text-gray-800">{{
                    article.writer.full_name
                }}</span>
                <small class="text-sm text-gray-600">{{ article.date }}</small>
            </div>

            <div class="mt-4" v-html="article.content"></div>

            <div>
                <small class="text-sm text-gray-600">Editor: </small>

                <span class="text-gray-800">{{
                    article.editor?.full_name || 'n/a'
                }}</span>
            </div>
        </div>
    </div>
</template>
