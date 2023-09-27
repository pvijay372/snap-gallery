<template>
    <div class="fixed inset-0 flex items-center justify-center z-50" v-if="isOpen">
        <div class="modal-overlay"></div>

        <div class="modal-container bg-white w-1/2 mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <!-- Modal content goes here -->
            <div class="modal-content py-4 text-left px-6">
                <div class="modal-header flex justify-between items-center pt-2 pb-5">
                    <h3 class="text-lg font-semibold">Upload Photo</h3>
                    <button @click="closeModal" class="modal-close">
                        <svg class="fill-current text-gray-500 hover:text-gray-700" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <!-- Close icon SVG code -->
                            <path
                                d="M10.586 9l4.293-4.293a1 1 0 10-1.414-1.414L9 7.586 4.707 3.293a1 1 0 00-1.414 1.414L7.586 9l-4.293 4.293a1 1 0 101.414 1.414L9 10.414l4.293 4.293a1 1 0 101.414-1.414L10.414 9z"
                                fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Input field for email -->
                    <div class="mb-4">
                        <label for="photo" class="block text-gray-700 font-bold mb-2">Photo:</label>
                        <input type="file" id="photo" ref="photoInput" class="border rounded w-full py-2 px-3 focus:border-blue-500 focus:ring focus:ring-blue-200" />
                        <span class="text-sm text-red-800 pr-5 font-semibold" v-if="errors.get('photo')">{{ errors.get('photo') }}</span>
                    </div>

                    <div class="mb-4">
                        <button type="button" @click="uploadPhoto"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

class Errors {

    constructor() {
        this.errors = {};
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors;
    }
}

export default {
    data() {
        return {
            isOpen: false,
            photo: '',
            errors: new Errors(),
        };
    },
    methods: {
        openModal() {
            this.isOpen = true;
        },
        closeModal() {
            this.isOpen = false;
            this.cleanErrors();
        },
        uploadPhoto() {
            const fileInput = this.$refs.photoInput;
            const selectedFile = fileInput.files[0];
            
            const formData = new FormData();
            formData.append('photo', selectedFile);
            formData.append('gallery_id', this.$route.params.id);

            axios.post('/api/images', formData)
                .then(({ data }) => {
                    //this.galleries = data;
                    this.closeModal();
                    this.$parent.fetch();
                    this.cleanErrors();
                })
                .catch(error => {
                    console.error('Error fetching galleries:', error);
                    this.errors.record(error.response.data.errors);
                });
        },
        cleanErrors() {
            this.errors = new Errors();
        },
    },
};
</script>