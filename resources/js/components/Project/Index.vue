<template>
    <div>
        <table class="table w-75">
            <thead>
            <tr>
                <th scope="col">title</th>
                <th scope="col">description</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="project in projects">
                <td>
                    <router-link :to="{ name: 'project.show', params: { id: project.id }}">{{ project.title }}</router-link>
                </td>
                <td>{{ project.description }}</td>
                <td>
                    <router-link :to="{ name: 'project.edit', params: { id: project.id }}">Edit</router-link>
                </td>
                <td>
                    <a @click.prevent="deletePerson(project.id)" href="#" class="btn btn-outline-danger">Delete</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Index",

    data() {
        return {
            projects: null,
        }

    },

    mounted() {
        this.getProjects()
    },

    methods: {
        getProjects() {
            axios.get('/api/projects')
            .then( res => {
                this.projects = res.data
            })
        },

        deletePerson(id) {
            axios.delete('/api/projects/' + id)
            .then( res => {
                this.getProjects()
            })
        }
    }
}
</script>

<style scoped>

</style>
