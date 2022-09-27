<template>
    <div class="user-video">
        <div class="mb-3 fw-bolder">Пользователи</div>
        <div class="mb-3 fs-6">
            <div class="user-video__list">
                <div class="mb-1" v-for="user in usersVideo" :key="user.id">
                    <input type="checkbox" name="user_check" :id="'check' + user.id" v-model="checkName" :value="{id: user.id, name: user.name}" @change="toggleBtnRemove" class="form-check-input me-2">
                    <!-- <input type="checkbox" name="" :id="'check' + user.id" v-model="checkName" :value="user.id" @change="toggleBtnRemove" class="form-check-input me-2"> -->
                    <label :for="'check' + user.id" class="form-check-label">{{ user.name }}</label>
                    <input type="hidden" :name="'users_video['+user.id+']'" :value="user.uv_id">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-2" style="height:24px;">
                <a class="text-danger" @click.prevent="removeUsers" v-if="btnRemove.active"><i class="fas fa-trash-alt me-2"></i>Удалить отмеченные</a>
            </div>
        </div>
        <div class="mb-3 fw-bolder">Выбрать пользователей</div>
        <select size="6" class="form-select" name="users[]" v-model="select.val" multiple aria-label="multiple select">
            <option :value="{value: user.id, text: user.name}" v-for="user in users" :key="user.id">{{ user.name }}</option>
        </select>
        <div class="">
            <button class="btn btn-primary" @click.prevent="addUsers">Добавить</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        id: {
            type: Number,
            default:0
        }
    },
    data: () => ({
        select: {
            val: []
        },
        users:[],
        usersVideo: [],
        btnRemove: {
            active: false
        },
        checkName: []
    }),
    mounted() {
        // console.log(this.id);
        // if(!this.id && this.id == 0)
        this.loadUsers(this.id);
    },
    methods: {
        loadUsers(id){
            if(id == 0) {
                axios.get('/api/user_video/users')
                .then(res => {
                    // console.log(res);
                    this.users = res.data.users;
                }).catch(err => {
                    console.log(err);
                })
            }else{
                axios.get('/api/user_video/' + id)
                .then(res => {
                    // console.log(res);
                    this.users = res.data.users;
                    this.usersVideo = res.data.user_videos;
                }).catch(err => {
                    console.log(err);
                })
            }
        },
        addUsers(){
            if(this.users.length != 0){
                // console.log(this.select.val);
                var arr_select = this.select.val;

                for(let i in arr_select){
                    let user_id = arr_select[i].value;
                    this.usersVideo.push({
                        id: arr_select[i].value,
                        name: arr_select[i].text
                    });
                    for(let n in this.users){
                        if(this.users[n].id == user_id) this.users.splice(n, 1);
                    }
                }

                // console.log('users:', this.users);
                // console.log('usersVideo:', this.usersVideo);
            }
        },
        toggleBtnRemove(){
            if(this.checkName.length != 0) 
                this.btnRemove.active = true
            else
                this.btnRemove.active = false
        },
        removeUsers(){
            if(this.usersVideo.length != 0){
                for(let i in this.checkName){
                    let user_id = this.checkName[i].id;
                    this.users.push(this.checkName[i]);
                    for(let n in this.usersVideo){
                        if(this.usersVideo[n].id == user_id) this.usersVideo.splice(n, 1);
                    }
                }
                this.checkName = [];
                this.btnRemove.active = false
            }
            // console.log('checkName:', this.checkName);
            // console.log('users:', this.users);
            // console.log('usersVideo:', this.usersVideo);
        }
    }
}
</script>
