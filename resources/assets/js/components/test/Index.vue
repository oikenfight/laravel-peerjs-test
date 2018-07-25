<template>
    <div>
        <ul class="list-group">
            <li class="list-group-item">
                <router-link to="/test/receiver">Receiver</router-link>
            </li>
            <li class="list-group-item">
                <router-link to="/test/sender">Sender</router-link>
            </li>
        </ul>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data () {
            return {}
        },
        created () {
        },
    }
</script>

<style scoped>

</style>