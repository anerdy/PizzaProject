<template>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/">PizzaProject</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><inertia-link href="/" class="nav-link" >Home</inertia-link></li>
                    <li class="nav-item"><inertia-link href="/about" class="nav-link" >About</inertia-link></li>
                    <li class="nav-item active"><inertia-link href="/login" class="nav-link" >Login</inertia-link></li>
                    <li class="nav-item active"><inertia-link href="/register" class="nav-link" >Register</inertia-link></li>
                    <li class="nav-item active"><inertia-link href="/cart" class="nav-link" ><span class="icon-shopping_cart"></span>[0]</inertia-link></li>
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
    }
</script>
