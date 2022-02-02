<template>
    <div class="post">
        <input
            type="checkbox"
            @change="updateCheck()"
            v-model="post.completed"
            />
        <span :class="[post.completed ? 'completed' : '', 'postText']"> {{ post.name }} </span>
        <button @click="removeItem()" class="trashcan" >
            <font-awesome-icon icon="trash" />
        </button>
    </div>
</template>

<script>
export default {
    props: ['post'],
    methods: {
        updateCheck() {
            axios.put('api/post/' + this.post.id, {
                post: this.post
            } )
            .then( response => {
                if( response.status = 200) {
                    this.$emit('itemchanged');
                }
            })
            .catch( error => {
                console.log( error );
            })
        },
        removeItem() {
            axios.delete('api/post/' + this.post.id )
            .then( response => {
                if( response.status == 200 ) {
                    this.$emit('itemchanged');
                }
            })
            .catch( error => {
                console.log( error );
            })
        }
    }
}
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}
.postText {
    width: 100%;
    margin-left: 20px;
}
.post {
    display: flex;
    justify-content: center;
    align-items: center;
}
.trashcan {
    background: #e6e6e6;
    border: none;
    color: #FF0000;
    outline: none;
}
</style>