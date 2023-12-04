<template>
    <AppLayout>
        <template #header>
            <span>Cart</span>
        </template>
        <div class="p-10 mt-5 gap-x-4" v-for="product in CustomerCart.data" v-bind:key="product.id">
            <div class="flex justify-around rounded-md shadow-md">
                <div>
                    <img class="mb-2 h-52" src="/Images/Sticker1.png">
                    <span class="pl-2 text-lg font-semibold capitalize">{{ product.name }}</span>
                    <h5 class="pl-2 text-blue-300">₱{{ product.price }}.00</h5>
                </div>
                <div class="flex w-1/3 gap-2 text-center">
                    <button @click="qtyAction('add', product)" class="py-1 my-auto border border-gray-900 rounded-sm h-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                    <input class="my-auto text-center rounded-md h-9" :value="product.qty" type="number" disabled>
                    <button @click="qtyAction('sub', product)" class="py-1 my-auto border border-gray-900 rounded-sm h-fit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                        </svg>

                    </button>
                </div>
                <div class="h-full my-auto">
                    <span>₱{{ product.price * product.qty }}.00</span>
                </div>
                <div class="flex h-full gap-12 my-auto">
                    <input v-model="checkOutForm.products" v-bind:id="product.id" v-bind:value="product" class="w-10 h-10"
                        type="checkbox" />

                    <svg @click="toDeleteCart(product)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-red-700">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>

                </div>
            </div>
        </div>
        <div class="flex  gap-4 my-auto justify-end sticky bottom-0 w-full h-20 bg-[#fe8939]">
            <div class="flex gap-4 my-auto text-lg font-bold text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <span>₱{{ totalPrice }}.00</span>
            </div>
            <button @click="checkout()" class="px-6 py-4 m-2 text-white bg-orange-700 rounded-md">Check Out</button>

        </div>
        <Modal :show="data.deleteModal" :closeable="true" @close="data.deleteModal = !data.deleteModal">
            <div class="p-5">
                <div class="flex justify-between">
                    <div class="font-bold">DELETE ITEM</div>
                    <div>
                        <svg @click="data.deleteModal = !data.deleteModal" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                <div class="py-10 text-center">Are you sure You want to delete <span class="font-bold">{{
                    data.cartItemToDelete.name }}</span> to Cart?</div>
                <div class="flex justify-around">
                    <button @click="data.deleteModal = !data.deleteModal"
                        class="px-4 py-2 text-white bg-red-500 rounded-md">Cancel</button>
                    <button @click="confirmDelete()" class="px-4 py-2 text-white bg-green-500 rounded-md">Confirm</button>
                </div>
            </div>
        </Modal>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue';
import { router } from '@inertiajs/vue3';
import { computed, reactive } from 'vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    CustomerCart: { type: Object }
})

const data = reactive({
    deleteModal: false,
    cartItemToDelete: Object
});

const qtyForm = reactive({
    id: '',
    qty: null,
});

const deleteCartItemForm = reactive({
    id: ''
});

// Computed
const totalPrice = computed(() => {
    var total = 0;
    checkOutForm.products.forEach(element => {
        total = total + (element.price * element.qty)
    });

    return total
});

const checkOutForm = reactive({
    products: [],
    total: totalPrice
});


// Method
function qtyAction(action, cartProduct) {
    qtyForm.id = cartProduct.id;

    if (action == 'add') {
        qtyForm.qty = cartProduct.qty + 1;
    } else {
        qtyForm.qty = cartProduct.qty != 1 ? cartProduct.qty - 1 : cartProduct.qty = 1;
    }
    router.post('/updateqty', qtyForm);
}

function toDeleteCart(product) {
    data.deleteModal = !data.deleteModal
    deleteCartItemForm.id = product.id;
    data.cartItemToDelete = product
}

function confirmDelete() {
    router.post('/deleteCartItem', deleteCartItemForm, {
        onSuccess: (visit) => {
            data.deleteModal = !data.deleteModal

        }
    })
}

function checkout(){
    router.post('/checkout',checkOutForm)
}





</script>