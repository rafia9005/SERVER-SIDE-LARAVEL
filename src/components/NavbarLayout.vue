<template>
    <nav class="flex justify-evenly items-center bg-blue-400 text-white py-2">
        <div class="flex gap-[40px] items-center">
            <h1 class="font-bold text-3xl">Laravel Api</h1>
            <ul class="flex gap-[10px]">
                <li><router-link to="">Home</router-link></li>
                <li><router-link to="">About</router-link></li>
                <li><router-link to="">Feature</router-link></li>
                <li><router-link to="">Contact Us</router-link></li>
            </ul>
        </div>
        <div class="flex items-center">
            <ul class="flex gap-[10px]">
                <li v-if="!token"><router-link to="/login">Login</router-link></li>
                <li v-if="!token"><router-link to="/register">Register</router-link></li>
                <li v-if="token"><router-link to="/dashboard">Dashboard</router-link></li>
                <li v-if="token"><router-link to="/logout">Logout</router-link></li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    data(){
        return{
            token : localStorage.getItem('token')
        }
    }
}
</script>
