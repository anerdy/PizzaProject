<template>
    <div>
        <footer class="ftco-footer ftco-section">
            <div class="container">
                <div class="row">
                    <div class="mouse">
                        <a href="#" class="mouse-icon">
                            <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                        </a>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">PizzaProject</h2>
                            <p>Delicious pizza.</p>
                            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4 ml-md-5">
                            <ul class="list-unstyled">
                                <li><inertia-link href="/" class="nav-link" >Home</inertia-link></li>
                                <li><inertia-link href="/cart" class="nav-link" >Cart</inertia-link></li>
                                <li><a href="/login" class="nav-link" >Login</a></li>
                                <li><a href="/register" class="nav-link" >Register</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ftco-footer-widget mb-4">
                            <div class="d-flex">
                                <h2 class="ftco-heading-2">Choose currency</h2>
                            </div>
                            <div class="d-flex">
                                <select v-model="currency" @change="currencyChange">
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="ftco-footer-widget mb-4">
                            <h2 class="ftco-heading-2">Have a Questions?</h2>
                            <div class="block-23 mb-3">
                                <ul>
                                    <li><span class="icon icon-map-marker"></span><span class="text">Saint Petersburg, <br>Russia</span></li>
                                    <li><span class="icon icon-phone"></span><span class="text">+7 999 999 9999</span></li>
                                    <li><span class="icon icon-envelope"></span><span class="text">test@test.test</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>
                            Copyright &copy;2020 All rights reserved | Pizza Project
                        </p>
                    </div>
                </div>
            </div>
        </footer>


    </div>
</template>

<script>
    export default {
        data() {
            return {
                currency: 'USD'
            }
        },
        mounted() {
            if (this.$cookies.get('currency') !== null) {
                this.currency = this.$cookies.get('currency');
            } else {
                this.$cookies.set('currency', this.currency);
            }
        },
        methods: {
            async currencyChange() {
                this.$cookies.set('currency', this.currency);
                this.emitToParentPage();
            },
            emitToParentPage () {
                this.$emit('currency', this.currency);
            },
        }
    }
</script>
