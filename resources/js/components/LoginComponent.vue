<template>
    <div class="loginWrapper">
        <div :class="[info.className, 'stateWrapper']" role="alert"></div>
        <div class="input-icon">
            <span class="input-icon-addon">
                <i class="fe fe-user"></i>
            </span>
            <input type="text" class="form-control" placeholder="Username" name="username"
                   v-model="credentials.username" @keydown.enter="login" v-validate="'required|min:3'">
        </div>
        <span class="isError">
            {{ errors.first('username') }}
        </span>
        <div class="input-icon">
            <span class="input-icon-addon">
                <i class="fe fe-lock"></i>
            </span>
            <input type="password" class="form-control" placeholder="Password" name="password"
                   v-model="credentials.password" @keydown.enter="login" v-validate="'required|min:6'">

        </div>
        <span class="isError">
            {{ errors.first('password') }}
        </span>
        <a href="/password/reset">Forgot password?</a>
        <button class="btn btn-square btn-primary" @click="login">Login</button>
    </div>
</template>

<script>
    export default {
        name:'co-login',
        data() {
            return {
                credentials: {
                    username: "",
                    password: ""
                },
                info:{
                    className: "",
                    text : ""
                }
            }
        },
        methods: {
            async login() {
                this.showState("login");
                try {
                    const response = await axios.post('/login', this.credentials);
                    this.showState("success");
                    location.href = "/";
                } catch (error) {
                    this.showState("error", error);
                }
            },
            showState(type, response = null) {
                if (type === "login") {
                    this.info.className = "alert alert-info";
                    this.info.text = "Loging in...";
                } else if (type === 'success') {
                    this.info.className = "alert alert-success";
                    this.info.text = "Logged in!";
                } else if (type === 'error') {
                    this.info.className = "alert alert-danger";
                    this.info.text = response.response.data.message;
                }
            }
        }
    }
</script>
