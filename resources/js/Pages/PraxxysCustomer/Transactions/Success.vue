<template>
    <div class="w-full p-10 bg-center bg-no-repeat bg-cover rounded-md h-96 "
        style="background-image:url('/Images/background.jpg');">
    </div>
    <div class="font-bold text-center text-8xl text-[#fe8939]">
        Success
    </div>
    <div class="flex justify-center my-10">
        <button @click="home()" class="bg-[#fe8939] py-2 px-4 rounded-md text-lg text-white">Home</button>
    </div>
</template>
<script setup lang="ts">
import { router } from "@inertiajs/vue3";


function home(){
    router.get('/dashboard');
}

</script>