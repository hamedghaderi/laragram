<template>
    <div>
        <file-uploader @uploaded="attachToPosts"></file-uploader>

        <div class="flex -mx-6 flex-wrap">
            <div class="w-1/3 mb-12" v-for="post of posts">
                <div class="px-6">
                    <div class="w-full h-64 relative" :style="style(post)">
                        <span class="dismiss-icon" @click="dismissPost(post)">x</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FileUploader from "../components/FileUploader";

    export default {
        props: ['data'],

        created() {
            this.posts = this.data;
        },

        data() {
            return {
                posts: []
            };
        },

        components: {FileUploader},

        methods: {
            style(post) {
                return `background-image:url(/storage/${post.path});
                background-repeat: no-repeat; background-size:cover`;
            },

            attachToPosts(post) {
                this.posts.push(post);
            },

            dismissPost(post) {
                axios.delete('/posts/' + post.id)
                    .then(response => {
                        this.posts = this.posts.filter(oldPost => {
                            return oldPost.id != post.id;
                        });
                    });
            }
        }
    }
</script>

<style scoped>

</style>