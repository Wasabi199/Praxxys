<template>
    <div class="absolute z-20 flex flex-col space-y-5 top-20 right-5">
        <div v-if="messages">
            <notification-item v-for="message in messages" v-bind:key="message" :notification="message"></notification-item>
        </div>
    </div>
</template>

<script>
import NotificationItem from './NotificationItem.vue';
export default {
    setup() {

    },
    props: {
        notification: Object,
        messages: Object,
    },
    components: {
        NotificationItem
    }
}
</script>