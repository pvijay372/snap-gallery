<template>
    <div class="2xl:mx-auto 2xl:max-w-7xl pt-5">
        <div class="flex justify-end ">
            <div class="relative">
                <select v-model="selectedLanguage" @change="changeLanguage" class="w-36 block appearance-none bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
                    <option value="en">English</option>
                    <option value="fr">Français</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selectedLanguage: 'en',
        };
    },
    methods: {
        changeLanguage() {
            this.$i18n.locale = this.selectedLanguage;
        },
    },
};
</script>
