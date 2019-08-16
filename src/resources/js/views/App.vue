<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <router-link :to="{name: 'home'}" class="navbar-brand">Fresh Tomatoes</router-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <router-link :to="{ name: 'login' }" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                        <router-link :to="{ name: 'register' }" class="nav-link" v-if="!isLoggedIn">Register</router-link>
                        <li class="nav-link" v-if="isLoggedIn"> Hi, {{name}}</li>
                        <router-link :to="{ name: 'inventory' }" class="nav-link">Inventory</router-link>
                    </ul>

                </div>
            </div>
        </nav>
        <main class="py-4">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                isLoggedIn : null,
                name : null
            }
        },
        mounted(){
            this.isLoggedIn = localStorage.getItem('jwt')
            this.name = localStorage.getItem('user')

            if (this.isLoggedIn && !this.name) {
                this.getUser()
            }
        }, 
        methods: {
            getUser() {
                let headers = {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('jwt')
                    } 

                console.log(headers)
                axios.get("/api/users/me", {
                    headers: headers
                })
                .then(response => {
                    localStorage.setItem('user',response.data.data.first_name)
                    this.name = response.data.data.first_name
                })
                .catch (function (error) {
                    console.log(error)
                })
            }
        }
    }
</script>