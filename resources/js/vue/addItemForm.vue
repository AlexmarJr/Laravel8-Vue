<template>
    <div class="input-group input-group-md mb-2">
        <span class="input-group-text" id="inputGroup-sizing-sm">Name</span>
        <input type="text" class="form-control" v-model="item.name" />
        <font-awesome-icon
            icon="plus-square"
            @click="addItem()"
            :class = "[ item.name ? 'active' : 'inactive' , 'plus' ]"    
        
        />
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            item: {
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
                if(response.status == 201){
                    this.item.name = "";
                    this.$emit('reloadlist');
                }
            })
            .catch( error => {
                alert(error);
            })
        }
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