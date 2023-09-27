<template>
    <LanguageSwitcher />
    <router-view></router-view>
</template>

<script>
import LanguageSwitcher from './components/LanguageSwitcher.vue';

export default {    

    components: {
        LanguageSwitcher
    },
    data() {
        return {
            //
        }
    },
    created() {
        //    
    },
    methods: {
        //
    }
}
</script>
