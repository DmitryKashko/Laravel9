<template>
    <div>
        <router-link :to="{ name: 'project.index'}">Project</router-link>
        <router-link :to="{ name: 'project.create'}">Add</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "Index",
    data() {
        return {

        }
    },

    mounted() {
    },
}
</script>

<style scoped>

</style>
