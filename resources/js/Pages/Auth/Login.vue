
<template>
<Head title="Login" />
        <div class="container d-flex flex-column">
            <div class="row">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto">
                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <!-- <div class="text-center">
                                        <img src="img/avatars/avatar.jpg" alt="Charles Hall"
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div> -->
                                    <form @submit.prevent="loginUser">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" required="required" v-model="email" type="email" name="email"
                                                placeholder="Enter your email" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control form-control-lg" required="required" v-model="password" type="password" name="password"
                                                placeholder="Enter your password" />
                                            <small>
                                                <Link method="get"  href="/forgot-password">Forgot password?</Link>
                                            </small>
                                        </div>
                                        <div>
                                            <label class="form-check">
                                                <input class="form-check-input" v-model="remember" type="checkbox" value="remember-me"
                                                    name="remember-me" checked>
                                                <span class="form-check-label">
                                                    Remember me
                                                </span>
                                            </label>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="me-2 btn btn-lg btn-primary">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</template>
<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            remember: false,
        }
    },
    methods: {
        loginUser() {
            this.$inertia.post('/login', {
                email: this.email,
                password: this.password,
                remember: this.remember,
            });
        }
    }
}
</script>
