<template>
    <div class="item">
        <input type="checkbox" class="form-check-input mt-0" @change="updateCheck()" v-model="item.completed" />
        <span :class="[ item.completed ? 'completed' : '' , 'itemText']"> {{ item.name }} </span>

        <button @click="edit()" class="edit">
            <font-awesome-icon icon="edit" />
        </button>
        <button @click="remove()" class="trash">
            <font-awesome-icon icon="trash" />
        </button>
    </div>
</template>

<script>
import { EventBus } from './event-bus';

export default {
    props: ['item'],
    methods: {
        updateCheck(){
            axios.put('api/item/' + this.item.id, {
                item: this.item
            })
            .then( response => {
                if(response.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch( error => {
                alert(error);
            })
        },

        remove(){
            axios.delete('api/item/' + this.item.id, {
                item: this.item.id
            })
            .then(response => {
                if(response.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch( error => {
                alert(error);
            })
        },

        edit(){
            axios.get('api/item/' + this.item.id, {
                item: this.item.id
            })
            .then(response => {
                EventBus.$emit('name_task', response.data);
            })
            .catch( error => {
                alert(error);
            })
        }
    }
}
</script>

<style scoped>
    .completed{
        text-decoration: line-through;
        color: gray
    }
    .trash{
        background-color: white;
        color: red
    }
    .trash{
        background-color: white;
        color: blue
    }
    .item{
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 25px;
    }
    .itemText{
        width: 100%;
        margin-left: 20px;
    }
</style>