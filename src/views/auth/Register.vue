<template>
    <div class="flex justify-center items-center h-screen">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <img
                    class="mx-auto h-[80px] rounded-lg w-auto"
                    src="http://localhost:8000/storage/pp.png"
                    alt="Your Company"
                />
                <h2
                    class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900"
                >
                    create your account!
                </h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" @submit.prevent="loginHandler">
                    <p
                        v-if="validation.message"
                        class="text-red-500 text-center font-bold"
                    >
                        {{ validation.message }}
                    </p>
                    <div>
                        <label
                            for="username"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Username</label
                        >
                        <div class="mt-2">
                            <input
                                v-model="username"
                                name="username"
                                type="text"
                                autofocus
                                required
                                class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label
                                for="password"
                                class="block text-sm font-medium leading-6 text-gray-900"
                                >Password</label
                            >
                        </div>
                        <div class="mt-2">
                            <input
                                v-model="password"
                                name="password"
                                type="password"
                                required
                                class="px-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        >
                            Sign in
                        </button>
                    </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Have account?
                    <router-link
                        to="/login"
                        class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
                        >Login</router-link
                    >
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            username: null,
            password: null,
            validation: {},
        };
    },
    methods: {
        async loginHandler() {
            const bodyData = new FormData();
            bodyData.append("username", this.username);
            bodyData.append("password", this.password);
            try {
                const loginResponse = await axios.post(
                    "http://localhost:8000/v1/auth/register",
                    bodyData,
                );
                const token = loginResponse.data.access_token;
                localStorage.setItem("token", token);
                this.$router.push("/dashboard");
            } catch (error) {
                this.validation = error.response.data;
            }
        },
    },
};
</script>
