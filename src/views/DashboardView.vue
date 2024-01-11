<template>
    <h1>hello world</h1>
    <img alt="">
</template>

<script>
import axios from 'axios';

export default {
    async created(){
        if (!localStorage.getItem('token')){
            this.$router.push('/login');
        }
        const responsePlace = await axios.get('http://localhost:8000/v1/place',{
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        console.log(responsePlace.data);
    }
}
</script>
