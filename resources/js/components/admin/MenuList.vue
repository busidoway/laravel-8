<template>
    <div class="card card-body border-0 shadow">
        <div class="menu-list">
            <div class="row">
                <div class="col-6">
                    <MenuListItem :model="menuList"></MenuListItem>
                </div>
                <div class="col-6"></div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import MenuListItem from './MenuListItem.vue';
// import Sortable from 'sortablejs';
import draggable from 'vuedraggable';

export default {
    components: {
        MenuListItem,
        draggable
    },
    data: () => ({
        menuList: [],
        // menu
        // grabbingCursor: false
    }),
    mounted() {
        this.loadMenu();
    },
    methods: {
        loadMenu(){
            axios.get('/api/menu/list')
            .then(res => {
                console.log(res);
                this.menuList = res.data.menu;
            }).catch(err => {
                console.log(err);
            })
        },
        // toggleGrabCursor(val){
        //     if(val) 
        //         this.grabbingCursor = true;
        //     else    
        //         this.grabbingCursor = false;
        //     // console.log('123');
        // }
    }
}
</script>
