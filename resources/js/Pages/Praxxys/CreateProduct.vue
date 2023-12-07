<template>
    <Sidebar>
        <div class="p-4 ">
            <div class="">
                <div>
                    <div class="text-2xl">Create Products</div>
                    <div class="text-sm text-gray-500"><span class="text-blue-500 ">Home</span> / Create Products</div>
                </div>
                <br>
                <div class="w-1/2 p-5 border rounded-md shadow-md">
                    <form class="space-y-5" method="POST" enctype="multipart/form-data" @submit.prevent="submit">
                        <div>
                            <label>Product Name</label>
                            <input v-model="productForm.name" type="text" class="w-full h-8 text-xs rounded-md"
                                placeholder="Product Name">
                            <span v-if="$page.props.errors.name" class="text-sm text-red-500">• {{ $page.props.errors.name }}</span>
                        </div>
                        <div>
                            <label>Product Price</label>
                            <input v-model="productForm.price" type="number" class="w-full h-8 text-xs rounded-md"
                                placeholder="Product Price">
                                <span v-if="$page.props.errors.name" class="text-sm text-red-500">• {{ $page.props.errors.name }}</span>
                        </div>
                        <div>
                            <label>Product Category</label>
                            <select v-model="productForm.category" class="w-full h-8 text-xs rounded-md">
                                <option selected disabled>Select Category</option>
                                <option v-for="category in Categories" v-bind:key="category.id" :value="category.id">{{ category.category }}</option>
                               
                            </select>
                            <span v-if="$page.props.errors.name" class="text-sm text-red-500">• {{ $page.props.errors.name }}</span>

                        </div>
                        <div>
                            <label>Product Description</label>
                            <textarea v-model="productForm.description" class="w-full h-20 text-xs rounded-md"
                                placeholder="Descriptions..."></textarea>
                                <span v-if="$page.props.errors.name" class="text-sm text-red-500">• {{ $page.props.errors.name }}</span>

                        </div>
                        <div>
                            <label>Date</label>
                            <input v-model="productForm.date" type="date" class="w-full h-8 text-xs rounded-md"
                                placeholder="Product Name">
                                <span v-if="$page.props.errors.name" class="text-sm text-red-500">• {{ $page.props.errors.name }}</span>

                        </div>
                        <div>
                            <label>Product Images</label>
                            <input @change="selectImage" multiple type="file"
                                class="w-full my-auto text-xs border rounded-md" placeholder="Product Name">
                        </div>
                        <div v-if="data.url">
                            <img class="h-20" :src="data.url??''"/>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">Submit</button>
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
import { reactive } from 'vue';



const props = defineProps({
    Categories:Object
})

const data = reactive({
    url:'',
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
    productForm.files = e.target.files[0];
    data.url = URL.createObjectURL(productForm.files);
}

function submit() {
    router.post('/addProducts', productForm)
}
</script>