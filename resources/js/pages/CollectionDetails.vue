<template>
    <div class="2xl:mx-auto 2xl:max-w-7xl py-10">
        <div class="flex items-center justify-between">
            <div class="flex justify-start items-center gap-5">
                <router-link to="/" class="px-8 py-2 flex justify-start items-center border border-gray-600 rounded-full gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                    </svg>
                    <span>Back</span>
                </router-link>
                <h2 class="text-2xl font-semibold mb-4">{{ $t('collection_details') }}</h2>
            </div>
            <button @click="openModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ $t('upload_photo') }}</button>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div v-for="image in images" :key="image.id" class="p-4 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300 ease-in-out cursor-pointer">
                <div class="h-40 w-full bg-gray-200 rounded-lg mb-4">
                    <img :src="'/storage/' + image.path" alt="Image" class="w-full h-full object-cover object-center">
                </div>
                <div class="text-gray-800">
                    <h3 class="text-xl font-semibold"></h3>
                </div>
            </div>
        </div>
        
        <UploadImageModal ref="uploadImageModalRef" />
    </div>
</template>

<script type="module">
import axios from "axios";
import UploadImageModal from '../components/UploadImageModal.vue';


export default {
    components: {
        UploadImageModal
    },

    data() {
        return {
            images: [],
        }
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch() {
            axios.get('/api/images/' + this.$route.params.id)
                .then(({ data }) => {
                    this.images = data;
                })
                .catch(error => {
                    console.error('Error fetching images:', error);
                });
        },
        openModal() {
            this.$refs.uploadImageModalRef.openModal();
        },  
    },
}
</script>
