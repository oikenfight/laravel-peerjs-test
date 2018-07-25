<template>
    <div>
        <div class="container">

            <nav class="navbar navbar-expand-md navbar-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <router-link :to="{path: '/home'}" class="nav-link" active-class="active">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{path: '/test'}" class="nav-link" active-class="active">Test</router-link>
                        </li>
                    </ul>

                </div>
            </nav>

            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {}
        },
    }
</script>

<style scoped>

</style>