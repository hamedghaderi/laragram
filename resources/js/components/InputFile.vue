<template>
    <label :for="name" class="border-dashed border-2 flex
            items-center text-center justify-center text-5xl h-64 text-gray-400 mb-4">
        +
        <input type="file" :name="name" value="image" class="hidden" :id="name" @change="change">
    </label>
</template>

<script>
    export default {
       props: ['name'],

        data() {
           return {
               image: ''
           }
        },

        methods: {
           change(e) {
              this.$emit('uploaded', e.target.files[0]);
           }
        }
    }
</script>

<style>

</style>