<template>
    <Sidebar>
        <div class="p-4 ">
            <div class="">
                <div>
                    <div class="text-2xl">Create Products</div>
                    <div class="text-sm text-gray-500"><span class=" text-blue-500">Home</span> / Create Products</div>
                </div>
                <br>
                <div class="w-1/2 shadow-md border rounded-md p-5">
                    <form class="space-y-5" method="POST" enctype="multipart/form-data" @submit.prevent="submit">
                        <div>
                            <label>Product Name</label>
                            <input v-model="productForm.name" type="text" class="w-full rounded-md h-8 text-xs"
                                placeholder="Product Name">
                            <!-- <InputError class="mt-2" :message="productForm.name" /> -->
                        </div>
                        <div>
                            <label>Product Price</label>
                            <input v-model="productForm.price" type="number" class="w-full rounded-md h-8 text-xs"
                                placeholder="Product Price">
                            <!-- <InputError class="mt-2" :message="productForm.name" /> -->
                        </div>
                        <div>
                            <label>Product Category</label>
                            <select v-model="productForm.category" class="w-full rounded-md h-8 text-xs">
                                <option selected disabled>Select Category</option>
                                <option v-for="category in Categories" v-bind:key="category.id" :value="category.id">{{ category.category }}</option>
                               
                            </select>
                            <!-- <InputError class="mt-2" :message="productForm.category" /> -->

                        </div>
                        <div>
                            <label>Product Description</label>
                            <textarea v-model="productForm.description" class="w-full rounded-md h-20 text-xs"
                                placeholder="Descriptions..."></textarea>
                            <!-- <InputError class="mt-2" :message="productForm.description" /> -->

                        </div>
                        <div>
                            <label>Date</label>
                            <input v-model="productForm.date" type="date" class="w-full rounded-md h-8 text-xs"
                                placeholder="Product Name">
                            <!-- <InputError class="mt-2" :message="productForm.date" /> -->

                        </div>
                        <div>
                            <label>Product Images</label>
                            <input @change="selectImage" multiple type="file"
                                class="w-full border my-auto rounded-md  text-xs" placeholder="Product Name">
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Sidebar>
</template>

<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import Sidebar from './Partials/Sidebar.vue';
import InputError from '@/Components/InputError.vue';
import Swal from 'sweetalert2/dist/sweetalert2.js';

import 'sweetalert2/src/sweetalert2.scss';
import { reactive } from 'vue';


const props = defineProps({
    Categories:Object
})

const productForm = reactive({
    name: '',
    category: '',
    price: '',
    description: '',
    date: '',
    files: File,
});

function selectImage(e) {
    productForm.files = e.target.files;
}

function submit() {
    router.post('/addProducts', productForm)
}
</script>