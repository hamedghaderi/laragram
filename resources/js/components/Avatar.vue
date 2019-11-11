<template>
    <div class="relative" style="width:150px; height:150px;">
        <img :src="avatarSrc" :alt="user.name" @mouseover="visible=true" class="rounded-full" style="width:150px;
        height:150px;">
        <input type="file" name="avatar" class="hidden" id="avatar" @change="uploadAvatar">
        <span
                @click="openForm"
                @mouseleave="visible=false"
                v-if="visible"
                class="inline-flex absolute text-white cursor-pointer text-2xl shadow-lg rounded-full w-full top-0 h-full items-center justify-center"
                style="background-color: rgba(0,0,0,.5);">
            <i class="la la-plus-circle"></i>
        </span>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        name: "Avatar",

        data() {
            return {
                visible:false,
                person: null
            }
        },

        created() {
            this.person = this.user;
        },

        computed: {
            avatarSrc() {
                return this.person.avatar ? '/storage/' + this.person.avatar : '/images/avatar.svg';
            }
        },

        methods: {
            openForm() {
                let formInput = document.getElementById('avatar').click();
            },

            uploadAvatar(e) {
                 let formData = new FormData();
                 let file = e.target.files[0];

                formData.append('avatar', file);

                axios.post('/users/' + this.user.id + '/avatars', formData).then(res => {
                    if (res.data.status == 201) {
                        this.person.avatar = res.data.data.avatar;
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>