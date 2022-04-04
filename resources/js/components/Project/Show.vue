<template>
    <div v-if="project">
        <div>
            Title: {{ this.project.title }}
        </div>
        <div>
            Title: {{ this.project.description }}
        </div>
        <router-link :to="{ name: 'project.edit', params: { id: this.project.id }}">Edit</router-link>
    </div>
</template>

<script>
export default {
    name: "Show",

    data() {
        return {
            project: null
        }
    },

    mounted() {
        this.getProject()
    },

    methods: {
        getProject() {
            axios.get('/api/projects/' + this.$route.params.id)
                .then(res => {
                    this.project = res.data
                })
        },

    }
}
</script>

<style scoped>

</style>
