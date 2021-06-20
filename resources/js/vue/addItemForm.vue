<template>
    <div class="input-group input-group-md mb-2">
        <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
        <input type="text" class="form-control" v-model="item.name"  />
        <input type="hidden" v-model="item.id">
        <font-awesome-icon
            icon="plus-square"
            @click="addItem()"
            :class = "[ item.name ? 'active' : 'inactive' , 'plus' ]"    
        
        />
    </div>
</template>

<script>
import { EventBus } from './event-bus';

export default {
    data: function(){
        return {
            item: {
                id: null,
                name: ""
            }
        }
    },

    methods: {
        addItem(){
            if(this.item.name == ''){
                return;
            }

            axios.post('api/item/store',{
                item: this.item
            })
            .then(response => {
                if(response.status == 200){
                    this.item.id = null;
                    this.item.name = "";
                    this.$emit('reloadlist');
                }
            })
            .catch( error => {
                alert(error);
            })
        }
    },

    created(){
        EventBus.$on('name_task', (data) => {
        this.item.name = data.name;
        this.item.id = data.id;
        })
    }
}
    
</script>

<style scoped>
.plus{
    font-size: 40px;
}
.active{
    color : green
}

.inactive{
    color: gray;
}
</style>