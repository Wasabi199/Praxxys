<template>
    <div>
        <Component :is="link.url ? 'Link' : 'span'" v-for="link in links" v-bind:key="link.label" :href="link.url"
            v-html="link.label" class="text-black px-4  border-black "
            :class="{ 'text-gray-500 ': !link.url, 'text-white font-bold bg-gray-400 ': link.active }" preserve-scroll />
    </div>
</template>
  
<script>
import { Link } from '@inertiajs/vue3';
export default {
    props: {
        links: Array
    },
    components: {
        Link
    }
};
</script>