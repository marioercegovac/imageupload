require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    created() {

    },
    data: {
        isUploading: false,
        errors:[],
        formData: new FormData(),
    },

    methods: {
        async fetchQuestions() {
            // try {
            //     const response =  await axios.get(this.apiHostname + "/random", {
            //         params: {
            //             nsfw: this.isNSFW,
            //             onlynsfw: this.isNSFWOnly,
            //         }
            //     });
            //
            //     this.questions = response.data.data.map(question => {
            //         // question = JSON.parse(question);
            //         question.viewed = false;
            //         return question;
            //     });
            //     this.canFetch = true;
            //     this.getRandomQuestion();
            //
            // } catch (e) {
            //     // Fall silently
            // }
        },
        changeInputDisplay(event) {
            let file = event.target.files[0];
            let filename = file.name;
            let label = event.target.nextElementSibling;
            label.innerHTML = filename;
            this.formData.set('image', file);

        },
        uploadImage(){
            this.isUploading = true;
            axios.post('/upload', this.formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    responseType: 'json'
                }
            }).then((response) => {
                this.openToast("success", response);
                if (this.automaticReservations) {
                    this.generateReservations();
                }else{
                    this.isUploading = false;
                }
            }).catch((error) => {
                this.openToast("error", error);
                this.isUploading = false;
            });
        },
        openToast(type = "upload", response = null) {
            if (type === "upload") {
                // this.flash('Uploading...', 'info', {
                //     important: true,
                // });
            } else if (type === 'success') {
                // this.flash().destroyAll();
                // this.flash(response.data.message, 'success', {
                //     timeout: 3000,
                //     pauseOnInteract: true
                // });
            } else if (type === 'error') {
                // this.flash().destroyAll();
                // this.flash(response.response.data.message, 'error', {
                //     timeout: 5000,
                //     pauseOnInteract: true
                // });
            }
        },
        async logout(){
            try {
                const response = await axios.post('/logout');
                location.reload();

            }
            catch (e) {

            }
        }
    }
});
