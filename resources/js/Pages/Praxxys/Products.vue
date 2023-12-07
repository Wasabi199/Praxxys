<template>
    <Sidebar>
        <div class="p-4">
            <div>
                <div class="text-2xl">Products</div>
                <div class="text-sm text-gray-500"><span class="text-blue-500 ">Home</span> / Products</div>
            </div>
            <!-- Table Start -->
            <div class="p-2 space-y-4">
                <div class="flex justify-between">
                    <div class="flex gap-4">
                        <div class="">
                            <label class="my-auto text-xs">Category:</label>
                            <select v-model="form.category" class="w-full h-8 my-auto text-xs rounded-md">
                                <option selected disabled>Select</option>
                                <option v-for="category in Categories" v-bind:key="category.id" :value="category.id">{{
                                    category.category }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="my-auto text-xs">Search:</label>
                            <input v-model="form.search" type="text" placeholder="search"
                                class="w-full h-8 my-auto text-xs rounded-md">
                        </div>
                    </div>
                    <div>
                        <br>
                        <button @click="create" class="px-4 py-2 text-white bg-blue-500 rounded-md">Create</button>
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
                                <th>PRICE</th>

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
                                <td>{{ product.name }}</td>
                                <td>₱{{ product.price }}.00</td>
                                <td>{{ product.category }}</td>
                                <td>{{ product.description }}</td>
                                <td>{{ new Date(product.date).toLocaleDateString() }}<br>{{
                                    product.time }}</td>
                                <td class="py-4 space-x-2">
                                    <button @click="selectProductToUpdate(product)" type="button"
                                        class="p-4 text-sm font-bold text-white bg-blue-500 rounded-md">
                                        Edit
                                    </button>
                                    <button @click="selectProductToDelete(product)" type="button"
                                        class="p-4 text-sm font-bold text-white bg-red-500 rounded-md">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-between">
                        <div>
                            <label class="font-extrabold text-xs font-mono text-[#013d77]">View:</label>
                            <select v-model="form.view" class="h-8 text-xs rounded-md w-fit">
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
                    <span class="text-xl font-semibold">DELETE</span>
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
                            class="p-4 text-sm font-bold text-white bg-red-500 rounded-md">CANCEL</button>
                        <button @click="confirmDeleteProduct"
                            class="p-4 text-sm font-bold text-white bg-green-500 rounded-md">CONFIRM</button>
                    </div>
                </div>

            </div>
        </Modal>

        <Modal :show="data.updateProductModal" :closeable="true"
            @close="data.updateProductModal = !data.updateProductModal">
            <div class="p-5">
                <div class="flex justify-between">
                    <span class="text-xl font-semibold">UPDATE</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 cursor-pointer"
                        @click="data.updateProductModal = !data.updateProductModal">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="p-5 ">
                    <form class="space-y-5" method="POST" enctype="multipart/form-data" @submit.prevent="submit">
                        <div v-if="data.selectedUpdateProduct.product_image[0]" class="flex justify-center gap-4">
                            <img class="h-52" :src="data.selectedUpdateProduct.product_image[0].filename ?? ''" />
                            <svg @click="deleteProductImage(data.selectedUpdateProduct.product_image[0].id)"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 my-auto cursor-pointer text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>

                        </div>
                        <div>
                            <label>Product Name</label>
                            <input v-model="productToUpdate.name" type="text" class="w-full h-8 text-xs rounded-md"
                                :placeholder="data.selectedUpdateProduct.name">
                            <span v-if="$page.props.errors.name" class="text-sm text-red-500">• {{ $page.props.errors.name
                            }}</span>

                        </div>
                        <div>
                            <label>Product Price</label>
                            <input v-model="productToUpdate.price" type="text" class="w-full h-8 text-xs rounded-md"
                                :placeholder="data.selectedUpdateProduct.price">
                            <span v-if="$page.props.errors.price" class="text-sm text-red-500">• {{ $page.props.errors.price
                            }}</span>

                        </div>
                        <div>
                            <label>Product Category</label>
                            <select v-model="productToUpdate.category" class="w-full h-8 text-xs rounded-md">
                                <option selected disabled>Select Category</option>
                                <option v-for="category in Categories" v-bind:key="category.id" :value="category.id">{{
                                    category.category }}</option>

                            </select>
                            <span v-if="$page.props.errors.category" class="text-sm text-red-500">• {{
                                $page.props.errors.category }}</span>

                        </div>
                        <div>
                            <label>Product Description</label>
                            <textarea v-model="productToUpdate.description" class="w-full h-20 text-xs rounded-md"
                                :placeholder="data.selectedUpdateProduct.description"></textarea>
                            <span v-if="$page.props.errors.description" class="text-sm text-red-500">• {{
                                $page.props.errors.description }}</span>


                        </div>
                        <div>
                            <label>Date</label>
                            <input v-model="productToUpdate.date" type="date" class="w-full h-8 text-xs rounded-md">
                            <span v-if="$page.props.errors.name" class="text-sm text-red-500">• {{ $page.props.errors.name
                            }}</span>


                        </div>
                        <div>
                            <label>Product Images</label>
                            <input @change="selectImage" multiple type="file"
                                class="w-full my-auto text-xs border rounded-md" placeholder="Product Name">
                        </div>
                        <div v-if="data.url">
                            <img class="h-20" :src="data.url ?? ''" />
                        </div>

                        <div class="flex justify-center">
                            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">UPDATE</button>
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
import { reactive, watch } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    Products: Object,
    Filters: Object,
    Categories: Object
});

const data = reactive({
    url: '',
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
    price: '',
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

const imageToDelete = reactive({
    id: Number
})

function selectImage(e) {
    productToUpdate.files = e.target.files[0];
    data.url = URL.createObjectURL(productToUpdate.files);
}

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
    productToUpdate.price != '' ? productToUpdate.price : productToUpdate.price = data.selectedUpdateProduct.price;
    productToUpdate.category != '' ? productToUpdate.category : productToUpdate.category = data.selectedUpdateProduct.category;
    productToUpdate.description != '' ? productToUpdate.description : productToUpdate.description = data.selectedUpdateProduct.description;
    productToUpdate.date != '' ? productToUpdate.date : productToUpdate.date = data.selectedUpdateProduct.date;

    router.post('/updateProduct', productToUpdate, {
        onSuccess: (visit) => {
            productToUpdate.name = '',
                productToUpdate.price = '',
                productToUpdate.category = '',
                productToUpdate.description = '',
                productToUpdate.date = '',
                productToUpdate.files = File,

                data.url = '',

                data.updateProductModal = !data.updateProductModal;
        }
    });
}


function deleteProductImage(id) {
    imageToDelete.id = id

    router.post('/deleteproductimage', imageToDelete)
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

