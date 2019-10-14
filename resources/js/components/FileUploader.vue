<template>
    <div class="mb-8">
        <input-file name="image" @uploaded="uploaded"></input-file>

        <div class="mb-3">
            <button @click="send" class="bg-blue-100 text-blue-500 px-12 py-2 rounded-full" type="submit">Upload
            </button>
        </div>

        <span class="feedback feedback--invalid" v-if="showError" v-text="errors.image">
        </span>
    </div>
</template>

<script>
    import InputFile from "./InputFile";

    export default {
        name: "FileUploader",

        data() {
            return {
                image: '',
                errors: {},
                showError: false,
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
                    this.showError = true;
                    this.errors.image = error.response.data.errors['image'][0];
                });
            },
        },

        components: {InputFile}
    }
</script>

<style scoped>

</style>