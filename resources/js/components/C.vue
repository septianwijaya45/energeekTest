<template>
    <div class="h-screen w-full bg-['#ffffff'] flex flex-col justify-center items-center ">
        <div class="mt-20">
            <img :src="imageLogo" alt="Logo">
        </div>
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h5 style="font-size: 20px;" class="text-center">Apply Lamaran</h5>
            <div class="mb-4 mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
            </div>
            <div class="mb-6">
                <label for="select3" class="col-sm-3 control-label">
                    A searchable select with groups and localized in zh-CN:
                </label>
                <div class="col-sm-5">
                    <Select2 class="w-full" v-model="myValue" :options="myOptions" @change="myChangeEvent($event)" @select="mySelectEvent($event)" />
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-[#F64E60] w-full text-white py-2 px-4 rounded" type="button">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import Select2 from 'vue3-select2-component';
    export default {
        components: {Select2},
        data() {
            return{
                imageLogo: '/image/logo.png',
                myValue: '',
                myOptions: ['op1', 'op2', 'op3']
            }
        },
        methods: {
            myChangeEvent(val){
                console.log(val);
            },
            mySelectEvent({id, text}){
                console.log({id, text})
            }
        }
    }
</script>