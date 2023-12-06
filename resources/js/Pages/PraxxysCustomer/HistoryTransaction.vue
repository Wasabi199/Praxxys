<template>
    <AppLayout>
        <template #header>
            <span>
                History Transaction
            </span>
        </template>
        <div class="p-10 space-y-4">
            <table class="w-full text-sm text-left text-gray-500 border table-fixed">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            CHECKOUT ID
                        </th>
                        <th>LINK</th>
                        <th>PRICE</th>
                        <!-- <th>PAYMENT METHOD</th> -->
                        <th>DATE AND TIME</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="history in History.data" v-bind:key="history.id" class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ history.id }}
                        </th>
                        <td class="px-6 py-4">{{ history.checkout_id }}</td>
                        <td class="py-4 ">{{history.checkout_link }}</td>
                        <td class="py-4 ">₱{{history.total_price }}.00</td>
                        <!-- <td class="py-4 ">{{history.payment_gateway }}</td> -->
                        <td class="py-4 ">{{new Date(history.created_at).toLocaleDateString()}}<br>{{new Date(history.created_at).toLocaleTimeString()}}</td>

                    </tr>
                </tbody>
            </table>
            <div class="flex justify-between">

                <!-- Pagination -->
                <Pagination :links="History.links"/>
            </div>
        </div>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '../Praxxys/Partials/Pagination/Pagination.vue';

const props = defineProps({
    History:Object
});
</script>