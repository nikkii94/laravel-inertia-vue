<template>
    <div class="mt-6">
        <Component
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
            :class="{
                'bg-indigo-50' : link.active,
                'border-indigo-500': link.active,
                'text-indigo-600': link.active,
                'bg-white': !!link.url,
                'border-gray-300': !!link.url,
                'text-gray-500': !link.active,
                'hover:bg-gray-50': !!link.url
            }"
        />
    </div>
</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: {
        links: Array,
    }
}
</script>
