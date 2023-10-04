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
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
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
                                <th scope="col" @click="sort('id')" class="px-6 py-3">
                                    <div class="flex justify-between">
                                        <span>ID</span>
                                        <svg v-show="this.form.sort == 'asc' && this.form.name == 'id'"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z" />
                                        </svg>

                                        <svg v-show="this.form.sort == 'desc' && this.form.name == 'id'
                                            " xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                        </svg>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3" @click="sort('area_name')">
                                    <div class="flex justify-between">
                                        <span>NAME</span>
                                        <svg v-show="this.form.sort == 'asc' && this.form.name == 'area_name'
                                            " xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293V3.5zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1h-1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1h-3zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1h-5zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5z" />
                                        </svg>

                                        <svg v-show="this.form.sort == 'desc' &&
                                            this.form.name == 'area_name'
                                            " xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
                                            <path
                                                d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                        </svg>
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
        <Modal :show="deleteProductModal" :closeable="true" @close="deleteProductModal = !deleteProductModal">
            <div class="p-5">
                <div class="flex justify-between">
                    <span class="font-semibold text-xl">DELETE</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 cursor-pointer"
                        @click="deleteProductModal = !deleteProductModal">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="p-5 space-y-10">
                    <div class="text-center">Do you really want to Delete this Product <span class="font-bold">{{
                        this.selectedProduct.name }}</span>?</div>
                    <div class="flex justify-around">
                        <button @click="deleteProductModal = !deleteProductModal"
                            class="bg-red-500 p-4 rounded-md text-sm text-white font-bold">CANCEL</button>
                        <button @click="confirmDeleteProduct"
                            class="bg-green-500 p-4 rounded-md text-sm text-white font-bold">CONFIRM</button>
                    </div>
                </div>

            </div>
        </Modal>

        <Modal :show="updateProductModal" :closeable="true" @close="updateProductModal = !updateProductModal">
            <div class="p-5">
                <div class="flex justify-between">
                    <span class="font-semibold text-xl">UPDATE</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 cursor-pointer"
                        @click="updateProductModal = !updateProductModal">
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
                            <InputError class="mt-2" :message="productToUpdate.errors.name" />
                        </div>
                        <div>
                            <label>Product Category</label>
                            <select v-model="productToUpdate.category" class="w-full rounded-md h-8 text-xs">
                                <option selected disabled>Select Category</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <InputError class="mt-2" :message="productToUpdate.errors.category" />

                        </div>
                        <div>
                            <label>Product Description</label>
                            <textarea v-model="productToUpdate.description" class="w-full rounded-md h-20 text-xs"
                                placeholder="Descriptions..."></textarea>
                            <InputError class="mt-2" :message="productToUpdate.errors.description" />

                        </div>
                        <div>
                            <label>Date</label>
                            <input v-model="productToUpdate.date" type="date" class="w-full rounded-md h-8 text-xs"
                                placeholder="Product Name">
                            <InputError class="mt-2" :message="productToUpdate.errors.date" />

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
<script>
import Pagination from './Partials/Pagination/Pagination.vue';
import Sidebar from './Partials/Sidebar.vue';
import { pickBy, throttle } from "lodash";
import Modal from '@/Components/Modal.vue';
import Swal from 'sweetalert2/dist/sweetalert2.js';
import InputError from '@/Components/InputError.vue';

import 'sweetalert2/src/sweetalert2.scss';
export default {
    setup() {

    },
    components: {
        Sidebar,
        Pagination,
        Modal,
        InputError
    },
    props: {
        Products: Object,
        Filters: Object,

    },
    data() {
        return {
            deleteProductModal: false,
            updateProductModal: false,

            selectedProduct: Object,
            selectedUpdateProduct: Object,
            productToDelete: this.$inertia.form({
                id: Number
            }),

            productToUpdate: this.$inertia.form({
                id: Number,
                name: '',
                category: '',
                description: '',
                date: '',
                files: File,
            }),

            form: {
                view: this.Filters.view,
                search: this.Filters.search,
                category: this.Filters.category,
            },


        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(route("products"), pickBy(this.form), {
                    preserveState: true,
                    preserveScroll: true,
                });
            }, 600),
        },
    },
    methods: {
        create() {
            this.$inertia.get(route('create.products'));
        },

        selectProductToDelete(product) {
            this.selectedProduct = product
            this.deleteProductModal = !this.deleteProductModal
        },

        confirmDeleteProduct() {
            this.productToDelete.id = this.selectedProduct.id,
                this.productToDelete.delete(route('product.delete'), {
                    onSuccess: (visit) => {
                        this.deleteProductModal = !this.deleteProductModal
                        Swal.fire(
                            'Success!',
                            'Product Deleted!',
                            'success'
                        );
                    }
                });
        },

        selectProductToUpdate(product) {
            this.selectedUpdateProduct = product;
            this.updateProductModal = !this.updateProductModal;
        },

        selectImage(e) {
            this.productToUpdate.files = e.target.files;
        },

        submit() {
            this.productToUpdate.id = this.selectedUpdateProduct.id;

            this.productToUpdate.name != '' ? this.productToUpdate.name : this.productToUpdate.name = this.selectedUpdateProduct.name;
            this.productToUpdate.category != '' ? this.productToUpdate.category : this.productToUpdate.category = this.selectedUpdateProduct.category;
            this.productToUpdate.description != '' ? this.productToUpdate.description : this.productToUpdate.description = this.selectedUpdateProduct.description;
            this.productToUpdate.date != '' ? this.productToUpdate.date : this.productToUpdate.date = this.selectedUpdateProduct.date;

            this.productToUpdate.post(route('product.update'), {
                onSuccess: (visit) => {
                    this.productToUpdate.reset();
                    this.updateProductModal = !this.updateProductModal;

                    Swal.fire(
                        'Success!',
                        'Product Updated!',
                        'success'
                    );

                }
            });
        }


    }
}
</script>
<style scoped></style>