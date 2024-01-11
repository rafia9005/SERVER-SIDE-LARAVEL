<script setup>
import NavbarDashboard from "@/components/NavbarDashboard.vue";
</script>

<template>
    <NavbarDashboard />
    <div class="flex justify-center items-center">
        <table class="auto-table mt-5">
            <thead class="auto-table">
                <tr class="bg-yellow-500">
                    <th class="px-5">ID</th>
                    <th class="px-5">Name</th>
                    <th class="px-5">latitude</th>
                    <th class="px-5">longitude</th>
                    <th class="px-5">Image</th>
                    <th class="px-5">Description</th>
                    <th class="px-5">Action</th>
                </tr>
            </thead>
            <tbody v-for="item in place" :key="item.id">
                <tr class="bg-indigo-200">
                    <th>{{ item.id }}</th>
                    <th>{{ item.name }}</th>
                    <th>{{ item.latitude }}</th>
                    <th>{{ item.longitude }}</th>
                    <th>
                        <a
                            :href="
                                'http://localhost:8000/storage' +
                                item.image_path
                            "
                            ><i class="fa-solid fa-eye text-blue-500"></i
                        ></a>
                    </th>
                    <th>{{ item.description }}</th>
                    <th class="flex gap-[5px] justify-center items-center">
                        <button @click="deletePlace(item.id)">
                            <!-- delete button -->
                            <i class="fa-solid fa-trash text-red-500"></i>
                        </button>
                        <button @click="editButton = !editButton">
                            <i
                                class="fa-solid fa-pen-to-square text-yellow-400"
                            ></i>
                        </button>
                    </th>
                </tr>
            </tbody>
        </table>
        <div>
            <!-- edit button -->
            <div
            v-show="editButton"
                class="absolute flex justify-center items-center m-auto left-0 top-0 right-0 h-screen backdrop-blur-sm bg-opacity-10"
            >
                <div class="bg-gray-100 shadow-lg">
                    <button @click="editButton = !editButton">Close</button>
                    <form action="">
                        <div>
                            <label for="">Name</label>
                            <input type="text" name="name">
                        </div>
                        <div>
                            <label for="">Image</label>
                            <input type="file" name="image_path">
                        </div>
                        <div>
                            <label for="">Description</label>
                            <input type="text" name="description">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            place: null,
            editButton: false,
        };
    },
    async created() {
        if (!localStorage.getItem("token")) {
            this.$router.push("/login");
        }
        const responsePlace = await axios.get(
            "http://localhost:8000/v1/place",
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            }
        );
        this.place = responsePlace.data.data;
    },
    methods: {
        async deletePlace(PlaceId) {
            await axios.delete(`http://localhost:8000/v1/place/${PlaceId}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
            });
            window.location.reload();
        },
    },
};
</script>
