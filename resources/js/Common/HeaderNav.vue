<template>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <inertia-link href="/" class="navbar-brand" >PizzaProject</inertia-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><inertia-link href="/" class="nav-link" >Home</inertia-link></li>
                    <li class="nav-item active" v-if="$page.user" ><inertia-link href="/dashboard" class="nav-link" >Orders</inertia-link></li>
                    <li class="nav-item active" v-if="!$page.user" ><a href="/login" class="nav-link" >Login</a></li>
                    <li class="nav-item active" v-if="!$page.user" ><a href="/register" class="nav-link" >Register</a></li>
                    <li class="nav-item active"><inertia-link href="/cart" class="nav-link" ><span class="icon-shopping_cart"></span>[{{cart_items_count}}]</inertia-link></li>
                    <li class="nav-item active" v-if="$page.user" >
                        <inertia-link href="#" @click.prevent="logout" class="nav-link">
                            Logout
                        </inertia-link >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
</template>

<script>
    import JetNavLink from './../Jetstream/NavLink';

    export default {
        components: {
            JetNavLink,
        },
        props: [
            'cart_items_count'
        ],
        methods: {
            logout() {
                axios.post('/logout').then(response => {
                    window.location = '/';
                })
            },
        }
    }
</script>
