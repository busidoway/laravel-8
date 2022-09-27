<template>
    <div class="program-items">
        <div class="row mb-4 mx-0" v-for="(item, index) in items" :key="index">
            <div class="input-group px-0">
                <input type="text" name="program[]" :id="'program'+index" class="form-control" placeholder="" value="">
                <button class="text-danger ms-1 btn py-0 px-2" @click.prevent="deleteItem(index)"><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
        <div class="row mb-3 mx-0">
            <div class="button-group px-0">
                <button class="btn btn-outline-primary" @click.prevent="addItem">[+] Добавить</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        items: []
    }),
    methods: {
        addItem() {
            this.items.push({
                // id: ""
            })
        },
        deleteItem(index) {
            this.items.splice(index, 1);
        }
    }
}
</script>