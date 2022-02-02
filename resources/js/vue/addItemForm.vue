<template>
    <div class="addItem">
        <input type="text" v-model="post.name" />
        <font-awesome-icon
        icon="plus-square"
        @click="addItem()"
        :class="[ post.name ? 'active' : 'inactive', 'plus' ]"
        />
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            post: {
                name: ""
            }
        }
    },
    methods: {
        addItem() {
            if( this.post.name == '') {
                return;
            }

            axios.post('api/post/store', {
                post: this.post
            })
            .then( response => {
                if( response.status == 201 ) {
                    this.post.name = "";
                    this.$emit('reloadlist');
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
.addItem {
    display: flex;
    justify-content: center;
    align-items: center;
}
input {
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}
.plus {
    font-size: 20px;
}
.active {
    color: #00CE25
}
.inactive {
    color: #999999;
}
</style>