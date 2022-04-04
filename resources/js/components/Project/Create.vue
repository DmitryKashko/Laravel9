<template>
    <div class="w-25">
        <div class="mb-3">
            <input type="text" v-model="title" placeholder="title" class="form-control">
        </div>
        <div class="mb-3">
            <textarea type="text" v-model="description" placeholder="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <input @click.prevent="store" type="submit" value="Add" class="btn btn-primary">
<!--            <input :disabled="!isDisabled" @click.prevent="$store.dispatch('store', {name: name, age: age, job: job})" type="submit" value="Add" class="btn btn-primary">-->
        </div>
    </div>
</template>

<script>
import router from "../../router";

export default {
    name: "Create",

    data() {
        return {
            title: null,
            description: null,
        }
    },

    methods: {
        store() {
            axios.post('/api/projects', { title: this.title, description: this.description})
            .then( res => {
                router.push({name: 'project.index' })
            })
        }
    }
}
</script>

<style scoped>

</style>
