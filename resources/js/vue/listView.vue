<template>
    <div>
        <div v-for="(post, index) in posts" :key="index" >
            <list-item
                :post="post"
                class="post"
                v-on:itemchanged="$emit('reloadlist')"
                />
        </div>
    </div>
</template>

<script>
import listItem from "./listItem"

export default {
    props: ['posts'],
    components: {
        listItem
    }
}
</script>

<style scoped>
.post {
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>