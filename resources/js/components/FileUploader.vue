<template>
    <div class="mb-8">
        <input-file name="image" @uploaded="uploaded"></input-file>

        <button @click="send" class="bg-blue-100 text-blue-500 px-12 py-2 rounded-full" type="submit">Upload</button>
    </div>
</template>

<script>
    import InputFile from "./InputFile";

    export default {
        name: "FileUploader",

        data() {
            return {
                image: ''
            }
        },

        methods: {
           uploaded(file) {
               this.image = file;
           },

            send() {
                let data = new FormData();

                data.append('image', this.image);

                axios.post('/posts', data).then(response => {
                    this.$emit('uploaded', response.data);
                }).catch(error => {
                    console.log(error.response.data.errors);
                });
            }
        },

        components: {InputFile}
    }
</script>

<style scoped>

</style>