<template>
    <AppLayout>
        <template #header>
            <span>Shop</span>
        </template>
        <div class="p-10">
            <div class="w-full p-10 bg-center bg-no-repeat bg-cover rounded-md h-96 "
                style="background-image:url('/Images/background.jpg');">
            </div>
            <div class="mt-5 gap-x-4" v-for="product in Products.data" v-bind:key="product.id">
                <div class="flex justify-around rounded-md shadow-md">
                    <div>
                        <img class="mb-2 h-52" src="/Images/Sticker1.png">
                        <span class="pl-2 text-lg font-semibold capitalize">{{ product.name }}</span>
                        <h5 class="pl-2 text-blue-300">₱{{ product.price }}.00</h5>
                    </div>
                    <div class="w-1/3 text-center">
                        <span class="font-bold">Description</span>
                        <p>{{ product.description }}</p>
                    </div>
                    <div class="h-full my-auto">
                        <button @click="addToCart(product.id)" class="flex px-4 py-2 bg-[#fe8939] text-white rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                            <span>Add to Cart</span>
                        </button>
                    </div>
                </div>
            </div>
            <Pagination class="py-4 m-auto w-fit" :links="Products.links" />
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import route from 'vendor/tightenco/ziggy/src/js';
import { reactive } from 'vue';
import Pagination from '../Praxxys/Partials/Pagination/Pagination.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    Products: { type: Object }
});

const productToCart = reactive({
    product_id: '',
})

function addToCart(id) {
    productToCart.product_id = id;
    router.post('/addtocart', productToCart,{
        preserveScroll:true,
        preserveState:true
    });
}

</script>