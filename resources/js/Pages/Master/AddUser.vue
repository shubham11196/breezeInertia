<template>
    <Head :title="'Add User'"/>
     <div class="container-fluid p-0">
        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Add User</h1>
        </div>
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row mb-2">
                        <div class="col col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="firstname">First Name</label>
                                <input v-model="v$.firstname.$model" id="firstname" type="text" name="firstname" class="form-control" />
                                <span v-if="v$.firstname.$error" class="text-danger">First Name field required</span>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="lastname">Last Name</label>
                                <input id="lastname" v-model="v$.lastname.$model" type="text" name="lastname" class="form-control" />
                                <span v-if="v$.lastname.$error" class="text-danger">Last Name field required</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input id="email" v-model="v$.email.$model" type="email" name="email" class="form-control" />
                                <span v-if="v$.email.$error">
                                    <span v-if="v$.email.required.$invalid" class="text-danger">Email field required</span>
                                    <span v-if="v$.email.email.$invalid" class="text-danger">Please enter a valid email</span>
                                </span>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="contact">Phone</label>
                                <input id="contact" type="number" v-model="v$.phone.$model" name="phone" class="form-control" />
                                <span v-if="v$.phone.$error">
                                    <span v-if="v$.phone.required.$invalid" class="text-danger">Phone field required</span>
                                    <span v-else-if="v$.phone.minLength.$invalid" class="text-danger">Phone number is not valid</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <input id="contact" v-model="v$.password.$model" type="password" name="password" class="form-control" />
                                <span v-if="v$.password.$error">
                                    <span v-if="v$.password.required.$invalid" class="text-danger">Password field required</span>
                                    <span v-else-if="v$.password.minLength.$invalid" class="text-danger">Minimum password length should be 8 characters</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-12">
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary me-3">Submit</button>
                                <button type="button" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'
import { email, minLength, required } from '@vuelidate/validators'
import { useVuelidate } from '@vuelidate/core'
export default {
    name:'AddUser',
    setup(){
        const form = useForm({
            email: '',
            password: '',
            phone: '',
            firstname: '',
            lastname: '',
        });

        const rules = {
            email: { required, email },
            password: { required, minLength:minLength(8) },
            phone: { required, minLength: minLength(10) },
            firstname: { required },
            lastname: { required },
        };

        const v$ = useVuelidate(rules, form) ;
        return { v$, form };
    }
}
</script>

<style>

</style>
