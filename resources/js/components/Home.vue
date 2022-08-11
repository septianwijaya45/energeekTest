<template>
    <div class="h-screen w-full flex flex-col justify-center items-center">
        <div class="text-2xl text-gray-800">
            Silahkan Login untuk masuk aplikasi
        </div>
        <button class="mt-5">
            <span class="bg-violet-500 hover:bg-violet-600 active:bg-violet-700 focus:outline-none focus:ring focus:ring-violet-300 px-8 py-3">
                <router-link to="/login">Login</router-link>
            </span>
        </button>
    </div>
</template>

<script>
    export default{
        
    }
</script>