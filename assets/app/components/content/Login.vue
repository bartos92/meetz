<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Inlog pagina</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Login</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" autocomplete="off" data-lpignore="true" v-model="credentials.username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password" autocomplete="off" data-lpignore="true" v-model="credentials.password">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button @click="login()" type="submit" class="btn btn-info">Sign in</button>
                    <button @click="getUser()" type="submit" class="btn btn-default float-right">Cancel</button>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data () {
            return {
                credentials: {
                    username: '',
                    password: '',
                }
            }
        },
        methods: {
            login() {
                this.$store.dispatch('login', this.credentials)
            },
            getUser() {
                this.axios.defaults.headers.common['Authorization'] = ('Bearer ' + this.$store.state.token);
                this.axios.get('/user/get').then(function (response) {
                    console.log(response)
                });
            }
        }
    }
</script>

<style scoped>

</style>
