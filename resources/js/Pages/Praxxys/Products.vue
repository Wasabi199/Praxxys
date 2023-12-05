<template>
    <Sidebar>
        <div class="p-4">
            <div>
                <div class="text-2xl">Products</div>
                <div class="text-sm text-gray-500"><span class=" text-blue-500">Home</span> / Products</div>
            </div>
            <!-- Table Start -->
            <div class="p-2 space-y-4">
                <div class="flex justify-between">
                    <div class="flex gap-4">
                        <div class=" ">
                            <label class="my-auto text-xs">Category:</label>
                            <select v-model="form.category" class="rounded-md h-8 my-auto text-xs w-full">
                                <option selected disabled>Select</option>
                                <option v-for="category in Categories" v-bind:key="category.id" :value="category.id">{{ category.category }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs my-auto">Search:</label>
                            <input v-model="form.search" type="text" placeholder="search"
                                class="rounded-md my-auto h-8 text-xs w-full">
                        </div>
                    </div>
                    <div>
                        <br>
                        <button @click="create" class="py-2 px-4 bg-blue-500 text-white rounded-md">Create</button>
                    </div>
                </div>
                <div class="space-y-4">
                    <table class="w-full text-sm text-left text-gray-500 border table-fixed">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex justify-between">
                                        <span>ID</span>

                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex justify-between">
                                        <span>NAME</span>

                                    </div>
                                </th>
                                <th>CATEGORY</th>
                                <th>DESCRIPTION</th>
                                <th>DATE AND TIME</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in Products.data" v-bind:key="product.id"
                                class="bg-white border-b da hover:bg-gray-50">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ product.id }}
                                </th>
                                <td class="px-6 py-4">{{ product.name }}</td>
                                <td class="px-6 py-4">{{ product.category }}</td>
                                <td class="px-6 py-4">{{ product.description }}</td>
                                <td class="px-6 py-4 text-start">{{ product.date }}<br>{{ product.time }}</td>
                                <td class="py-4 space-x-2">
                                    <button @click="selectProductToUpdate(product)" type="button"
                                        class="bg-blue-500 p-4 rounded-md text-sm text-white font-bold">
                                        Edit
                                    </button>
                                    <button @click="selectProductToDelete(product)" type="button"
                                        class="bg-red-500 p-4 rounded-md text-sm text-white font-bold">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-between">
                        <div>
                            <label class="font-extrabold text-xs font-mono text-[#013d77]">View:</label>
                            <select v-model="form.view" class="rounded-md w-fit text-xs h-8">
                                <option value="10">10</option>
                            </select>
                        </div>
                        <!-- Pagination -->
                        <Pagination :links="Products.links"></Pagination>
                    </div>
                </div>
            </div>

        </div>
        <Modal :show="data.deleteProductModal" :closeable="true"
            @close="data.deleteProductModal = !data.deleteProductModal">
            <div class="p-5">
                <div class="flex justify-between">
                    <span class="font-semibold text-xl">DELETE</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 cursor-pointer"
                        @click="data.deleteProductModal = !data.deleteProductModal">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="p-5 space-y-10">
                    <div class="text-center">Do you really want to Delete this Product <span class="font-bold">{{
                        data.selectedProduct.name }}</span>?</div>
                    <div class="flex justify-around">
                        <button @click="data.deleteProductModal = !data.deleteProductModal"
                            class="bg-red-500 p-4 rounded-md text-sm text-white font-bold">CANCEL</button>
                        <button @click="confirmDeleteProduct"
                            class="bg-green-500 p-4 rounded-md text-sm text-white font-bold">CONFIRM</button>
                    </div>
                </div>

            </div>
        </Modal>

        <Modal :show="data.updateProductModal" :closeable="true"
            @close="data.updateProductModal = !data.updateProductModal">
            <div class="p-5">
                <div class="flex justify-between">
                    <span class="font-semibold text-xl">UPDATE</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 cursor-pointer"
                        @click="data.updateProductModal = !data.updateProductModal">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class=" p-5">
                    <form class="space-y-5" method="POST" enctype="multipart/form-data" @submit.prevent="submit">
                        <div>
                            <label>Product Name</label>
                            <input v-model="productToUpdate.name" type="text" class="w-full rounded-md h-8 text-xs"
                                placeholder="Product Name">
                        </div>
                        <div>
                            <label>Product Category</label>
                            <select v-model="productToUpdate.category" class="w-full rounded-md h-8 text-xs">
                                <option selected disabled>Select Category</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>

                        </div>
                        <div>
                            <label>Product Description</label>
                            <textarea v-model="productToUpdate.description" class="w-full rounded-md h-20 text-xs"
                                placeholder="Descriptions..."></textarea>

                        </div>
                        <div>
                            <label>Date</label>
                            <input v-model="productToUpdate.date" type="date" class="w-full rounded-md h-8 text-xs"
                                placeholder="Product Name">

                        </div>
                        <div>
                            <label>Product Images</label>
                            <input @change="selectImage" multiple type="file"
                                class="w-full border my-auto rounded-md  text-xs" placeholder="Product Name">
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-md">UPDATE</button>
                        </div>
                    </form>
                </div>

            </div>
        </Modal>
    </Sidebar>
</template>

<script setup lang="ts">
import Pagination from './Partials/Pagination/Pagination.vue';
import Sidebar from './Partials/Sidebar.vue';
import { pickBy, throttle } from "lodash";
import Modal from '@/Components/Modal.vue';
import Swal from 'sweetalert2/dist/sweetalert2.js';
import InputError from '@/Components/InputError.vue';
import { defineComponent, reactive, watch } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    Products: Object,
    Filters: Object,
    Categories:Object
});

const data = reactive({
    deleteProductModal: false,
    updateProductModal: false,

    selectedProduct: Object,
    selectedUpdateProduct: Object,
});


const productToDelete = reactive({
    id: ''
});

const productToUpdate = reactive({
    id: Number,
    name: '',
    category: '',
    description: '',
    date: '',
    files: File,
});

const form = reactive({
    view: props.Filters.view,
    search: props.Filters.search,
    category: props.Filters.category,
});

function create() {
    router.get('/create')
}

function selectProductToUpdate(product) {
    data.selectedUpdateProduct = product;
    data.updateProductModal = !data.updateProductModal;
}

function selectProductToDelete(product) {
    data.selectedProduct = product
    // console.log(product);
    data.deleteProductModal = !data.deleteProductModal
}


function confirmDeleteProduct() {
    productToDelete.id = data.selectedProduct.id,
        router.post('/deleteProduct', productToDelete, {
            onSuccess: (visit) => {
                data.deleteProductModal = !data.deleteProductModal

            }
        });
}

function submit() {
    productToUpdate.id = data.selectedUpdateProduct.id;

    productToUpdate.name != '' ? productToUpdate.name : productToUpdate.name = data.selectedUpdateProduct.name;
    productToUpdate.category != '' ? productToUpdate.category : productToUpdate.category = data.selectedUpdateProduct.category;
    productToUpdate.description != '' ? productToUpdate.description : productToUpdate.description = data.selectedUpdateProduct.description;
    productToUpdate.date != '' ? productToUpdate.date : productToUpdate.date = data.selectedUpdateProduct.date;

    router.post('/updateProduct', productToUpdate, {
        onSuccess: (visit) => {
            data.updateProductModal = !data.updateProductModal;
        }
    });
}
watch(
    () => form,
    throttle(() => {
        router.get('/products', pickBy(form), {
            preserveState: true,
        });
    }, 300),
    { deep: true }
);

</script>

