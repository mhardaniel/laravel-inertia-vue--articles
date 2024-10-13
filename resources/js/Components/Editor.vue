<script setup lang="ts">
import Underline from '@tiptap/extension-underline';
import StarterKit from '@tiptap/starter-kit';
import { EditorContent, useEditor } from '@tiptap/vue-3';

import CodeIcon from 'vue-material-design-icons/CodeTags.vue';
import BoldIcon from 'vue-material-design-icons/FormatBold.vue';
import H1Icon from 'vue-material-design-icons/FormatHeader1.vue';
import H2Icon from 'vue-material-design-icons/FormatHeader2.vue';
import ItalicIcon from 'vue-material-design-icons/FormatItalic.vue';
import ListIcon from 'vue-material-design-icons/FormatListBulleted.vue';
import OrderedListIcon from 'vue-material-design-icons/FormatListNumbered.vue';
import BlockquoteIcon from 'vue-material-design-icons/FormatQuoteClose.vue';
import UnderlineIcon from 'vue-material-design-icons/FormatUnderline.vue';
import HorizontalRuleIcon from 'vue-material-design-icons/Minus.vue';
import RedoIcon from 'vue-material-design-icons/Redo.vue';
import UndoIcon from 'vue-material-design-icons/Undo.vue';

const props = defineProps({
    modelValue: String,
});

const emit = defineEmits(['update:modelValue']);

const editor = useEditor({
    content: props.modelValue,
    onUpdate: ({ editor }) => {
        // console.log(editor.getHTML())
        emit('update:modelValue', editor.getHTML());
    },
    extensions: [StarterKit, Underline],
    editorProps: {
        attributes: {
            id: 'content',
            class: 'border border-gray-400 p-4 min-h-[12rem] max-h-[12rem] overflow-y-auto outline-none prose max-w-none',
        },
    },
});
</script>

<template>
    <div>
        <section
            v-if="editor"
            class="buttons flex flex-wrap items-center gap-x-4 border-l border-r border-t border-gray-400 p-4 text-gray-700"
        >
            <button
                type="button"
                @click="editor.chain().focus().toggleBold().run()"
                :class="{ 'rounded bg-gray-200': editor.isActive('bold') }"
                class="p-1"
            >
                <BoldIcon title="Bold" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleItalic().run()"
                :class="{ 'rounded bg-gray-200': editor.isActive('italic') }"
                class="p-1"
            >
                <ItalicIcon title="Italic" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleUnderline().run()"
                :class="{ 'rounded bg-gray-200': editor.isActive('underline') }"
                class="p-1"
            >
                <UnderlineIcon title="Underline" />
            </button>
            <button
                type="button"
                @click="
                    editor.chain().focus().toggleHeading({ level: 1 }).run()
                "
                :class="{
                    'rounded bg-gray-200': editor.isActive('heading', {
                        level: 1,
                    }),
                }"
                class="p-1"
            >
                <H1Icon title="H1" />
            </button>
            <button
                type="button"
                @click="
                    editor.chain().focus().toggleHeading({ level: 2 }).run()
                "
                :class="{
                    'rounded bg-gray-200': editor.isActive('heading', {
                        level: 2,
                    }),
                }"
                class="p-1"
            >
                <H2Icon title="H2" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleBulletList().run()"
                :class="{
                    'rounded bg-gray-200': editor.isActive('bulletList'),
                }"
                class="p-1"
            >
                <ListIcon title="Bullet List" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleOrderedList().run()"
                :class="{
                    'rounded bg-gray-200': editor.isActive('orderedList'),
                }"
                class="p-1"
            >
                <OrderedListIcon title="Ordered List" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleBlockquote().run()"
                :class="{
                    'rounded bg-gray-200': editor.isActive('blockquote'),
                }"
                class="p-1"
            >
                <BlockquoteIcon title="Blockquote" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleCode().run()"
                :class="{ 'rounded bg-gray-200': editor.isActive('code') }"
                class="p-1"
            >
                <CodeIcon title="Code" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().setHorizontalRule().run()"
                class="p-1"
            >
                <HorizontalRuleIcon title="Horizontal Rule" />
            </button>
            <button
                type="button"
                class="p-1 disabled:text-gray-400"
                @click="editor.chain().focus().undo().run()"
                :disabled="!editor.can().chain().focus().undo().run()"
            >
                <UndoIcon title="Undo" />
            </button>
            <button
                type="button"
                @click="editor.chain().focus().redo().run()"
                :disabled="!editor.can().chain().focus().redo().run()"
                class="p-1 disabled:text-gray-400"
            >
                <RedoIcon title="Redo" />
            </button>
        </section>
        <EditorContent :editor="editor" />
    </div>
</template>

<style lang="scss">
/* Basic editor styles */
.tiptap {
    :first-child {
        margin-top: 0;
    }

    /* List styles */
    ul,
    ol {
        padding: 0 1rem;
        margin: 1.25rem 1rem 1.25rem 0.4rem;

        li p {
            margin-top: 0.25em;
            margin-bottom: 0.25em;
        }
    }
    ol {
        list-style-type: decimal;
    }
    ul {
        list-style-type: disc;
    }

    /* Heading styles */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        line-height: 1.1;
        margin-top: 2.5rem;
        text-wrap: pretty;
    }

    h1,
    h2 {
        margin-top: 3.5rem;
        margin-bottom: 1.5rem;
    }

    h1 {
        font-size: 1.4rem;
    }

    h2 {
        font-size: 1.2rem;
    }

    h3 {
        font-size: 1.1rem;
    }

    h4,
    h5,
    h6 {
        font-size: 1rem;
    }

    /* Code and preformatted text styles */
    code {
        background-color: var(--purple-light);
        border-radius: 0.4rem;
        color: var(--black);
        font-size: 0.85rem;
        padding: 0.25em 0.3em;
    }

    pre {
        background: var(--black);
        border-radius: 0.5rem;
        color: var(--white);
        font-family: 'JetBrainsMono', monospace;
        margin: 1.5rem 0;
        padding: 0.75rem 1rem;

        code {
            background: none;
            color: inherit;
            font-size: 0.8rem;
            padding: 0;
        }
    }

    mark {
        background-color: #faf594;
        border-radius: 0.4rem;
        box-decoration-break: clone;
        padding: 0.1rem 0.3rem;
    }

    blockquote {
        border-left: 3px solid var(--gray-3);
        margin: 1.5rem 0;
        padding-left: 1rem;
    }

    hr {
        border: none;
        border-top: 1px solid var(--gray-2);
        margin: 2rem 0;
    }
}
</style>
