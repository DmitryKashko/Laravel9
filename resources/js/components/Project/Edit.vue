<template>
    <div class="w-25">
        <div class="mb-3">
            <input type="text" v-model="title" placeholder="title" class="form-control">
        </div>
        <div class="mb-3">
            <textarea type="text" v-model="description" placeholder="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <input @click.prevent="update" type="submit" value="Update" class="btn btn-primary">
        </div>
    </div>
</template>

<script>
import router from "../../router";

export default {
    name: "Edit",

    data() {
        return {
            title: null,
            description: null,
        }
    },

    mounted() {
        this.getProject()
    },

    methods: {
        getProject() {
            axios.get('/api/projects/' + this.$route.params.id)
            .then(res => {
                this.title = res.data.title
                this.description = res.data.description
            })
        },

        update() {
            axios.patch('/api/projects/' + this.$route.params.id, { title: this.title, description: this.description})
                .then( res => {
                    router.push({name: 'project.show', params: {id: this.$route.params.id} })
                })
        }
    }
}
</script>

<style scoped>

</style>
