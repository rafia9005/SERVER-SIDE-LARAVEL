<template>

</template>

<script>
import axios from 'axios'
export default {
    async created(){
        localStorage.removeItem('token')
        this.$router.push('/login')
    }
}
</script>
