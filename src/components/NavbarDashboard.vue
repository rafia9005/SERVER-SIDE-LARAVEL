<template>
    <nav class="flex justify-evenly items-center py-2 bg-blue-500 text-white">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <ul class="flex gap-[15px]">
            <li><router-link to="">Dashboard</router-link></li>
            <li><router-link v-if="name" to="/profile">{{ name }}</router-link></li>
            <li><router-link to="/logout">logout</router-link></li>
        </ul>
    </nav>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return{
            name : null,
        }
    },
    async created(){
        const responseProfile = await axios.get('http://localhost:8000/v1/profile', {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        })
        this.name = responseProfile.data.username
    },
}
</script>
