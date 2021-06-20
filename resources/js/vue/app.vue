<template>
    <div class="container">
        <div class="header">
            <h2 style="text-align : center">List</h2>
            <hr>
            <add-item-form
            v-on:reloadlist="getList()" />
        </div>
        <list-view 
        :items="items"
        v-on:reloadlist="getList()"
         />


    </div>
</template>

<script>
import addItemForm from './addItemForm'
import listView from './listView'

import Vue from 'vue'
import App from './App'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEdit, faPlusSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faPlusSquare, faTrash, faEdit)

Vue.component('font-awesome-icon', FontAwesomeIcon)

export default {
   components: {
       addItemForm, listView
   },

   data: function(){
       return{
           items: []
       }
   },

   methods: {
       getList(){
           axios.get('api/items')
           .then( response => {
               this.items = response.data
           })
           .catch( error => {
               alert(error);
           })
       }
   },
    created(){
        this.getList();

    }

}
</script>

