<template>
    <div class="2xl:mx-auto 2xl:max-w-7xl py-10">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold mb-4">{{ $t('list_of_collections') }}</h2>
            <button @click="openModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ $t('add_collection') }}</button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div v-for="gallery in galleries" :key="gallery.id" @click="showCollectionDetails(gallery.id)" class="p-4 bg-white shadow-lg rounded-lg hover:shadow-xl transition duration-300 ease-in-out cursor-pointer">
                <div class="h-40 w-full bg-gray-200 rounded-lg mb-4">
                    <img v-if="gallery.first_image" :src="'/storage/' + gallery.first_image.path" alt="Image" class="w-full h-full object-cover object-center">
                </div>
                <div class="flex justify-between items-center text-gray-800">
                    <h3 class="text-xl font-semibold">{{ gallery.name }}</h3>
                    <button  type="button" @click.stop="openAuthModal(gallery.email, gallery.id)" class="p-2 hover:bg-gray-100 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <AddGalleryModal ref="addGalleryModalRef" />
        <EditGalleryModal ref="editGalleryModalRef" :galleryId="galleryId" />
        <AuthModal ref="authModalRef" @open-edit-modal="openEditModal(email)" />
    </div>
</template>

<script type="module">
import axios from "axios";
import AddGalleryModal from '../components/AddGalleryModal.vue';
import EditGalleryModal from '../components/EditGalleryModal.vue';
import AuthModal from '../components/AuthModal.vue';


export default {
    components: {
        AddGalleryModal, 
        EditGalleryModal, 
        AuthModal
    },

    data() {
        return {
            galleries: [],
            galleryId: null,
        }
    },

    created() {
        this.fetch();
    },

    methods: {
        fetch() {
            axios.get('/api/galleries')
                .then(({ data }) => {
                    this.galleries = data;
                })
                .catch(error => {
                    console.error('Error fetching galleries:', error);
                });
        },

        openModal() {
            this.$refs.addGalleryModalRef.openModal();
        },

        openAuthModal(email, galleryId) {
            this.galleryId = galleryId;
            const ownershipToken = localStorage.getItem('ownershipToken');
            if (ownershipToken) {
                this.openEditModal(email);
            } else {
                this.$refs.authModalRef.openModal();
            }

        },

        openEditModal(email) {
            const ownershipToken = localStorage.getItem('ownershipToken');
            if (ownershipToken == email) {
                this.$refs.editGalleryModalRef.openModal();
            } else {
                alert('You are not authorized to make the changes.');
            }
        },

        showCollectionDetails(id) {
            this.$router.push({ name: 'collectionDetails', params: { id: id } });
        },
    },
}
</script>
