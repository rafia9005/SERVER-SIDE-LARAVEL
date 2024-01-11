<template>

</template>

<script>
import axios from 'axios'
export default {
    async created(){
        await axios.post('http://localhost:8000/v1/auth/logout', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`,
            }
        })
        localStorage.removeItem('token')
        this.$router.push('/login')
    }
}
</script>
